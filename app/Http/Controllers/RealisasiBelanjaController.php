<?php

namespace App\Http\Controllers;

use App\Entities\Bidang;
use App\Entities\DetailKegiatanKerja;
use App\Entities\KegiatanKerja;
use App\Entities\RKP;
use App\Entities\RPJM;
use App\Entities\RealisasiBelanja;
use App\Validators\RealisasiPendapatanValidator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class RealisasiBelanjaController extends Controller
{
    protected $validator;

    public function __construct(RealisasiPendapatanValidator $validator)
    {
        $this->validator = $validator;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_year = Carbon::now()->year;
        $bidang = Bidang::where('jenis', 'belanja')->get();
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

        if(request()->wantsJson()){
            $tabel = [];

            $kode_belanja = 2;
            $row['kode_1'] = $kode_belanja;
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = '<b>PENDAPATAN</b>';
            $row['anggaran'] = '';
            $row['realisasi'] = '';
            $row['lebih_kurang'] = '';
            $row['keterangan'] = '';
            $tabel[] = $row;

            //----------------------------------------------------------------------------------------------------------
            $jumlah_belanja = 0;
            $jumlah_realisasi = 0;
            $kode_2 = 1;
            foreach($bidang as $b){
                $row['kode_1'] = $kode_belanja;
                $row['kode_2'] = $kode_2;
                $row['kode_3'] = '';
                $row['kode_4'] = '';
                $row['uraian'] = '<b><i>'.'<a href="'.route('pelaksanaan.apbd.belanja.bidang', $b->id).'">'.$b->nama.'</a>'.'</i></b>';
                $row['anggaran'] = '';
                $row['realisasi'] = '';
                $row['lebih_kurang'] = '';
                $row['keterangan'] = '';
                $tabel[] = $row;
                //------------------------------------------------------------------------------------------------------
                $subbidang = KegiatanKerja::where('jenis', 'level_1')
                    ->where('bidang_id', $b['id'])
                    ->whereIn('id', $current_subbidang_id)
                    ->where('rpjm_id', $rpjm['id'])
                    ->get();
                $kode_3 = 1;
                foreach($subbidang as $sb){
                    $row['kode_1'] = $kode_belanja;
                    $row['kode_2'] = $kode_2;
                    $row['kode_3'] = $kode_3;
                    $row['kode_4'] = '';
                    $row['uraian'] = '<a href="'.route('pelaksanaan.apbd.belanja.subbidang', $sb->id).'">'.$sb->uraian.'</a>';
                    $row['anggaran'] = '';
                    $row['realisasi'] = '';
                    $row['lebih_kurang'] = '';
                    $row['keterangan'] = '';
                    $tabel[] = $row;
                    //--------------------------------------------------------------------------------------------------
                    $kegiatan = KegiatanKerja::where('jenis', 'level_2')
                        ->where('kegiatan_kerja_id', $sb->id)
                        ->whereIn('id', $current_kegiatan_id)
                        ->where('rpjm_id', $rpjm['id'])
                        ->get();
                    $kode_4 = 1;
                    foreach($kegiatan as $k){
                        $row['kode_1'] = $kode_belanja;
                        $row['kode_2'] = $kode_2;
                        $row['kode_3'] = $kode_3;
                        $row['kode_4'] = $kode_4;
                        $row['uraian'] = '<a href="'.route('pelaksanaan.apbd.belanja.kegiatan', $k->id).'">'.$k->uraian.'</a>';
                        $row['anggaran'] = '';
                        $row['realisasi'] = '';
                        $row['lebih_kurang'] = '';
                        $row['keterangan'] = '';
                        $tabel[] = $row;
                        //----------------------------------------------------------------------------------------------
                        $sub_kegiatan = KegiatanKerja::where('jenis', 'level_3')
                            ->where('kegiatan_kerja_id', $k->id)
                            ->whereIn('id', $current_subkegiatan_id)
                            ->where('rpjm_id', $rpjm['id'])
                            ->get();
                        foreach($sub_kegiatan as $sk){
                            $rkp = RKP::where('kegiatan_kerja_id', $sk->id)->first();
                            $anggaran = $sk->detailKegiatanKerjas->first()->jumlah_dana;
                            $realisasi = RealisasiBelanja::where('belanja_id', $rkp->id)->sum('jumlah');

                            $row['kode_1'] = '';
                            $row['kode_2'] = '';
                            $row['kode_3'] = '';
                            $row['kode_4'] = '';
                            $row['uraian'] = '<a href="'.route('pelaksanaan.apbd.belanja.subkegiatan', $sk->id).'"><i class="fa fa-minus"></i> '.$sk->uraian.'</a>';
                            $row['anggaran'] = number_format($anggaran, 2, ',', '.');
                            $row['realisasi'] = number_format($realisasi, 2, ',', '.');
                            $row['lebih_kurang'] = number_format($anggaran - $realisasi, 2, ',', '.');
                            $row['keterangan'] = '';
                            $tabel[] = $row;
                            $jumlah_belanja += (int) $sk->detailKegiatanKerjas->first()->jumlah_dana;
                            $jumlah_realisasi += $realisasi;
                        }
                        //----------------------------------------------------------------------------------------------
                        $kode_4++;
                    }
                    //--------------------------------------------------------------------------------------------------
                    $kode_3++;
                }
                //------------------------------------------------------------------------------------------------------
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
                $kode_2++;
            }
            //----------------------------------------------------------------------------------------------------------
            $row['kode_1'] = '';
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = '<b>JUMLAH</b>';
            $row['anggaran'] = number_format($jumlah_belanja, 2, ',', '.');
            $row['realisasi'] = number_format($jumlah_realisasi, 2, ',', '.');
            $row['lebih_kurang'] = number_format($jumlah_belanja - $jumlah_realisasi, 2, ',', '.');
            $row['keterangan'] = '';
            $tabel[] = $row;

            return response()->json(['data'=>$tabel], 200);
        }

        return view('content.pelaksanaan.belanja', compact('current_year'));
    }

    public function bidang($id)
    {
        $current_year = Carbon::now()->year;
        $bidang = Bidang::where('jenis', 'belanja')->where('id', $id)->get();
        $rpjm = RPJM::all()->last();
        //$tahun = Carbon::createFromDate($rpjm['tahun_awal'])->addYears($id-1)->year;

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
        })->whereIn('id', $kegiatan_id)->get();

        $current_kegiatan_id = KegiatanKerja::whereHas('kerjas', function($query) use($subkegiatan_id){
            $query->where('jenis', 'level_3');
        })->whereIn('id', $subkegiatan_id)->get();

        $current_subkegiatan_id = KegiatanKerja::whereHas('rkps', function($q) use($current_year){
            $q->where('tahun', $current_year);
        })->get();

        //RKP BY Bidang
        $subbidang = KegiatanKerja::where('bidang_id', $id)->whereIn('id', $current_subbidang_id->pluck('id'))->get();
        $anaksubkegiatan = KegiatanKerja::whereIn('kegiatan_kerja_id', $subbidang->pluck('id'))
            ->whereIn('id', $current_kegiatan_id->pluck('id'))->get();
        $anaksubsubkegiatan = KegiatanKerja::whereIn('kegiatan_kerja_id', $anaksubkegiatan->pluck('id'))->get();//anu boga rkp id -sub kegiatan
        $rkp = RKP::whereIn('kegiatan_kerja_id', $anaksubsubkegiatan->pluck('id'))->get();

        $filter_kegiatan = KegiatanKerja::whereIn('id', $rkp->pluck('kegiatan_kerja_id'))->get();
        $filter_detail_kegiatan = DetailKegiatanKerja::whereIn('kegiatan_kerja_id', $filter_kegiatan->pluck('id'))->get();//anggaran
        $realisasi_anggaran = RealisasiBelanja::whereIn('belanja_id', $rkp->pluck('id'));

        $anggaran = $filter_detail_kegiatan->sum('jumlah_dana');
        $realisasi = $realisasi_anggaran->sum('jumlah');


        if(request()->wantsJson()){
            $row['index'] = 'Uraian';
            $row['value']  = $bidang->first()->nama;
            $table['info'][] = $row;
            $row['index'] = 'Anggaran';
            $row['value']  = 'Rp.'.number_format($anggaran, 2, ',', '.');
            $table['info'][] = $row;
            $row['index'] = 'Realisasi';
            $row['value']  = 'Rp.'.number_format($realisasi, 2, ',', '.');
            $table['info'][] = $row;
            $row['index'] = 'Selisih';
            $row['value']  = 'Rp.'.number_format($anggaran-$realisasi, 2, ',', '.');
            $table['info'][] = $row;

            $jumlah = 0;
            foreach($realisasi_anggaran->get() as $r) {
                $row['file']  = '<a href="'.url('img/bukti-pembayaran/belanja/'.$r->file).'" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-search-plus"></i> </a>';
                $row['metode'] = $r->metode;
                $row['tanggal'] = Carbon::parse($r->tanggal)->format('d M Y');
                $row['uraian'] = $r->uraian;
                $row['nomor_bukti'] = $r->nomor_bukti;
                $row['jumlah'] = 'Rp.' . number_format($r->jumlah, 2, ',', '.');
                $table['rincian'][] = $row;
                $jumlah += $r->jumlah;
            }
            $row['file']  = '';
            $row['metode']      = '';
            $row['tanggal']     = '';
            $row['uraian']      = '';
            $row['nomor_bukti'] = '';
            $row['jumlah']      = '<b>Rp.'.number_format($jumlah, 2, ',', '.').'</b>';
            $table['rincian'][] = $row;


            $control['anggaran'] = $anggaran;
            $control['realisasi'] = $realisasi;
            $control['selisih'] = $anggaran - $realisasi;

            $control['anggaran_progress_bar'] = '100%';
            $control['realisasi_progress_bar'] = '100%';
            $control['selisih_progress_bar'] = '100%';

            $control['anggaran_progress_description'] = 'Anggaran';
            $control['realisasi_progress_description'] = 'Realisasi';
            $control['selisih_progress_description'] = 'Selisih';
            return response()->json(['data'=>$table, 'control'=>$control]);
        }
        return view('content.pelaksanaan.belanja.bidang');
    }

    public function subbidang($id)
    {
        $current_year = Carbon::now()->year;
        $bidang = Bidang::where('jenis', 'belanja')->get();
        $rpjm = RPJM::all()->last();
        //$tahun = Carbon::createFromDate($rpjm['tahun_awal'])->addYears($id-1)->year;

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
        })->whereIn('id', $kegiatan_id)->get();

        $current_kegiatan_id = KegiatanKerja::whereHas('kerjas', function($query) use($subkegiatan_id){
            $query->where('jenis', 'level_3');
        })->whereIn('id', $subkegiatan_id)->get();

        $current_subkegiatan_id = KegiatanKerja::whereHas('rkps', function($q) use($current_year){
            $q->where('tahun', $current_year);
        })->get();

        //RKP BY Sub Bidang
        $subbidang = KegiatanKerja::whereIn('id', $current_subbidang_id->pluck('id'))->where('id', $id)->get();
        $anaksubkegiatan = KegiatanKerja::whereIn('kegiatan_kerja_id', $subbidang->pluck('id'))
            ->whereIn('id', $current_kegiatan_id->pluck('id'))->get();
        $anaksubsubkegiatan = KegiatanKerja::whereIn('kegiatan_kerja_id', $anaksubkegiatan->pluck('id'))->get();//anu boga rkp id -sub kegiatan
        $rkp = RKP::whereIn('kegiatan_kerja_id', $anaksubsubkegiatan->pluck('id'))->get();

        $filter_kegiatan = KegiatanKerja::whereIn('id', $rkp->pluck('kegiatan_kerja_id'))->get();
        $filter_detail_kegiatan = DetailKegiatanKerja::whereIn('kegiatan_kerja_id', $filter_kegiatan->pluck('id'))->get();//anggaran
        $realisasi_anggaran = RealisasiBelanja::whereIn('belanja_id', $rkp->pluck('id'));

        $anggaran = $filter_detail_kegiatan->sum('jumlah_dana');
        $realisasi = $realisasi_anggaran->sum('jumlah');


        if(request()->wantsJson()){
            $row['index'] = 'Uraian';
            $row['value']  = $subbidang->first()->uraian;
            $table['info'][] = $row;
            $row['index'] = 'Anggaran';
            $row['value']  = 'Rp.'.number_format($anggaran, 2, ',', '.');
            $table['info'][] = $row;
            $row['index'] = 'Realisasi';
            $row['value']  = 'Rp.'.number_format($realisasi, 2, ',', '.');
            $table['info'][] = $row;
            $row['index'] = 'Selisih';
            $row['value']  = 'Rp.'.number_format($anggaran-$realisasi, 2, ',', '.');
            $table['info'][] = $row;

            $jumlah = 0;
            foreach($realisasi_anggaran->get() as $r) {
                $row['file']  = '<a href="'.url('img/bukti-pembayaran/belanja/'.$r->file).'" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-search-plus"></i> </a>';
                $row['metode'] = $r->metode;
                $row['tanggal'] = Carbon::parse($r->tanggal)->format('d M Y');
                $row['uraian'] = $r->uraian;
                $row['nomor_bukti'] = $r->nomor_bukti;
                $row['jumlah'] = 'Rp.' . number_format($r->jumlah, 2, ',', '.');
                $table['rincian'][] = $row;
                $jumlah += $r->jumlah;
            }
            $row['file']  = '';
            $row['metode']      = '';
            $row['tanggal']     = '';
            $row['uraian']      = '';
            $row['nomor_bukti'] = '';
            $row['jumlah']      = '<b>Rp.'.number_format($jumlah, 2, ',', '.').'</b>';
            $table['rincian'][] = $row;


            $control['anggaran'] = $anggaran;
            $control['realisasi'] = $realisasi;
            $control['selisih'] = $anggaran - $realisasi;

            $control['anggaran_progress_bar'] = '100%';
            $control['realisasi_progress_bar'] = '100%';
            $control['selisih_progress_bar'] = '100%';

            $control['anggaran_progress_description'] = 'Anggaran';
            $control['realisasi_progress_description'] = 'Realisasi';
            $control['selisih_progress_description'] = 'Selisih';

            return response()->json(['data'=>$table, 'control'=>$control]);
        }
        return view('content.pelaksanaan.belanja.subbidang');
    }

    public function kegiatan($id)
    {
        $current_year = Carbon::now()->year;
        $bidang = Bidang::where('jenis', 'belanja')->get();
        $rpjm = RPJM::all()->last();
        //$tahun = Carbon::createFromDate($rpjm['tahun_awal'])->addYears($id-1)->year;

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
        })->whereIn('id', $kegiatan_id)->get();

        $current_kegiatan_id = KegiatanKerja::whereHas('kerjas', function($query) use($subkegiatan_id){
            $query->where('jenis', 'level_3');
        })->whereIn('id', $subkegiatan_id)->get()->pluck('id');

        $current_subkegiatan_id = KegiatanKerja::whereHas('rkps', function($q) use($current_year){
            $q->where('tahun', $current_year);
        })->get();

        //RKP BY ID KEGIATAN
        $kegiatan = KegiatanKerja::whereIn('id', $current_kegiatan_id)->where('id', $id)->get();
        $anak_kegiatan = KegiatanKerja::whereIn('kegiatan_kerja_id', $kegiatan->pluck('id'))->get()->pluck('id');//anu boga rkp id -sub kegiatan
        $rkp = RKP::whereIn('kegiatan_kerja_id', $anak_kegiatan)->get();

        $filter_kegiatan = KegiatanKerja::whereIn('id', $rkp->pluck('kegiatan_kerja_id'))->get()->pluck('id');
        $filter_detail_kegiatan = DetailKegiatanKerja::whereIn('kegiatan_kerja_id', $filter_kegiatan);//anggaran
        $realisasi_anggaran = RealisasiBelanja::whereIn('belanja_id', $rkp->pluck('id'));

        $anggaran = $filter_detail_kegiatan->sum('jumlah_dana');
        $realisasi = $realisasi_anggaran->sum('jumlah');

        if(request()->wantsJson()){


            $row['index'] = 'Uraian';
            $row['value']  = $kegiatan->first()->uraian;
            $table['info'][] = $row;
            $row['index'] = 'Anggaran';
            $row['value']  = 'Rp.'.number_format($anggaran, 2, ',', '.');
            $table['info'][] = $row;
            $row['index'] = 'Realisasi';
            $row['value']  = 'Rp.'.number_format($realisasi, 2, ',', '.');
            $table['info'][] = $row;
            $row['index'] = 'Selisih';
            $row['value']  = 'Rp.'.number_format($anggaran-$realisasi, 2, ',', '.');
            $table['info'][] = $row;

            $jumlah = 0;
            foreach($realisasi_anggaran->get() as $r) {
                $row['file']  = '<a href="'.url('img/bukti-pembayaran/belanja/'.$r->file).'" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-search-plus"></i> </a>';
                $row['metode'] = $r->metode;
                $row['tanggal'] = Carbon::parse($r->tanggal)->format('d M Y');
                $row['uraian'] = $r->uraian;
                $row['nomor_bukti'] = $r->nomor_bukti;
                $row['jumlah'] = 'Rp.' . number_format($r->jumlah, 2, ',', '.');
                $table['rincian'][] = $row;
                $jumlah += $r->jumlah;
            }
            $row['file']  = '';
            $row['metode']      = '';
            $row['tanggal']     = '';
            $row['uraian']      = '';
            $row['nomor_bukti'] = '';
            $row['jumlah']      = '<b>Rp.'.number_format($jumlah, 2, ',', '.').'</b>';
            $table['rincian'][] = $row;


            $control['anggaran'] = $anggaran;
            $control['realisasi'] = $realisasi;
            $control['selisih'] = $anggaran - $realisasi;

            $control['anggaran_progress_bar'] = '100%';
            $control['realisasi_progress_bar'] = '100%';
            $control['selisih_progress_bar'] = '100%';

            $control['anggaran_progress_description'] = 'Anggaran';
            $control['realisasi_progress_description'] = 'Realisasi';
            $control['selisih_progress_description'] = 'Selisih';

            return response()->json(['data'=>$table, 'control'=>$control]);
        }
        return view('content.pelaksanaan.belanja.kegiatan', compact('id_rkp'));
    }

    public function subkegiatan($id)
    {
        $rkp = RKP::where('kegiatan_kerja_id', $id)->first();
        $belanja = KegiatanKerja::find($id);
        $anggaran = $belanja->detailKegiatanKerjas->first()->jumlah_dana;
        $realisasi = RealisasiBelanja::where('belanja_id', $rkp->id)->sum('jumlah');

        $id_rkp = $rkp->id;

        if(request()->wantsJson()){


            $row['index'] = 'Uraian';
            $row['value']  = $belanja->uraian;
            $table['info'][] = $row;
            $row['index'] = 'Anggaran';
            $row['value']  = 'Rp.'.number_format($anggaran, 2, ',', '.');
            $table['info'][] = $row;
            $row['index'] = 'Realisasi';
            $row['value']  = 'Rp.'.number_format($realisasi, 2, ',', '.');
            $table['info'][] = $row;
            $row['index'] = 'Selisih';
            $row['value']  = 'Rp.'.number_format($anggaran - $realisasi, 2, ',', '.');
            $table['info'][] = $row;

            $realisasi_anggaran = RealisasiBelanja::where('belanja_id', $id_rkp)->orderBy('tanggal', 'desc')->get();
            $jumlah = 0;
            foreach($realisasi_anggaran as $r){
                $row['file']        = '<a href="'.url('img/bukti-pembayaran/belanja/'.$r->file).'" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-search-plus"></i> </a>';
                $row['id']          = $r->id;
                $row['metode']      = $r->metode;
                $row['tanggal']     = Carbon::parse($r->tanggal)->format('d M Y');
                $row['uraian']      = $r->uraian;
                $row['nomor_bukti'] = $r->nomor_bukti;
                $row['jumlah']      = 'Rp.'.number_format($r->jumlah, 2, ',', '.');
                $table['rincian'][] = $row;
                $jumlah += $r->jumlah;
            }
            $row['file']  = '';
            $row['metode']      = '';
            $row['tanggal']     = '';
            $row['uraian']      = '';
            $row['nomor_bukti'] = '';
            $row['jumlah']      = '<b>Rp.'.number_format($jumlah, 2, ',', '.').'</b>';
            $table['rincian'][] = $row;

            $control['anggaran'] = $anggaran;
            $control['realisasi'] = $realisasi;
            $control['selisih'] = $anggaran - $realisasi;

            $control['anggaran_progress_bar'] = '20%';
            $control['realisasi_progress_bar'] = '30%';
            $control['selisih_progress_bar'] = '50%';

            $control['anggaran_progress_description'] = 'Anggaran';
            $control['realisasi_progress_description'] = 'Realisasi';
            $control['selisih_progress_description'] = 'Selisih';

            return response()->json(['data'=>$table, 'control'=>$control], 200);
        }
        return view('content.pelaksanaan.belanja.subkegiatan', compact('id', 'id_rkp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'bukti'        => 'required|mimes:png,jpg,jpeg',
//            'nomor_bukti' => 'required',
//            'tanggal'     => 'required',
//            'metode'      => 'required',
//            'uraian'      => 'required',
//            'jumlah'      => 'required'
        ]);

        if(request()->wantsJson()){
            $file = NULL;
            if($request->bukti){
                $extension = $request->file('bukti')->getClientOriginalExtension();
                $fileName = rand(11111,99999).'.'.$extension; // renameing image$gambar = microtime();

//                    unlink(public_path() . '/img/slider/'.$slider->bukti);
                $request->file('bukti')->move(
                    public_path() . '/img/bukti-pembayaran/belanja/', $fileName
                );

                $file = $fileName;
            }

            $tambah = [
                'file'          => ($file) ? $file : NULL,
                'nomor_bukti'   => $request->nomor_bukti,
                'tanggal'       => $request->tanggal,
                'metode'        => $request->metode,
                'uraian'        => $request->uraian,
                'jumlah'        => $request->jumlah,
                'belanja_id' => $request->pendapatan_id,
            ];
            RealisasiBelanja::create($tambah);
            return response()->json(['message'=>'Rincian Realisasi Berhasil Ditambahkan'], 201);
        }
//        try{
////            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
//            $this->validate($request, [
//                'file'        => 'mimies:jpg,png,jpeg',
//                'nomor_bukti' => 'required',
//                'tanggal'     => 'required',
//                'metode'      => 'required',
//                'uraian'      => 'required',
//                'jumlah'      => 'required'
//            ]);
//
//            if(request()->wantsJson()){
//                $file = NULL;
//                if($request->bukti){
//                    $extension = $request->file('bukti')->getClientOriginalExtension();
//                    $fileName = rand(11111,99999).'.'.$extension; // renameing image$gambar = microtime();
//
////                    unlink(public_path() . '/img/slider/'.$slider->bukti);
//                    $request->file('bukti')->move(
//                        public_path() . '/img/bukti-pembayaran/belanja/', $fileName
//                    );
//
//                    $file = $fileName;
//                }
//
//                $tambah = [
//                    'file'          => ($file) ? $file : NULL,
//                    'nomor_bukti'   => $request->nomor_bukti,
//                    'tanggal'       => $request->tanggal,
//                    'metode'        => $request->metode,
//                    'uraian'        => $request->uraian,
//                    'jumlah'        => $request->jumlah,
//                    'belanja_id' => $request->pendapatan_id,
//                ];
//                RealisasiBelanja::create($tambah);
//                return response()->json(['message'=>'Rincian Realisasi Berhasil Ditambahkan'], 201);
//            }
//
//        }catch (ValidatorException $e){
//            if ($request->wantsJson()) {
//                return response()->json([
//                    'error'   => true,
//                    'message' => $e->getMessageBag()
//                ], 422);
//            }
//        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RealisasiBelanja  $realisasiBelanja
     * @return \Illuminate\Http\Response
     */
    public function show($id, RealisasiBelanja $realisasiBelanja)
    {
        if(request()->wantsJson()){

            return response()->json([
                $realisasiBelanja->find($id)->first()
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RealisasiBelanja  $realisasiBelanja
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, RealisasiBelanja $realisasiBelanja)
    {
        try{
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            if(request()->wantsJson()){
                $ubah = [
                    'nomor_bukti'   => $request->nomor_bukti,
                    'tanggal'       => $request->tanggal,
                    'metode'        => $request->metode,
                    'uraian'        => $request->uraian,
                    'jumlah'        => $request->jumlah,
                ];

                $realisasiBelanja->find($id)->update($ubah);
                return response()->json(['message'=>'Rincian Realisasi Berhasil Diubah'], 201);
            }

        }catch (ValidatorException $e){
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ], 422);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RealisasiBelanja  $realisasiBelanja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, RealisasiBelanja $realisasiBelanja)
    {
        if(request()->wantsJson()){
            try{
                $realisasiBelanja->find($id)->delete();
                return response()->json([
                    'message' => 'Pembiayaan deleted.',
                ]);
            }catch (QueryException $e){
                return response()->json([
                    'error'   => true,
                    'message' => 'Data Tidak Bisa Dihapus',
                    'exeption' => $e->errorInfo,
                ], 500);
            }
        }
    }
}
