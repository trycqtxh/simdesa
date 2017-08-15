<?php

namespace App\Http\Controllers;

use App\Entities\Bidang;
use App\Entities\KegiatanKerja;
use App\Entities\Pembiayaan;
use App\Entities\Pendapatan;
use App\Entities\ProfilDesa;
use App\Entities\RealisasiBelanja;
use App\Entities\RealisasiPembiayaan;
use App\Entities\RealisasiPendapatan;
use App\Entities\RKP;
use App\Entities\RPJM;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPExcel_IOFactory;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;

class APBDController extends Controller
{
    public function perencanaan()
    {
        $current_year = Carbon::now()->year;

        if(request()->wantsJson()){
            $table = [];
            //==========================================================================================================
            $bidang_pendapatan = Bidang::where('jenis', 'pendapatan')->get();

            $jumlah_pendapatan = 0;
            $kode_pendapatan = 1;
            $pen['kode_1'] = $kode_pendapatan;
            $pen['kode_2'] = '';
            $pen['kode_3'] = '';
            $pen['kode_4'] = '';

            $pen['uraian'] = "<b>PENDAPATAN</b>";
            $pen['anggaran'] = '';
            $pen['keterangan'] = '';
            $table[] = $pen;

            $kode_1 = 1;
            foreach($bidang_pendapatan as $b){
                $row_bidang = [];
                $row_bidang['kode_1'] = $kode_pendapatan;
                $row_bidang['kode_2'] = $kode_1;
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = '<b><i>'.$b->nama.'</i></b>';
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;

                //------------------------------------------------------------------------------------------------------
                $kode_2 = 1;
                $pendapatan = Pendapatan::where('bidang_id', $b->id)->where('level', 'level_1')->where('tahun', $current_year)->get();
                foreach($pendapatan as $p){
                    $row_pendapatan['kode_1'] = $kode_pendapatan;
                    $row_pendapatan['kode_2'] = $kode_1;
                    $row_pendapatan['kode_3'] = $kode_2;
                    $row_pendapatan['kode_4'] = '';

                    $row_pendapatan['uraian'] = $p->uraian;
                    $row_pendapatan['anggaran'] = '';
                    $row_pendapatan['keterangan'] = '';
                    $table[] = $row_pendapatan;

                    $kode_3 = 1;
                    $subpendapatan = Pendapatan::where('level', 'level_2')->where('tahun', $current_year)->where('pendapatan_id', $p->id)->get();
                    foreach($subpendapatan as $sp){
                        $row_subpendapatan['kode_1'] = $kode_pendapatan;
                        $row_subpendapatan['kode_2'] = $kode_1;
                        $row_subpendapatan['kode_3'] = $kode_2;
                        $row_subpendapatan['kode_4'] = $kode_3;

                        $row_subpendapatan['uraian'] = $sp->uraian;
                        $row_subpendapatan['anggaran'] = number_format($sp->jumlah_dana, 2, ',', '.');
                        $row_subpendapatan['keterangan'] = $sp->keterangan;
                        $table[] = $row_subpendapatan;
                        $jumlah_pendapatan += (int) $sp->jumlah_dana;

                        $kode_3++;
                    }
                    $kode_2++;
                }
                //------------------------------------------------------------------------------------------------------
                $row_bidang['kode_1'] = '';
                $row_bidang['kode_2'] = '';
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = '';
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;

                $kode_1++;
            }
            $row_jumlah['kode_1'] = '';
            $row_jumlah['kode_2'] = '';
            $row_jumlah['kode_3'] = '';
            $row_jumlah['kode_4'] = '';

            $row_jumlah['uraian'] = '<b>JUMLAH PENDAPATAN</b>';
            $row_jumlah['anggaran'] = number_format($jumlah_pendapatan, 2, ',', '.');
            $row_jumlah['keterangan'] = '';

            $table[] = $row_jumlah;

            $row_jumlah['kode_1'] = '';
            $row_jumlah['kode_2'] = '';
            $row_jumlah['kode_3'] = '';
            $row_jumlah['kode_4'] = '';

            $row_jumlah['uraian'] = '';
            $row_jumlah['anggaran'] = '';
            $row_jumlah['keterangan'] = '';

            $table[] = $row_jumlah;
            //==========================================================================================================
            $bidang_belanja = Bidang::where('jenis', 'belanja')->get();
            $rpjm = RPJM::all()->last();
            //$tahun = Carbon::createFromDate($rpjm['tahun_awal'])->addYears($id-1)->year;
            $tahun = $current_year;

            //subkegiatan - anak [id_parent] id = 43
            $subkegiatan_id = KegiatanKerja::whereHas('rkps', function($q) use($tahun){
                $q->where('tahun', $tahun);
            })->get()->pluck('kegiatan_kerja_id');

            //kegiatan - anak [id_parent] id =1
            $kegiatan_id = KegiatanKerja::whereHas('kerjas', function($query) use($subkegiatan_id){
                $query->where('jenis', 'level_3');
            })->whereIn('id', $subkegiatan_id)->get()->pluck('kegiatan_kerja_id');


            $current_subbidang_id = KegiatanKerja::whereHas('kerjas', function($query) use($kegiatan_id){
                $query->where('jenis', 'level_2');
            })->whereIn('id', $kegiatan_id)->get()->pluck('id');

            $current_kegiatan_id = KegiatanKerja::whereHas('kerjas', function($query) use($subkegiatan_id){
                $query->where('jenis', 'level_3');
            })->whereIn('id', $subkegiatan_id)->get()->pluck('id');

            $current_subkegiatan_id = KegiatanKerja::whereHas('rkps', function($q) use($tahun){
                $q->where('tahun', $tahun);
            })->get()->pluck('id');

            $kode_belanja = 2;
            $bel = [];
            $bel['kode_1'] = $kode_belanja;
            $bel['kode_2'] = '';
            $bel['kode_3'] = '';
            $bel['kode_4'] = '';

            $bel['uraian'] = "<b>BELANJA</b>";
            $bel['anggaran'] = '';
            $bel['keterangan'] = '';
            $table[] = $bel;

            $jumlah_belanja = 0;
            $kode_1 = 1;
            foreach($bidang_belanja as $b){
                $row_bidang = [];
                $row_bidang['kode_1'] = $kode_belanja;
                $row_bidang['kode_2'] = $kode_1;
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = $b->nama;
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;

                //------------------------------------------------------------------------------------------------------
                $subbidang = KegiatanKerja::where('jenis', 'level_1')
                    ->where('bidang_id', $b['id'])
                    ->whereIn('id', $current_subbidang_id)
                    ->where('rpjm_id', $rpjm['id'])
                    ->get();
                $kode_2 = 1;
                foreach($subbidang as $sb){
                    $row_subbidang = [];
                    $row_subbidang['kode_1'] = $kode_belanja;
                    $row_subbidang['kode_2'] = $kode_1;
                    $row_subbidang['kode_3'] = $kode_2;
                    $row_subbidang['kode_4'] = '';

                    $row_subbidang['uraian'] = $sb->uraian;
                    $row_subbidang['anggaran'] = '';
                    $row_subbidang['keterangan'] = '';
                    $table[] = $row_subbidang;

                    //--------------------------------------------------------------------------------------------------
                    $kegiatan = KegiatanKerja::where('jenis', 'level_2')
                        ->where('kegiatan_kerja_id', $sb->id)
                        ->whereIn('id', $current_kegiatan_id)
                        ->where('rpjm_id', $rpjm['id'])
                        ->get();
                    $kode_3 = 1;
                    foreach($kegiatan as $k){
                        $row_kegiatan = [];
                        $row_kegiatan['kode_1'] = $kode_belanja;
                        $row_kegiatan['kode_2'] = $kode_1;
                        $row_kegiatan['kode_3'] = $kode_2;
                        $row_kegiatan['kode_4'] = $kode_3;

                        $row_kegiatan['uraian'] = $k->uraian;
                        $row_kegiatan['anggaran'] = '';
                        $row_kegiatan['keterangan'] = '';
                        $table[] = $row_kegiatan;
                        //----------------------------------------------------------------------------------------------
                        $sub_kegiatan = KegiatanKerja::where('jenis', 'level_3')
                            ->where('kegiatan_kerja_id', $k->id)
                            ->whereIn('id', $current_subkegiatan_id)
                            ->where('rpjm_id', $rpjm['id'])
                            ->get();
                        foreach($sub_kegiatan as $sk){
                            $row_subkegiatan = [];
                            $row_subkegiatan['kode_1'] = '';
                            $row_subkegiatan['kode_2'] = '';
                            $row_subkegiatan['kode_3'] = '';
                            $row_subkegiatan['kode_4'] = '';

                            $row_subkegiatan['uraian'] = '<i class="fa fa-minus"></i> '.$sk->uraian;
                            $row_subkegiatan['anggaran'] = number_format($sk->detailKegiatanKerjas->first()->jumlah_dana, 2, ',', '.');
                            $row_subkegiatan['keterangan'] = $sk->detailKegiatanKerjas->first()->keterangan;
                            $table[] = $row_subkegiatan;
                            $jumlah_belanja += (int) $sk->detailKegiatanKerjas->first()->jumlah_dana;
                        }
                        //----------------------------------------------------------------------------------------------
                        $kode_3++;
                    }
                    //--------------------------------------------------------------------------------------------------
                    $kode_2++;
                }
                //------------------------------------------------------------------------------------------------------
                $kode_1++;

                $row_bidang['kode_1'] = '';
                $row_bidang['kode_2'] = '';
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = '';
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;
            }

            $row_jumlah['kode_1'] = '';
            $row_jumlah['kode_2'] = '';
            $row_jumlah['kode_3'] = '';
            $row_jumlah['kode_4'] = '';

            $row_jumlah['uraian'] = '<b>JUMLAH BELANJA</b>';
            $row_jumlah['anggaran'] = number_format($jumlah_belanja, 2, ',', '.');
            $row_jumlah['keterangan'] = '';
            $table[] = $row_jumlah;

            $row_jumlah['kode_1'] = '';
            $row_jumlah['kode_2'] = '';
            $row_jumlah['kode_3'] = '';
            $row_jumlah['kode_4'] = '';

            $row_jumlah['uraian'] = '';
            $row_jumlah['anggaran'] = '';
            $row_jumlah['keterangan'] = '';
            $table[] = $row_jumlah;

            $row_jumlah['kode_1'] = '';
            $row_jumlah['kode_2'] = '';
            $row_jumlah['kode_3'] = '';
            $row_jumlah['kode_4'] = '';

            $row_jumlah['uraian'] = '<b> SURPLUS / DEFISIT</b>';
            $row_jumlah['anggaran'] = number_format($jumlah_pendapatan - $jumlah_belanja, 2, ',', '.');
            $row_jumlah['keterangan'] = '';
            $table[] = $row_jumlah;

            $row_jumlah['kode_1'] = '';
            $row_jumlah['kode_2'] = '';
            $row_jumlah['kode_3'] = '';
            $row_jumlah['kode_4'] = '';

            $row_jumlah['uraian'] = '';
            $row_jumlah['anggaran'] = '';
            $row_jumlah['keterangan'] = '';
            $table[] = $row_jumlah;
            //==========================================================================================================
            $bidang_pembiayaan = Bidang::where('jenis', 'pembiayaan')->get();
            $kode_pembiayaan = 3;
            $pem = [];
            $pem['kode_1'] = $kode_pembiayaan;
            $pem['kode_2'] = '';
            $pem['kode_3'] = '';
            $pem['kode_4'] = '';

            $pem['uraian'] = "<b>PEMBIAYAAN</b>";
            $pem['anggaran'] = '';
            $pem['keterangan'] = '';
            $table[] = $pem;

            $jumlah_pembiayaan = 0;
            $kode_1 = 1;
            foreach($bidang_pembiayaan as $b){
                $row_bidang = [];
                $row_bidang['kode_1'] = $kode_pembiayaan;
                $row_bidang['kode_2'] = $kode_1;
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = $b->nama;
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;

                $kode_2 = 1;
                $pembiayaan = Pembiayaan::where('bidang_id', $b->id)->where('level', 'level_1')->where('tahun', $current_year)->get();
                foreach($pembiayaan As $p){
                    $row_pembiayaan['kode_1'] = $kode_pembiayaan;
                    $row_pembiayaan['kode_2'] = $kode_1;
                    $row_pembiayaan['kode_3'] = $kode_2;
                    $row_pembiayaan['kode_4'] = '';

                    $row_pembiayaan['uraian'] = $p->uraian;
                    $row_pembiayaan['anggaran'] = number_format($p->jumlah_dana, 2, ',', '.');
                    $row_pembiayaan['keterangan'] = $p->keterangan;
                    $table[] = $row_pembiayaan;
                    $jumlah_pembiayaan += (int) $p->jumlah_dana;


                    $kode_3 = 1;
                    $subpembiayaan = Pembiayaan::where('pembiayaan_id', $p->id)->where('level', 'level_2')->where('tahun', $current_year)->get();
                    foreach($subpembiayaan As $sp){
                        $row_pembiayaan['kode_1'] = $kode_pembiayaan;
                        $row_pembiayaan['kode_2'] = $kode_1;
                        $row_pembiayaan['kode_3'] = $kode_2;
                        $row_pembiayaan['kode_4'] = $kode_3;

                        $row_pembiayaan['uraian'] = $sp->uraian;
                        $row_pembiayaan['anggaran'] = '';
                        $row_pembiayaan['keterangan'] = '';
                        $table[] = $row_pembiayaan;

                        $kode_3++;
                    }

                    $kode_2++;
                }
                $row_bidang['kode_1'] = '';
                $row_bidang['kode_2'] = '';
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = '';
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;
                $kode_1++;
            }
            
            $row_jlm_pembiayaan['kode_1'] = '';
            $row_jlm_pembiayaan['kode_2'] = '';
            $row_jlm_pembiayaan['kode_3'] = '';
            $row_jlm_pembiayaan['kode_4'] = '';

            $row_jlm_pembiayaan['uraian'] = '<b>JUMLAH PEMBIAYAAN</b>';
            $row_jlm_pembiayaan['anggaran'] = number_format($jumlah_pembiayaan, 2, ',', '.');
            $row_jlm_pembiayaan['keterangan'] = '';
            $table[] = $row_jlm_pembiayaan;
            //==========================================================================================================
            return response()->json(['data'=>$table]);
        }

        return view('content.perencanaan.apbd', compact('current_year'));
    }

    public function perencanaanExcel()
    {
        $current_year = Carbon::now()->year;
        $filename = 'apbd-'.$current_year.'.xls';

        if(request()->wantsJson()){
            $table = [];
            //==========================================================================================================
            $bidang_pendapatan = Bidang::where('jenis', 'pendapatan')->get();

            $jumlah_pendapatan = 0;
            $kode_pendapatan = 1;
            $pen['kode_1'] = $kode_pendapatan;
            $pen['kode_2'] = '';
            $pen['kode_3'] = '';
            $pen['kode_4'] = '';

            $pen['uraian'] = "PENDAPATAN";
            $pen['anggaran'] = '';
            $pen['keterangan'] = '';
            $table[] = $pen;

            $kode_1 = 1;
            foreach($bidang_pendapatan as $b){
                $row_bidang = [];
                $row_bidang['kode_1'] = $kode_pendapatan;
                $row_bidang['kode_2'] = $kode_1;
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = $b->nama;
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;

                //------------------------------------------------------------------------------------------------------
                $kode_2 = 1;
                $pendapatan = Pendapatan::where('bidang_id', $b->id)->where('level', 'level_1')->where('tahun', $current_year)->get();
                foreach($pendapatan as $p){
                    $row_pendapatan['kode_1'] = $kode_pendapatan;
                    $row_pendapatan['kode_2'] = $kode_1;
                    $row_pendapatan['kode_3'] = $kode_2;
                    $row_pendapatan['kode_4'] = '';

                    $row_pendapatan['uraian'] = $p->uraian;
                    $row_pendapatan['anggaran'] = '';
                    $row_pendapatan['keterangan'] = '';
                    $table[] = $row_pendapatan;

                    $kode_3 = 1;
                    $subpendapatan = Pendapatan::where('level', 'level_2')->where('tahun', $current_year)->where('pendapatan_id', $p->id)->get();
                    foreach($subpendapatan as $sp){
                        $row_subpendapatan['kode_1'] = $kode_pendapatan;
                        $row_subpendapatan['kode_2'] = $kode_1;
                        $row_subpendapatan['kode_3'] = $kode_2;
                        $row_subpendapatan['kode_4'] = $kode_3;

                        $row_subpendapatan['uraian'] = $sp->uraian;
                        $row_subpendapatan['anggaran'] = $sp->jumlah_dana;
                        $row_subpendapatan['keterangan'] = $sp->keterangan;
                        $table[] = $row_subpendapatan;
                        $jumlah_pendapatan += (int) $sp->jumlah_dana;

                        $kode_3++;
                    }
                    $kode_2++;
                }
                //------------------------------------------------------------------------------------------------------
                $row_bidang['kode_1'] = '';
                $row_bidang['kode_2'] = '';
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = '';
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;

                $kode_1++;
            }
            $row_jumlah['kode_1'] = '';
            $row_jumlah['kode_2'] = '';
            $row_jumlah['kode_3'] = '';
            $row_jumlah['kode_4'] = '';

            $row_jumlah['uraian'] = 'JUMLAH PENDAPATAN';
            $row_jumlah['anggaran'] = $jumlah_pendapatan;
            $row_jumlah['keterangan'] = '';

            $table[] = $row_jumlah;

            $row_jumlah['kode_1'] = '';
            $row_jumlah['kode_2'] = '';
            $row_jumlah['kode_3'] = '';
            $row_jumlah['kode_4'] = '';

            $row_jumlah['uraian'] = '';
            $row_jumlah['anggaran'] = '';
            $row_jumlah['keterangan'] = '';

            $table[] = $row_jumlah;
            //==========================================================================================================
            $bidang_belanja = Bidang::where('jenis', 'belanja')->get();
            $rpjm = RPJM::all()->last();
            //$tahun = Carbon::createFromDate($rpjm['tahun_awal'])->addYears($id-1)->year;
            $tahun = $current_year;

            //subkegiatan - anak [id_parent] id = 43
            $subkegiatan_id = KegiatanKerja::whereHas('rkps', function($q) use($tahun){
                $q->where('tahun', $tahun);
            })->get()->pluck('kegiatan_kerja_id');

            //kegiatan - anak [id_parent] id =1
            $kegiatan_id = KegiatanKerja::whereHas('kerjas', function($query) use($subkegiatan_id){
                $query->where('jenis', 'level_3');
            })->whereIn('id', $subkegiatan_id)->get()->pluck('kegiatan_kerja_id');


            $current_subbidang_id = KegiatanKerja::whereHas('kerjas', function($query) use($kegiatan_id){
                $query->where('jenis', 'level_2');
            })->whereIn('id', $kegiatan_id)->get()->pluck('id');

            $current_kegiatan_id = KegiatanKerja::whereHas('kerjas', function($query) use($subkegiatan_id){
                $query->where('jenis', 'level_3');
            })->whereIn('id', $subkegiatan_id)->get()->pluck('id');

            $current_subkegiatan_id = KegiatanKerja::whereHas('rkps', function($q) use($tahun){
                $q->where('tahun', $tahun);
            })->get()->pluck('id');

            $kode_belanja = 2;
            $bel = [];
            $bel['kode_1'] = $kode_belanja;
            $bel['kode_2'] = '';
            $bel['kode_3'] = '';
            $bel['kode_4'] = '';

            $bel['uraian'] = "BELANJA";
            $bel['anggaran'] = '';
            $bel['keterangan'] = '';
            $table[] = $bel;

            $jumlah_belanja = 0;
            $kode_1 = 1;
            foreach($bidang_belanja as $b){
                $row_bidang = [];
                $row_bidang['kode_1'] = $kode_belanja;
                $row_bidang['kode_2'] = $kode_1;
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = $b->nama;
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;

                //------------------------------------------------------------------------------------------------------
                $subbidang = KegiatanKerja::where('jenis', 'level_1')
                    ->where('bidang_id', $b['id'])
                    ->whereIn('id', $current_subbidang_id)
                    ->where('rpjm_id', $rpjm['id'])
                    ->get();
                $kode_2 = 1;
                foreach($subbidang as $sb){
                    $row_subbidang = [];
                    $row_subbidang['kode_1'] = $kode_belanja;
                    $row_subbidang['kode_2'] = $kode_1;
                    $row_subbidang['kode_3'] = $kode_2;
                    $row_subbidang['kode_4'] = '';

                    $row_subbidang['uraian'] = $sb->uraian;
                    $row_subbidang['anggaran'] = '';
                    $row_subbidang['keterangan'] = '';
                    $table[] = $row_subbidang;

                    //--------------------------------------------------------------------------------------------------
                    $kegiatan = KegiatanKerja::where('jenis', 'level_2')
                        ->where('kegiatan_kerja_id', $sb->id)
                        ->whereIn('id', $current_kegiatan_id)
                        ->where('rpjm_id', $rpjm['id'])
                        ->get();
                    $kode_3 = 1;
                    foreach($kegiatan as $k){
                        $row_kegiatan = [];
                        $row_kegiatan['kode_1'] = $kode_belanja;
                        $row_kegiatan['kode_2'] = $kode_1;
                        $row_kegiatan['kode_3'] = $kode_2;
                        $row_kegiatan['kode_4'] = $kode_3;

                        $row_kegiatan['uraian'] = $k->uraian;
                        $row_kegiatan['anggaran'] = '';
                        $row_kegiatan['keterangan'] = '';
                        $table[] = $row_kegiatan;
                        //----------------------------------------------------------------------------------------------
                        $sub_kegiatan = KegiatanKerja::where('jenis', 'level_3')
                            ->where('kegiatan_kerja_id', $k->id)
                            ->whereIn('id', $current_subkegiatan_id)
                            ->where('rpjm_id', $rpjm['id'])
                            ->get();
                        foreach($sub_kegiatan as $sk){
                            $row_subkegiatan = [];
                            $row_subkegiatan['kode_1'] = '';
                            $row_subkegiatan['kode_2'] = '';
                            $row_subkegiatan['kode_3'] = '';
                            $row_subkegiatan['kode_4'] = '';

                            $row_subkegiatan['uraian'] = '- '.$sk->uraian;
                            $row_subkegiatan['anggaran'] = $sk->detailKegiatanKerjas->first()->jumlah_dana;
                            $row_subkegiatan['keterangan'] = $sk->detailKegiatanKerjas->first()->keterangan;
                            $table[] = $row_subkegiatan;
                            $jumlah_belanja += (int) $sk->detailKegiatanKerjas->first()->jumlah_dana;
                        }
                        //----------------------------------------------------------------------------------------------
                        $kode_3++;
                    }
                    //--------------------------------------------------------------------------------------------------
                    $kode_2++;
                }
                //------------------------------------------------------------------------------------------------------
                $kode_1++;

                $row_bidang['kode_1'] = '';
                $row_bidang['kode_2'] = '';
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = '';
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;
            }

            $row_jumlah['kode_1'] = '';
            $row_jumlah['kode_2'] = '';
            $row_jumlah['kode_3'] = '';
            $row_jumlah['kode_4'] = '';

            $row_jumlah['uraian'] = 'JUMLAH BELANJA';
            $row_jumlah['anggaran'] = $jumlah_belanja;
            $row_jumlah['keterangan'] = '';
            $table[] = $row_jumlah;

            $row_jumlah['kode_1'] = '';
            $row_jumlah['kode_2'] = '';
            $row_jumlah['kode_3'] = '';
            $row_jumlah['kode_4'] = '';

            $row_jumlah['uraian'] = '';
            $row_jumlah['anggaran'] = '';
            $row_jumlah['keterangan'] = '';
            $table[] = $row_jumlah;

            $row_jumlah['kode_1'] = '';
            $row_jumlah['kode_2'] = '';
            $row_jumlah['kode_3'] = '';
            $row_jumlah['kode_4'] = '';

            $row_jumlah['uraian'] = 'SURPLUS / DEFISIT';
            $row_jumlah['anggaran'] = $jumlah_pendapatan - $jumlah_belanja;
            $row_jumlah['keterangan'] = '';
            $table[] = $row_jumlah;

            $row_jumlah['kode_1'] = '';
            $row_jumlah['kode_2'] = '';
            $row_jumlah['kode_3'] = '';
            $row_jumlah['kode_4'] = '';

            $row_jumlah['uraian'] = '';
            $row_jumlah['anggaran'] = '';
            $row_jumlah['keterangan'] = '';
            $table[] = $row_jumlah;
            //==========================================================================================================
            $bidang_pembiayaan = Bidang::where('jenis', 'pembiayaan')->get();
            $kode_pembiayaan = 3;
            $pem = [];
            $pem['kode_1'] = $kode_pembiayaan;
            $pem['kode_2'] = '';
            $pem['kode_3'] = '';
            $pem['kode_4'] = '';

            $pem['uraian'] = "PEMBIAYAAN";
            $pem['anggaran'] = '';
            $pem['keterangan'] = '';
            $table[] = $pem;

            $jumlah_pembiayaan = 0;
            $kode_1 = 1;
            foreach($bidang_pembiayaan as $b){
                $row_bidang = [];
                $row_bidang['kode_1'] = $kode_pembiayaan;
                $row_bidang['kode_2'] = $kode_1;
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = $b->nama;
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;

                $kode_2 = 1;
                $pembiayaan = Pembiayaan::where('bidang_id', $b->id)->where('level', 'level_1')->where('tahun', $current_year)->get();
                foreach($pembiayaan As $p){
                    $row_pembiayaan['kode_1'] = $kode_pembiayaan;
                    $row_pembiayaan['kode_2'] = $kode_1;
                    $row_pembiayaan['kode_3'] = $kode_2;
                    $row_pembiayaan['kode_4'] = '';

                    $row_pembiayaan['uraian'] = $p->uraian;
                    $row_pembiayaan['anggaran'] = $p->jumlah_dana;
                    $row_pembiayaan['keterangan'] = $p->keterangan;
                    $table[] = $row_pembiayaan;
                    $jumlah_pembiayaan += (int) $p->jumlah_dana;


                    $kode_3 = 1;
                    $subpembiayaan = Pembiayaan::where('pembiayaan_id', $p->id)->where('level', 'level_2')->where('tahun', $current_year)->get();
                    foreach($subpembiayaan As $sp){
                        $row_pembiayaan['kode_1'] = $kode_pembiayaan;
                        $row_pembiayaan['kode_2'] = $kode_1;
                        $row_pembiayaan['kode_3'] = $kode_2;
                        $row_pembiayaan['kode_4'] = $kode_3;

                        $row_pembiayaan['uraian'] = $sp->uraian;
                        $row_pembiayaan['anggaran'] = '';
                        $row_pembiayaan['keterangan'] = '';
                        $table[] = $row_pembiayaan;

                        $kode_3++;
                    }

                    $kode_2++;
                }
                $row_bidang['kode_1'] = '';
                $row_bidang['kode_2'] = '';
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = '';
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;
                $kode_1++;
            }

            $row_jlm_pembiayaan['kode_1'] = '';
            $row_jlm_pembiayaan['kode_2'] = '';
            $row_jlm_pembiayaan['kode_3'] = '';
            $row_jlm_pembiayaan['kode_4'] = '';

            $row_jlm_pembiayaan['uraian'] = 'JUMLAH PEMBIAYAAN';
            $row_jlm_pembiayaan['anggaran'] = $jumlah_pembiayaan;
            $row_jlm_pembiayaan['keterangan'] = '';
            $table[] = $row_jlm_pembiayaan;
            //==========================================================================================================

            $template = resource_path('assets/template-laporan/buku-anggaran.xls');

            $objReader = PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($template);

            //--------------- Header
            $kota = ProfilDesa::find('kab')['value'];
            $namaKota = ProfilDesa::find('kota')['value'];
            $namaKecamatan = ProfilDesa::find('kecamatan')['value'];
            $desa = ProfilDesa::find('des')['value'];
            $namaDesa = ProfilDesa::find('nama_desa')['value'];
            $alamatDesa = ProfilDesa::find('alamat_desa')['value'];
            $teleponDesa = ProfilDesa::find('telepon')['value'];
            $kodePos = ProfilDesa::find('kode_pos')['value'];

            $a4 = $alamatDesa.' Kecamatan '.$namaKecamatan.' '.$kota.' '.$namaKota.', Telp.'.$teleponDesa.', Kode Pos '.$kodePos;
            $objPHPExcel->getActiveSheet()->setCellValue('A1', strtoupper('Pemerintahan '.$kota.' '.$namaKota));
            $objPHPExcel->getActiveSheet()->setCellValue('A2', strtoupper('Kecamatan '.$namaKecamatan));
            $objPHPExcel->getActiveSheet()->setCellValue('A3', strtoupper('Kantor '.$desa.' '.$namaDesa));
            $objPHPExcel->getActiveSheet()->setCellValue('A4', ucfirst($a4));
            $objPHPExcel->getActiveSheet()->setCellValue('A7', strtoupper('Tahun Anggaran '.$current_year));
            //---------------End Header

            $baseRow = 12;
            $j = 0;
            foreach($table as $t){
                $row_excel = $baseRow + $j;

                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_excel, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row_excel, $t['kode_1'])
                    ->setCellValue('B' . $row_excel, $t['kode_2'])
                    ->setCellValue('C' . $row_excel, $t['kode_3'])
                    ->setCellValue('D' . $row_excel, $t['kode_4'])
                    ->setCellValue('E' . $row_excel, $t['uraian'])
                    ->setCellValue('F' . $row_excel, $t['anggaran'])
                    ->setCellValue('G' . $row_excel, $t['keterangan']);
                $j++;
            }
            $objPHPExcel->getActiveSheet()->removeRow($baseRow - 1, 1);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('file-laporan/'.$filename);

            return response()->json([
                'message' => 'Data Berhasil diExport'
            ], 201);

        }

        return response()->download(public_path('file-laporan/'.$filename));
    }


    public function pelaksanaan()
    {
        $current_year = Carbon::now()->year;
        if(request()->wantsJson()){
            $tabel = [];
            //==========================================================================================================
            $kode_pendapatan = 1;
            $row['kode_1'] = $kode_pendapatan;
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = '<b>PENDAPATAN</b>';
            $row['anggaran'] = '';
            $row['realisasi'] = '';
            $row['lebih_kurang'] = '';
            $row['keterangan'] = '';
            $tabel[] = $row;
            $bidang_pendapatan = Bidang::where('jenis', 'pendapatan')->get();
            $kode_2_pendapatan = 1;
            $jumlah_anggaran_pendapatan = 0;
            $jumlah_realisasi_pendapatan = 0;
            foreach($bidang_pendapatan as $bp){
                $row['kode_1'] = $kode_pendapatan;
                $row['kode_2'] = $kode_2_pendapatan;
                $row['kode_3'] = '';
                $row['kode_4'] = '';
                $row['uraian'] = '<b><i>'.$bp->nama.'</i></b>';
                $row['anggaran'] = '';
                $row['realisasi'] = '';
                $row['lebih_kurang'] = '';
                $row['keterangan'] = '';
                $tabel[] = $row;

                $pendapatan_l1 = Pendapatan::where('tahun', $current_year)->where('bidang_id', $bp->id)->get();
                $kode_3_penadapatan = 1;
                foreach($pendapatan_l1 as $pl1){
                    $row['kode_1'] = $kode_pendapatan;
                    $row['kode_2'] = $kode_2_pendapatan;
                    $row['kode_3'] = $kode_3_penadapatan;
                    $row['kode_4'] = '';
                    $row['uraian'] = $pl1->uraian;
                    $row['anggaran'] = '';
                    $row['realisasi'] = '';
                    $row['lebih_kurang'] = '';
                    $row['keterangan'] = '';
                    $tabel[] = $row;

                    $pendapatan_l2 = Pendapatan::where('tahun', $current_year)->where('pendapatan_id', $pl1->id)->get();
                    $kode_4_penadapatan = 1;
                    foreach($pendapatan_l2 as $pl2){
                        $anggaran = $pl2->jumlah_dana;
                        $realisasi = RealisasiPendapatan::where('pendapatan_id', $pl2->id)->sum('jumlah');
                        $selisih = $anggaran - $realisasi;

                        $row['kode_1'] = $kode_pendapatan;
                        $row['kode_2'] = $kode_2_pendapatan;
                        $row['kode_3'] = $kode_3_penadapatan;
                        $row['kode_4'] = $kode_4_penadapatan;
                        $row['uraian'] = $pl2->uraian;
                        $row['anggaran'] = number_format($anggaran, 2, ',', '.');
                        $row['realisasi'] = number_format($realisasi, 2, ',', '.');
                        $row['lebih_kurang'] = number_format($selisih, 2, ',', '.');
                        $row['keterangan'] = '';
                        $tabel[] = $row;

                        $jumlah_anggaran_pendapatan += $anggaran;
                        $jumlah_realisasi_pendapatan += $realisasi;

                    }
                    $kode_3_penadapatan++;
                }
                $kode_2_pendapatan++;
            }
            //==========================================================================================================
            $row['kode_1'] = '';
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = '';
            $row['anggaran'] = '';
            $row['realisasi'] = '';
            $row['lebih_kurang'] = '';
            $row['keterangan'] = '';
            $tabel[] = $row;

            $rpjm = RPJM::all()->last();
            //subkegiatan - anak [id_parent] id = 43
            $subkegiatan_id = KegiatanKerja::whereHas('rkps', function($q) use($current_year){
                $q->where('tahun', $current_year);
            })->get()->pluck('kegiatan_kerja_id');

            //kegiatan - anak [id_parent] id =1
            $kegiatan_id = KegiatanKerja::whereHas('kerjas', function($query) use($subkegiatan_id){
                $query->where('jenis', 'level_3');
            })->whereIn('id', $subkegiatan_id)->get()->pluck('kegiatan_kerja_id');


            $current_subbidang_id = KegiatanKerja::whereHas('kerjas', function($query) use($kegiatan_id){
                $query->where('jenis', 'level_2');
            })->whereIn('id', $kegiatan_id)->get()->pluck('id');

            $current_kegiatan_id = KegiatanKerja::whereHas('kerjas', function($query) use($subkegiatan_id){
                $query->where('jenis', 'level_3');
            })->whereIn('id', $subkegiatan_id)->get()->pluck('id');

            $current_subkegiatan_id = KegiatanKerja::whereHas('rkps', function($q) use($current_year){
                $q->where('tahun', $current_year);
            })->get()->pluck('id');

            $kode_belanja = 2;
            $row['kode_1'] = $kode_belanja;
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = '<b>BELANJA</b>';
            $row['anggaran'] = '';
            $row['realisasi'] = '';
            $row['lebih_kurang'] = '';
            $row['keterangan'] = '';
            $tabel[] = $row;
            $bidang_belanja = Bidang::where('jenis', 'belanja')->get();
            $kode_2_belanja = 1;
            $jumlah_anggaran_belanja = 0;
            $jumlah_realisasi_belanja = 0;
            foreach($bidang_belanja as $bb){
                $row['kode_1'] = $kode_belanja;
                $row['kode_2'] = $kode_2_belanja;
                $row['kode_3'] = '';
                $row['kode_4'] = '';
                $row['uraian'] = $bb->nama;
                $row['anggaran'] = '';
                $row['realisasi'] = '';
                $row['lebih_kurang'] = '';
                $row['keterangan'] = '';
                $tabel[] = $row;

                $subbidang = KegiatanKerja::where('jenis', 'level_1')
                    ->where('bidang_id', $bb->id)
                    ->whereIn('id', $current_subbidang_id)
                    ->where('rpjm_id', $rpjm['id'])
                    ->get();
                $kode_3_belanja = 1;
                foreach($subbidang as $sb){
                    $row['kode_1'] = $kode_belanja;
                    $row['kode_2'] = $kode_2_belanja;
                    $row['kode_3'] = $kode_3_belanja;
                    $row['kode_4'] = '';
                    $row['uraian'] = $sb->uraian;
                    $row['anggaran'] = '';
                    $row['realisasi'] = '';
                    $row['lebih_kurang'] = '';
                    $row['keterangan'] = '';
                    $tabel[] = $row;
                    $kegiatan = KegiatanKerja::where('jenis', 'level_2')
                        ->where('kegiatan_kerja_id', $sb->id)
                        ->whereIn('id', $current_kegiatan_id)
                        ->where('rpjm_id', $rpjm['id'])
                        ->get();
                    $kode_4_belanja =1;
                    foreach($kegiatan as $k){
                        $row['kode_1'] = $kode_belanja;
                        $row['kode_2'] = $kode_2_belanja;
                        $row['kode_3'] = $kode_3_belanja;
                        $row['kode_4'] = $kode_4_belanja;
                        $row['uraian'] = $k->uraian;
                        $row['anggaran'] = '';
                        $row['realisasi'] = '';
                        $row['lebih_kurang'] = '';
                        $row['keterangan'] = '';
                        $tabel[] = $row;
                        $sub_kegiatan = KegiatanKerja::where('jenis', 'level_3')
                            ->where('kegiatan_kerja_id', $k->id)
                            ->whereIn('id', $current_subkegiatan_id)
                            ->where('rpjm_id', $rpjm['id'])
                            ->get();
                        foreach($sub_kegiatan as $sk){
                            $rkp = RKP::where('kegiatan_kerja_id', $sk->id)->first();
                            $anggaran = $sk->detailKegiatanKerjas->first()->jumlah_dana;
                            $realisasi = RealisasiBelanja::where('belanja_id', $rkp->id)->sum('jumlah');
                            $selisih = $anggaran - $realisasi;

                            $row['kode_1'] = $kode_belanja;
                            $row['kode_2'] = $kode_2_belanja;
                            $row['kode_3'] = $kode_3_belanja;
                            $row['kode_4'] = $kode_4_belanja;
                            $row['uraian'] = '<i class="fa fa-minus"></i> '.$sk->uraian;
                            $row['anggaran'] = number_format($anggaran, 2, ',', '.');
                            $row['realisasi'] = number_format($realisasi, 2, ',', '.');
                            $row['lebih_kurang'] = number_format($selisih, 2, ',', '.');
                            $row['keterangan'] = '';
                            $tabel[] = $row;

                            $jumlah_anggaran_belanja += $anggaran;
                            $jumlah_realisasi_belanja += $realisasi;
                        }
                        $kode_4_belanja++;
                    }
                    $kode_3_belanja++;
                }

                $kode_2_belanja++;
            }
            //==========================================================================================================
            $row['kode_1'] = '';
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = '';
            $row['anggaran'] = '';
            $row['realisasi'] = '';
            $row['lebih_kurang'] = '';
            $row['keterangan'] = '';
            $tabel[] = $row;

            $kode_pembiayaan = 3;
            $row['kode_1'] = $kode_pembiayaan;
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = '<b>PEMBIAYAAN</b>';
            $row['anggaran'] = '';
            $row['realisasi'] = '';
            $row['lebih_kurang'] = '';
            $row['keterangan'] = '';
            $tabel[] = $row;
            $bidang_pembiayaan = Bidang::where('jenis', 'pembiayaan')->get();
            $kode_2_pembiayaan = 1;
            $jumlah_anggaran_pembiayaan = 0;
            $jumlah_realisasi_pembiayaan = 0;
            foreach($bidang_pembiayaan as $bp){
                $row['kode_1'] = $kode_pembiayaan;
                $row['kode_2'] = $kode_2_pembiayaan;
                $row['kode_3'] = '';
                $row['kode_4'] = '';
                $row['uraian'] = $bp->nama;
                $row['anggaran'] = '';
                $row['realisasi'] = '';
                $row['lebih_kurang'] = '';
                $row['keterangan'] = '';
                $tabel[] = $row;
                $pembiayaan = Pembiayaan::where('tahun', $current_year)->where('bidang_id', $bp->id)->get();
                $kode_3_pembiayaan = 1;
                foreach($pembiayaan as $p){
                    $anggaran = $p->jumlah_dana;
                    $realisasi = RealisasiPembiayaan::where('pembiayaan_id', $p->id)->sum('jumlah');
                    $selisih = $anggaran - $realisasi;

                    $row['kode_1'] = $kode_pembiayaan;
                    $row['kode_2'] = $kode_2_pembiayaan;
                    $row['kode_3'] = $kode_3_pembiayaan;
                    $row['kode_4'] = '';
                    $row['uraian'] = $p->uraian;
                    $row['anggaran'] = number_format($anggaran, 2, ',', '.');
                    $row['realisasi'] = number_format($realisasi, 2, ',', '.');
                    $row['lebih_kurang'] = number_format($selisih, 2, ',', '.');
                    $row['keterangan'] = '';
                    $tabel[] = $row;
                    $kode_3_pembiayaan++;

                    $jumlah_anggaran_pembiayaan += $anggaran;
                    $jumlah_realisasi_pembiayaan += $realisasi;
                }
                $kode_2_pembiayaan++;

            }
            //==========================================================================================================
            $row['kode_1'] = '';
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = '';
            $row['anggaran'] = '';
            $row['realisasi'] = '';
            $row['lebih_kurang'] = '';
            $row['keterangan'] = '';
            $tabel[] = $row;

            $row['kode_1'] = '';
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = '<b>JUMLAH</b>';
            $row['anggaran'] = number_format($jumlah_anggaran_pendapatan + $jumlah_anggaran_belanja + $jumlah_anggaran_pembiayaan, 2, ',', '.');
            $row['realisasi'] = number_format($jumlah_realisasi_pendapatan + $jumlah_realisasi_belanja + $jumlah_realisasi_pembiayaan, 2, ',', '.');
            $row['lebih_kurang'] = number_format(($jumlah_anggaran_pendapatan + $jumlah_anggaran_belanja + $jumlah_anggaran_pembiayaan) - ($jumlah_realisasi_pendapatan + $jumlah_realisasi_belanja + $jumlah_realisasi_pembiayaan), 2, ',', '.');
            $row['keterangan'] = '';
            $tabel[] = $row;
            return response()->json(['data'=>$tabel]);
        }
        return view('content.pelaksanaan.apbd', compact('current_year'));
    }

    public function pelaksanaanExcel()
    {
        $current_year = Carbon::now()->year;
        $filename = 'apbd-realisasi-'.$current_year.'.xls';

        if(request()->wantsJson()){
            $tabel = [];
            //==========================================================================================================
            $kode_pendapatan = 1;
            $row['kode_1'] = $kode_pendapatan;
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = 'PENDAPATAN';
            $row['anggaran'] = '';
            $row['realisasi'] = '';
            $row['lebih_kurang'] = '';
            $row['keterangan'] = '';
            $tabel[] = $row;
            $bidang_pendapatan = Bidang::where('jenis', 'pendapatan')->get();
            $kode_2_pendapatan = 1;
            $jumlah_anggaran_pendapatan = 0;
            $jumlah_realisasi_pendapatan = 0;
            foreach($bidang_pendapatan as $bp){
                $row['kode_1'] = $kode_pendapatan;
                $row['kode_2'] = $kode_2_pendapatan;
                $row['kode_3'] = '';
                $row['kode_4'] = '';
                $row['uraian'] = $bp->nama;
                $row['anggaran'] = '';
                $row['realisasi'] = '';
                $row['lebih_kurang'] = '';
                $row['keterangan'] = '';
                $tabel[] = $row;

                $pendapatan_l1 = Pendapatan::where('tahun', $current_year)->where('bidang_id', $bp->id)->get();
                $kode_3_penadapatan = 1;
                foreach($pendapatan_l1 as $pl1){
                    $row['kode_1'] = $kode_pendapatan;
                    $row['kode_2'] = $kode_2_pendapatan;
                    $row['kode_3'] = $kode_3_penadapatan;
                    $row['kode_4'] = '';
                    $row['uraian'] = $pl1->uraian;
                    $row['anggaran'] = '';
                    $row['realisasi'] = '';
                    $row['lebih_kurang'] = '';
                    $row['keterangan'] = '';
                    $tabel[] = $row;

                    $pendapatan_l2 = Pendapatan::where('tahun', $current_year)->where('pendapatan_id', $pl1->id)->get();
                    $kode_4_penadapatan = 1;
                    foreach($pendapatan_l2 as $pl2){
                        $anggaran = $pl2->jumlah_dana;
                        $realisasi = RealisasiPendapatan::where('pendapatan_id', $pl2->id)->sum('jumlah');
                        $selisih = $anggaran - $realisasi;

                        $row['kode_1'] = $kode_pendapatan;
                        $row['kode_2'] = $kode_2_pendapatan;
                        $row['kode_3'] = $kode_3_penadapatan;
                        $row['kode_4'] = $kode_4_penadapatan;
                        $row['uraian'] = $pl2->uraian;
                        $row['anggaran'] = $anggaran;
                        $row['realisasi'] = $realisasi;
                        $row['lebih_kurang'] = $selisih;
                        $row['keterangan'] = '';
                        $tabel[] = $row;

                        $jumlah_anggaran_pendapatan += $anggaran;
                        $jumlah_realisasi_pendapatan += $realisasi;

                    }
                    $kode_3_penadapatan++;
                }
                $kode_2_pendapatan++;
            }
            //==========================================================================================================
            $row['kode_1'] = '';
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = '';
            $row['anggaran'] = '';
            $row['realisasi'] = '';
            $row['lebih_kurang'] = '';
            $row['keterangan'] = '';
            $tabel[] = $row;

            $rpjm = RPJM::all()->last();
            //subkegiatan - anak [id_parent] id = 43
            $subkegiatan_id = KegiatanKerja::whereHas('rkps', function($q) use($current_year){
                $q->where('tahun', $current_year);
            })->get()->pluck('kegiatan_kerja_id');

            //kegiatan - anak [id_parent] id =1
            $kegiatan_id = KegiatanKerja::whereHas('kerjas', function($query) use($subkegiatan_id){
                $query->where('jenis', 'level_3');
            })->whereIn('id', $subkegiatan_id)->get()->pluck('kegiatan_kerja_id');


            $current_subbidang_id = KegiatanKerja::whereHas('kerjas', function($query) use($kegiatan_id){
                $query->where('jenis', 'level_2');
            })->whereIn('id', $kegiatan_id)->get()->pluck('id');

            $current_kegiatan_id = KegiatanKerja::whereHas('kerjas', function($query) use($subkegiatan_id){
                $query->where('jenis', 'level_3');
            })->whereIn('id', $subkegiatan_id)->get()->pluck('id');

            $current_subkegiatan_id = KegiatanKerja::whereHas('rkps', function($q) use($current_year){
                $q->where('tahun', $current_year);
            })->get()->pluck('id');

            $kode_belanja = 2;
            $row['kode_1'] = $kode_belanja;
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = 'BELANJA';
            $row['anggaran'] = '';
            $row['realisasi'] = '';
            $row['lebih_kurang'] = '';
            $row['keterangan'] = '';
            $tabel[] = $row;
            $bidang_belanja = Bidang::where('jenis', 'belanja')->get();
            $kode_2_belanja = 1;
            $jumlah_anggaran_belanja = 0;
            $jumlah_realisasi_belanja = 0;
            foreach($bidang_belanja as $bb){
                $row['kode_1'] = $kode_belanja;
                $row['kode_2'] = $kode_2_belanja;
                $row['kode_3'] = '';
                $row['kode_4'] = '';
                $row['uraian'] = $bb->nama;
                $row['anggaran'] = '';
                $row['realisasi'] = '';
                $row['lebih_kurang'] = '';
                $row['keterangan'] = '';
                $tabel[] = $row;

                $subbidang = KegiatanKerja::where('jenis', 'level_1')
                    ->where('bidang_id', $bb->id)
                    ->whereIn('id', $current_subbidang_id)
                    ->where('rpjm_id', $rpjm['id'])
                    ->get();
                $kode_3_belanja = 1;
                foreach($subbidang as $sb){
                    $row['kode_1'] = $kode_belanja;
                    $row['kode_2'] = $kode_2_belanja;
                    $row['kode_3'] = $kode_3_belanja;
                    $row['kode_4'] = '';
                    $row['uraian'] = $sb->uraian;
                    $row['anggaran'] = '';
                    $row['realisasi'] = '';
                    $row['lebih_kurang'] = '';
                    $row['keterangan'] = '';
                    $tabel[] = $row;
                    $kegiatan = KegiatanKerja::where('jenis', 'level_2')
                        ->where('kegiatan_kerja_id', $sb->id)
                        ->whereIn('id', $current_kegiatan_id)
                        ->where('rpjm_id', $rpjm['id'])
                        ->get();
                    $kode_4_belanja =1;
                    foreach($kegiatan as $k){
                        $row['kode_1'] = $kode_belanja;
                        $row['kode_2'] = $kode_2_belanja;
                        $row['kode_3'] = $kode_3_belanja;
                        $row['kode_4'] = $kode_4_belanja;
                        $row['uraian'] = $k->uraian;
                        $row['anggaran'] = '';
                        $row['realisasi'] = '';
                        $row['lebih_kurang'] = '';
                        $row['keterangan'] = '';
                        $tabel[] = $row;
                        $sub_kegiatan = KegiatanKerja::where('jenis', 'level_3')
                            ->where('kegiatan_kerja_id', $k->id)
                            ->whereIn('id', $current_subkegiatan_id)
                            ->where('rpjm_id', $rpjm['id'])
                            ->get();
                        foreach($sub_kegiatan as $sk){
                            $rkp = RKP::where('kegiatan_kerja_id', $sk->id)->first();
                            $anggaran = $sk->detailKegiatanKerjas->first()->jumlah_dana;
                            $realisasi = RealisasiBelanja::where('belanja_id', $rkp->id)->sum('jumlah');
                            $selisih = $anggaran - $realisasi;

                            $row['kode_1'] = $kode_belanja;
                            $row['kode_2'] = $kode_2_belanja;
                            $row['kode_3'] = $kode_3_belanja;
                            $row['kode_4'] = $kode_4_belanja;
                            $row['uraian'] = '- '.$sk->uraian;
                            $row['anggaran'] = $anggaran;
                            $row['realisasi'] = $realisasi;
                            $row['lebih_kurang'] = $selisih;
                            $row['keterangan'] = '';
                            $tabel[] = $row;

                            $jumlah_anggaran_belanja += $anggaran;
                            $jumlah_realisasi_belanja += $realisasi;
                        }
                        $kode_4_belanja++;
                    }
                    $kode_3_belanja++;
                }

                $kode_2_belanja++;
            }
            //==========================================================================================================
            $row['kode_1'] = '';
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = '';
            $row['anggaran'] = '';
            $row['realisasi'] = '';
            $row['lebih_kurang'] = '';
            $row['keterangan'] = '';
            $tabel[] = $row;

            $kode_pembiayaan = 3;
            $row['kode_1'] = $kode_pembiayaan;
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = 'PEMBIAYAAN';
            $row['anggaran'] = '';
            $row['realisasi'] = '';
            $row['lebih_kurang'] = '';
            $row['keterangan'] = '';
            $tabel[] = $row;
            $bidang_pembiayaan = Bidang::where('jenis', 'pembiayaan')->get();
            $kode_2_pembiayaan = 1;
            $jumlah_anggaran_pembiayaan = 0;
            $jumlah_realisasi_pembiayaan = 0;
            foreach($bidang_pembiayaan as $bp){
                $row['kode_1'] = $kode_pembiayaan;
                $row['kode_2'] = $kode_2_pembiayaan;
                $row['kode_3'] = '';
                $row['kode_4'] = '';
                $row['uraian'] = $bp->nama;
                $row['anggaran'] = '';
                $row['realisasi'] = '';
                $row['lebih_kurang'] = '';
                $row['keterangan'] = '';
                $tabel[] = $row;
                $pembiayaan = Pembiayaan::where('tahun', $current_year)->where('bidang_id', $bp->id)->get();
                $kode_3_pembiayaan = 1;
                foreach($pembiayaan as $p){
                    $anggaran = $p->jumlah_dana;
                    $realisasi = RealisasiPembiayaan::where('pembiayaan_id', $p->id)->sum('jumlah');
                    $selisih = $anggaran - $realisasi;

                    $row['kode_1'] = $kode_pembiayaan;
                    $row['kode_2'] = $kode_2_pembiayaan;
                    $row['kode_3'] = $kode_3_pembiayaan;
                    $row['kode_4'] = '';
                    $row['uraian'] = $p->uraian;
                    $row['anggaran'] = $anggaran;
                    $row['realisasi'] = $realisasi;
                    $row['lebih_kurang'] = $selisih;
                    $row['keterangan'] = '';
                    $tabel[] = $row;
                    $kode_3_pembiayaan++;

                    $jumlah_anggaran_pembiayaan += $anggaran;
                    $jumlah_realisasi_pembiayaan += $realisasi;
                }
                $kode_2_pembiayaan++;

            }
            //==========================================================================================================
            $row['kode_1'] = '';
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = '';
            $row['anggaran'] = '';
            $row['realisasi'] = '';
            $row['lebih_kurang'] = '';
            $row['keterangan'] = '';
            $tabel[] = $row;

            $row['kode_1'] = '';
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = 'JUMLAH';
            $row['anggaran'] = $jumlah_anggaran_pendapatan + $jumlah_anggaran_belanja + $jumlah_anggaran_pembiayaan;
            $row['realisasi'] = $jumlah_realisasi_pendapatan + $jumlah_realisasi_belanja + $jumlah_realisasi_pembiayaan;
            $row['lebih_kurang'] = ($jumlah_anggaran_pendapatan + $jumlah_anggaran_belanja + $jumlah_anggaran_pembiayaan) - ($jumlah_realisasi_pendapatan + $jumlah_realisasi_belanja + $jumlah_realisasi_pembiayaan);
            $row['keterangan'] = '';
            $tabel[] = $row;
            //----------------------------------------------------------------------------------------------------------
            $template = resource_path('assets/template-laporan/buku-realisasi-anggaran.xls');

            $objReader = PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($template);

            //--------------- Header
            $kota = ProfilDesa::find('kab')['value'];
            $namaKota = ProfilDesa::find('kota')['value'];
            $namaKecamatan = ProfilDesa::find('kecamatan')['value'];
            $desa = ProfilDesa::find('des')['value'];
            $namaDesa = ProfilDesa::find('nama_desa')['value'];
            $alamatDesa = ProfilDesa::find('alamat_desa')['value'];
            $teleponDesa = ProfilDesa::find('telepon')['value'];
            $kodePos = ProfilDesa::find('kode_pos')['value'];

            $a4 = $alamatDesa.' Kecamatan '.$namaKecamatan.' '.$kota.' '.$namaKota.', Telp.'.$teleponDesa.', Kode Pos '.$kodePos;
            $objPHPExcel->getActiveSheet()->setCellValue('A1', strtoupper('Pemerintahan '.$kota.' '.$namaKota));
            $objPHPExcel->getActiveSheet()->setCellValue('A2', strtoupper('Kecamatan '.$namaKecamatan));
            $objPHPExcel->getActiveSheet()->setCellValue('A3', strtoupper('Kantor '.$desa.' '.$namaDesa));
            $objPHPExcel->getActiveSheet()->setCellValue('A4', ucfirst($a4));
            $objPHPExcel->getActiveSheet()->setCellValue('A7', strtoupper('Tahun Anggaran '.$current_year));
            //---------------End Header

            $baseRow = 12;
            $j = 0;
            foreach($tabel as $t){
                $row_excel = $baseRow + $j;

                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_excel, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row_excel, $t['kode_1'])
                    ->setCellValue('B' . $row_excel, $t['kode_2'])
                    ->setCellValue('C' . $row_excel, $t['kode_3'])
                    ->setCellValue('D' . $row_excel, $t['kode_4'])
                    ->setCellValue('E' . $row_excel, $t['uraian'])
                    ->setCellValue('F' . $row_excel, $t['anggaran'])
                    ->setCellValue('G' . $row_excel, $t['realisasi'])
                    ->setCellValue('H' . $row_excel, $t['lebih_kurang'])
                    ->setCellValue('I' . $row_excel, $t['keterangan']);
                $j++;
            }
            $objPHPExcel->getActiveSheet()->removeRow($baseRow - 1, 1);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('file-laporan/'.$filename);

            return response()->json([
                'message' => 'Data Berhasil diExport'
            ], 201);
        }
        //download
        return response()->download(public_path('file-laporan/'.$filename));
    }


}
