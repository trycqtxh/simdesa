<?php

namespace App\Http\Controllers;

use App\Criteria\BalitaCriteria;
use App\Criteria\BelajarCriteria;
use App\Criteria\PemiluCriteria;
use App\Entities\AnggotaKeluarga;
use App\Entities\ProfilDesa;
use App\Entities\RT;
use App\Entities\RW;
use App\Presenters\KelompokPendudukPresenter;
use App\Repositories\PendudukRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Penduduk;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use PDO;
use PHPExcel_IOFactory;


class PendudukController extends Controller
{
    protected $repository;

    public function __construct(PendudukRepository $repository){
        $this->repository = $repository;
    }

    public function rekapitulasi(Penduduk $penduduk)
    {
        if(request()->wantsJson()){
            $table = [];
            $rw = RW::all();
            $i = 1;

            foreach($rw as $wr){
                $row_rw = [];
                $row_rw['no'] = $i++;
                $row_rw['nama_rw'] = 'RW '.$wr->nama;

                $row_rw['awal_bulan_wna_l'] = $this->rekap_awal_bulan($wr, 'WNA', 'L');
                $row_rw['awal_bulan_wna_p'] = $this->rekap_awal_bulan($wr, 'WNA', 'P');
                $row_rw['awal_bulan_wni_l'] = $this->rekap_awal_bulan($wr, 'WNI', 'L');
                $row_rw['awal_bulan_wni_p'] = $this->rekap_awal_bulan($wr, 'WNI', 'P');

                $row_rw['awal_bulan_jml_kk'] = $this->rekap_awal_bulan_kk($wr);
                $row_rw['awal_bulan_jml_anggota_kk'] = $this->rekap_awal_bulan_anggota_kk($wr);
                $row_rw['awal_bulan_jml_jiwa'] = $this->rekap_awal_bulan_kk($wr)+$this->rekap_awal_bulan_anggota_kk($wr);

                $row_rw['tambah_bulan_wna_lahir_l'] = $this->lahir($wr, 'WNA', 'L');
                $row_rw['tambah_bulan_wna_lahir_p'] = $this->lahir($wr, 'WNA', 'P');
                $row_rw['tambah_bulan_wni_lahir_l'] = $this->lahir($wr, 'WNI', 'L');
                $row_rw['tambah_bulan_wni_lahir_p'] = $this->lahir($wr, 'WNI', 'P');
                $row_rw['tambah_bulan_wna_datang_l'] = $this->datang($wr, 'WNA', 'L');
                $row_rw['tambah_bulan_wna_datang_p'] = $this->datang($wr, 'WNA', 'P');
                $row_rw['tambah_bulan_wni_datang_l'] = $this->datang($wr, 'WNI', 'L');
                $row_rw['tambah_bulan_wni_datang_p'] = $this->datang($wr, 'WNI', 'P');

                $row_rw['kurang_bulan_wna_meninggal_l'] = $this->mati($wr, 'WNA', 'L');
                $row_rw['kurang_bulan_wna_meninggal_p'] = $this->mati($wr, 'WNA', 'P');
                $row_rw['kurang_bulan_wni_meninggal_l'] = $this->mati($wr, 'WNI', 'L');
                $row_rw['kurang_bulan_wni_meninggal_p'] = $this->mati($wr, 'WNI', 'P');
                $row_rw['kurang_bulan_wna_pindah_l'] = $this->keluar($wr, 'WNA', 'L');
                $row_rw['kurang_bulan_wna_pindah_p'] = $this->keluar($wr, 'WNA', 'P');
                $row_rw['kurang_bulan_wni_pindah_l'] = $this->keluar($wr, 'WNI', 'L');
                $row_rw['kurang_bulan_wni_pindah_p'] = $this->keluar($wr, 'WNI', 'P');

                $row_rw['akhir_bulan_wna_l'] = $this->rekap_awal_bulan($wr, 'WNA', 'L') + $this->lahir($wr, 'WNA', 'L') + $this->datang($wr, 'WNA', 'L') - $this->mati($wr, 'WNA', 'L') - $this->keluar($wr, 'WNA', 'L');
                $row_rw['akhir_bulan_wna_p'] = $this->rekap_awal_bulan($wr, 'WNA', 'P') + $this->lahir($wr, 'WNA', 'P') + $this->datang($wr, 'WNA', 'P') - $this->mati($wr, 'WNA', 'P') - $this->keluar($wr, 'WNA', 'P');
                $row_rw['akhir_bulan_wni_l'] = $this->rekap_awal_bulan($wr, 'WNI', 'L') + $this->lahir($wr, 'WNI', 'L') + $this->datang($wr, 'WNI', 'L') - $this->mati($wr, 'WNI', 'L') - $this->keluar($wr, 'WNI', 'L');
                $row_rw['akhir_bulan_wni_p'] = $this->rekap_awal_bulan($wr, 'WNI', 'P') + $this->lahir($wr, 'WNI', 'P') + $this->datang($wr, 'WNI', 'P') - $this->mati($wr, 'WNI', 'P') - $this->keluar($wr, 'WNI', 'P');

                $row_rw['akhir_bulan_jml_kk'] = $this->rekap_akhir_bulan_kk($wr);
                $row_rw['akhir_bulan_jml_anggota_kk'] = $this->rekap_akhir_bulan_anggota_kk($wr);
                $row_rw['akhir_bulan_jml_jiwa'] = $this->rekap_akhir_bulan_kk($wr)+$this->rekap_akhir_bulan_anggota_kk($wr);
                $row_rw['keterangan'] = '';
                $table[] = $row_rw;
            }

            return response()->json([
                'data' => $table
            ], 200);
        }
        return view('content.penduduk.rekapitulasi');
    }

    public function excelRekap()
    {
        $filename = Carbon::now()->format('Y-m').'-rekapitulasi-penduduk.xls';
        if(request()->wantsJson()) {
            $template = resource_path('assets/template-laporan/buku-penduduk-rekapitulasi.xls');

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
            //---------------End Header

            $baseRow = 15;
            $i = 0;
            $rekap = RW::all();

            foreach ($rekap as $wr) {
                $row = $baseRow + $i;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row, $i + 1)
                    ->setCellValue('B' . $row, 'RW '.$wr->nama)
                    ->setCellValue('C' . $row, $this->rekap_awal_bulan($wr, 'WNA', 'L'))
                    ->setCellValue('D' . $row, $this->rekap_awal_bulan($wr, 'WNA', 'P'))
                    ->setCellValue('E' . $row, $this->rekap_awal_bulan($wr, 'WNI', 'L'))
                    ->setCellValue('F' . $row, $this->rekap_awal_bulan($wr, 'WNI', 'P'))
                    ->setCellValue('G' . $row, $this->rekap_awal_bulan_kk($wr))
                    ->setCellValue('H' . $row, $this->rekap_awal_bulan_anggota_kk($wr))
                    ->setCellValue('I' . $row, $this->rekap_awal_bulan_kk($wr)+$this->rekap_awal_bulan_anggota_kk($wr))
                    ->setCellValue('J' . $row, $this->lahir($wr, 'WNA', 'L'))
                    ->setCellValue('K' . $row, $this->lahir($wr, 'WNA', 'P'))
                    ->setCellValue('L' . $row, $this->lahir($wr, 'WNI', 'L'))
                    ->setCellValue('M' . $row, $this->lahir($wr, 'WNI', 'P'))
                    ->setCellValue('N' . $row, $this->datang($wr, 'WNA', 'L'))
                    ->setCellValue('O' . $row, $this->datang($wr, 'WNA', 'P'))
                    ->setCellValue('P' . $row, $this->datang($wr, 'WNI', 'L'))
                    ->setCellValue('Q' . $row, $this->datang($wr, 'WNI', 'P'))
                    ->setCellValue('R' . $row, $this->mati($wr, 'WNA', 'L'))
                    ->setCellValue('S' . $row, $this->mati($wr, 'WNA', 'P'))
                    ->setCellValue('T' . $row, $this->mati($wr, 'WNI', 'L'))
                    ->setCellValue('U' . $row, $this->mati($wr, 'WNI', 'P'))
                    ->setCellValue('V' . $row, $this->keluar($wr, 'WNA', 'L'))
                    ->setCellValue('W' . $row, $this->keluar($wr, 'WNA', 'P'))
                    ->setCellValue('X' . $row, $this->keluar($wr, 'WNI', 'L'))
                    ->setCellValue('Y' . $row, $this->keluar($wr, 'WNI', 'P'))
                    ->setCellValue('Z' . $row, $this->rekap_awal_bulan($wr, 'WNA', 'L') + $this->lahir($wr, 'WNA', 'L') + $this->datang($wr, 'WNA', 'L') - $this->mati($wr, 'WNA', 'L') - $this->keluar($wr, 'WNA', 'L'))
                    ->setCellValue('AA' . $row, $this->rekap_awal_bulan($wr, 'WNA', 'P') + $this->lahir($wr, 'WNA', 'P') + $this->datang($wr, 'WNA', 'P') - $this->mati($wr, 'WNA', 'P') - $this->keluar($wr, 'WNA', 'P'))
                    ->setCellValue('AB' . $row, $this->rekap_awal_bulan($wr, 'WNI', 'L') + $this->lahir($wr, 'WNI', 'L') + $this->datang($wr, 'WNI', 'L') - $this->mati($wr, 'WNI', 'L') - $this->keluar($wr, 'WNI', 'L'))
                    ->setCellValue('AC' . $row, $this->rekap_awal_bulan($wr, 'WNI', 'P') + $this->lahir($wr, 'WNI', 'P') + $this->datang($wr, 'WNI', 'P') - $this->mati($wr, 'WNI', 'P') - $this->keluar($wr, 'WNI', 'P'))
                    ->setCellValue('AD' . $row, $this->rekap_akhir_bulan_kk($wr))
                    ->setCellValue('AE' . $row, $this->rekap_akhir_bulan_anggota_kk($wr))
                    ->setCellValue('AF' . $row, $this->rekap_akhir_bulan_kk($wr)+$this->rekap_akhir_bulan_anggota_kk($wr))
                    ->setCellValue('AG' . $row, '');
                $i++;
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


    protected function rekap_awal_bulan_kk($wr)
    {
        $penduduk = new Penduduk();
        $awal_bulan = Carbon::today()->firstOfMonth()->subDays(1)->format('Y-m-d');
        return
            $penduduk->whereHas('pendudukInduks', function($q) use($awal_bulan, $wr){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', 'KK');
                })->where('tanggal_lahir', '<', $awal_bulan)
                    ->where('rw_id', $wr->id);
            })->count() +
            $penduduk->whereHas('pendudukInduks', function($q) use($wr, $awal_bulan){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', 'KK');
                })->where('tanggal_lahir', '<', $awal_bulan)
                    ->where('rw_id', $wr->id);
            })->whereHas('mutasiMasuks', function($q) use($awal_bulan){
                $q->where('tanggal', '<', $awal_bulan);
            })->count() -
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', 'KK');
                })->where('rw_id', $wr->id);
            })->whereHas('mutasiKeluars', function($q) use($awal_bulan, $wr){
                $q->where('tanggal', '<', $awal_bulan);
            })->count() -
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', 'KK');
                })->where('rw_id', $wr->id);
            })->whereHas('mutasiMatis', function($q) use($awal_bulan, $wr){
                $q->where('tanggal', '<', $awal_bulan);
            })->count()
            ;
    }

    protected function rekap_awal_bulan_anggota_kk($wr)
    {
        $penduduk = new Penduduk();
        $awal_bulan = Carbon::today()->firstOfMonth()->subDays(1)->format('Y-m-d');
        return
            $penduduk->whereHas('pendudukInduks', function($q) use($awal_bulan, $wr){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', '<>', 'KK');
                })->where('tanggal_lahir', '<', $awal_bulan)
                    ->where('rw_id', $wr->id);
            })->count() +
            $penduduk->whereHas('pendudukInduks', function($q) use($wr, $awal_bulan){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', '<>', 'KK');
                })->where('rw_id', $wr->id);
            })->whereHas('mutasiMasuks', function($q) use($awal_bulan){
                $q->where('tanggal', '<', $awal_bulan);
            })->count() -
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', '<>', 'KK');
                })->where('rw_id', $wr->id);
            })->whereHas('mutasiKeluars', function($q) use($awal_bulan, $wr){
                $q->where('tanggal', '<', $awal_bulan);
            })->count() -
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', '<>', 'KK');
                })->where('rw_id', $wr->id);
            })->whereHas('mutasiMatis', function($q) use($awal_bulan, $wr){
                $q->where('tanggal', '<', $awal_bulan);
            })->count()
            ;
    }

    protected function rekap_awal_bulan($wr, $warga_negara, $jenis_kelamin)
    {
        $awal_bulan = Carbon::today()->firstOfMonth()->subDays(1)->format('Y-m-d');
        $penduduk = new Penduduk();
        return
            $penduduk->whereHas('pendudukInduks', function($q) use($awal_bulan, $wr){
                $q->where('tanggal_lahir', '<', $awal_bulan)
                    ->where('rw_id', $wr->id);
            })->where('jenis_kelamin', $jenis_kelamin)
                ->where('kewarga_negaraan', $warga_negara)
                ->count() +
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->where('rw_id', $wr->id);
            })->whereHas('mutasiMasuks', function($q) use($awal_bulan){
                $q->where('tanggal', '<', $awal_bulan);
            })->where('kewarga_negaraan', $warga_negara)
                ->where('jenis_kelamin', $jenis_kelamin)
                ->count() -
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->where('rw_id', $wr->id);
            })->whereHas('mutasiKeluars', function($q) use($awal_bulan, $wr){
                $q->where('tanggal', '<', $awal_bulan);
            })->where('kewarga_negaraan', $warga_negara)
                ->where('jenis_kelamin', $jenis_kelamin)
                ->count() -
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->where('rw_id', $wr->id);
            })->whereHas('mutasiMatis', function($q) use($awal_bulan, $wr){
                $q->where('tanggal', '<', $awal_bulan);
            })->where('kewarga_negaraan', $warga_negara)
                ->where('jenis_kelamin', $jenis_kelamin)
                ->count()
            ;
    }

    protected function lahir($wr, $warga_negara, $jenis_kelamin){
        $awal_bulan = Carbon::today()->firstOfMonth()->subDays(1)->format('Y-m-d');
        $akhir_bulan = Carbon::today()->endOfMonth()->format('Y-m-d');
        $penduduk = new Penduduk();
        return
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->where('rw_id', $wr->id);
            })->whereBetween('tanggal_lahir', [$awal_bulan, $akhir_bulan])
                ->where('kewarga_negaraan', $warga_negara)
                ->where('jenis_kelamin', $jenis_kelamin)
                ->count();
    }

    protected function datang($wr, $warga_negara, $jenis_kelamin){
        $awal_bulan = Carbon::today()->firstOfMonth()->subDays(1)->format('Y-m-d');
        $akhir_bulan = Carbon::today()->endOfMonth()->format('Y-m-d');
        $penduduk = new Penduduk();
        return
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->where('rw_id', $wr->id);
            })->whereHas('mutasiMasuks', function($q) use($awal_bulan, $akhir_bulan){
                $q->whereBetween('tanggal', [$awal_bulan, $akhir_bulan]);
            })->where('kewarga_negaraan', $warga_negara)
                ->where('jenis_kelamin', $jenis_kelamin)
                ->count();
    }

    protected function keluar($wr, $warga_negara, $jenis_kelamin){
        $awal_bulan = Carbon::today()->firstOfMonth()->subDays(1)->format('Y-m-d');
        $akhir_bulan = Carbon::today()->endOfMonth()->format('Y-m-d');
        $penduduk = new Penduduk();
        return
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->where('rw_id', $wr->id);
            })->whereHas('mutasiKeluars', function($q) use($awal_bulan, $akhir_bulan){
                $q->whereBetween('tanggal', [$awal_bulan, $akhir_bulan]);
            })->where('kewarga_negaraan', $warga_negara)
                ->where('jenis_kelamin', $jenis_kelamin)
                ->count();
    }

    protected function mati($wr, $warga_negara, $jenis_kelamin){
        $awal_bulan = Carbon::today()->firstOfMonth()->subDays(1)->format('Y-m-d');
        $akhir_bulan = Carbon::today()->endOfMonth()->format('Y-m-d');
        $penduduk = new Penduduk();
        return
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->where('rw_id', $wr->id);
            })->whereHas('mutasiMatis', function($q) use($awal_bulan, $akhir_bulan){
                $q->whereBetween('tanggal', [$awal_bulan, $akhir_bulan]);
            })->where('kewarga_negaraan', $warga_negara)
                ->where('jenis_kelamin', $jenis_kelamin)
                ->count();
    }

    protected function rekap_akhir_bulan_kk($wr)
    {
        $penduduk = new Penduduk();
        $akhir_bulan = Carbon::today()->endOfMonth()->format('Y-m-d');
        return
            $penduduk->whereHas('pendudukInduks', function($q) use($akhir_bulan, $wr){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', 'KK');
                })->where('rw_id', $wr->id);
            })->count() +
            $penduduk->whereHas('pendudukInduks', function($q) use($wr, $akhir_bulan){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', 'KK');
                })->where('rw_id', $wr->id);
            })->whereHas('mutasiMasuks', function($q) use($akhir_bulan){
                $q->where('tanggal', '<', $akhir_bulan);
            })->count() -
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', 'KK');
                })->where('rw_id', $wr->id);
            })->whereHas('mutasiKeluars', function($q) use($akhir_bulan, $wr){
                $q->where('tanggal', '<', $akhir_bulan);
            })->count() -
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', 'KK');
                })->where('rw_id', $wr->id);
            })->whereHas('mutasiMatis', function($q) use($akhir_bulan, $wr){
                $q->where('tanggal', '<', $akhir_bulan);
            })->count()
            ;
    }

    protected function rekap_akhir_bulan_anggota_kk($wr)
    {
        $penduduk = new Penduduk();
        $akhir_bulan = Carbon::today()->endOfMonth()->format('Y-m-d');
        return
            $penduduk->whereHas('pendudukInduks', function($q) use($akhir_bulan, $wr){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', '<>', 'KK');
                })->where('tanggal_lahir', '<', $akhir_bulan)
                    ->where('rw_id', $wr->id);
            })->count() +
            $penduduk->whereHas('pendudukInduks', function($q) use($wr, $akhir_bulan){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', '<>', 'KK');
                })->where('tanggal_lahir', '<', $akhir_bulan)
                    ->where('rw_id', $wr->id);
            })->whereHas('mutasiMasuks', function($q) use($akhir_bulan){
                $q->where('tanggal', '<', $akhir_bulan);
            })->count() -
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', '<>', 'KK');
                })->where('rw_id', $wr->id);
            })->whereHas('mutasiKeluars', function($q) use($akhir_bulan, $wr){
                $q->where('tanggal', '<', $akhir_bulan);
            })->count() -
            $penduduk->whereHas('pendudukInduks', function($q) use($wr){
                $q->whereHas('statusKeluarga', function($query){
                    $query->where('kode', '<>', 'KK');
                })->where('rw_id', $wr->id);
            })->whereHas('mutasiMatis', function($q) use($akhir_bulan, $wr){
                $q->where('tanggal', '<', $akhir_bulan);
            })->count()
            ;
    }

    public function grafikPendidikan()
    {
        $pendidikan['grafik']['chart'] = [
            "startingAngle"=> "120",
            "showLabels"=> "0",
            "showLegend"=> "1",
            "enableMultiSlicing"=> "0",
            "slicingDistance"=> "15",
            "showPercentValues"=> "1",
            "showPercentInTooltip"=> "0",
            "plotTooltext"=> "Kategori : \$label<br>Banyak : \$datavalue",
            "caption"=> "Grafik Penduduk Berdasarkan Pendidikan ",
        ];
        $pendidikan['grafik']['data'] = DB::table('penduduk_induk AS i')
            ->select(DB::RAW('count(*) as value, i.pendidikan as label'))
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();
        $pendidikan['table'] = DB::table('penduduk_induk AS i')
            ->select(DB::RAW('i.pendidikan as label, SUM(IF(jenis_kelamin = "L", 1, 0)) as jumlah_laki, SUM(IF(jenis_kelamin = "P", 1, 0)) as jumlah_perempuan ,count(*) as total'))
            ->join('penduduk as p', 'p.id', '=', 'i.penduduk_id')
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();
        return view('content.penduduk.grafik.pendidikan', compact('pendidikan'));

    }

    public function grafikAgama()
    {
        $agama['grafik']['chart'] = [
            "startingAngle"=> "120",
            "showLabels"=> "0",
            "showLegend"=> "1",
            "enableMultiSlicing"=> "0",
            "slicingDistance"=> "15",
            "showPercentValues"=> "1",
            "showPercentInTooltip"=> "0",
            "plotTooltext"=> "Kategori : \$label<br>Banyak : \$datavalue",
            "caption"=> "Grafik Penduduk Berdasarkan Agama",
        ];
        $agama['grafik']['data'] = DB::table('penduduk_induk AS i')
            ->select(DB::RAW('count(*) as value, i.agama as label'))
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();
        $agama['table'] = DB::table('penduduk_induk AS i')
            ->select(DB::RAW('i.agama as label, SUM(IF(jenis_kelamin = "L", 1, 0)) as jumlah_laki, SUM(IF(jenis_kelamin = "P", 1, 0)) as jumlah_perempuan ,count(*) as total'))
            ->join('penduduk as p', 'p.id', '=', 'i.penduduk_id')
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();

        return view('content.penduduk.grafik.agama', compact('agama'));
    }

    public function grafikPekerjaan()
    {
        $pekerjaan['grafik']['chart'] = [
            "startingAngle"=> "120",
            "showLabels"=> "0",
            "showLegend"=> "1",
            "enableMultiSlicing"=> "0",
            "slicingDistance"=> "15",
            "showPercentValues"=> "1",
            "showPercentInTooltip"=> "0",
            "plotTooltext"=> "Kategori : \$label<br>Banyak : \$datavalue",
            "caption"=> "Grafik Penduduk Berdasarkan Pekerjaan",
        ];
        $pekerjaan['grafik']['data'] = DB::table('penduduk_induk AS i')
            ->select(DB::RAW('count(*) as value, pek.nama as label'))
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->leftJoin('pekerjaan as pek', 'i.pekerjaan_id', '=', 'pek.id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();
        $pekerjaan['table'] = DB::table('penduduk_induk AS i')
            ->select(DB::RAW('pek.nama as label, SUM(IF(jenis_kelamin = "L", 1, 0)) as jumlah_laki, SUM(IF(jenis_kelamin = "P", 1, 0)) as jumlah_perempuan ,count(*) as total'))
            ->join('penduduk as p', 'p.id', '=', 'i.penduduk_id')
            ->leftJoin('pekerjaan as pek', 'i.pekerjaan_id', '=', 'pek.id')
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();
        return view('content.penduduk.grafik.pekerjaan', compact('pekerjaan'));
    }
    public function grafikKelompokUmur()
    {

        $today = Carbon::today()->toDateString();
        $balita_akhir= Carbon::today()->subYear(5)->toDateString();
        $anak_akhir = Carbon::today()->subYear(11)->toDateString();
        $remaja_awal_akhir = Carbon::today()->subYear(16)->toDateString();
        $remaja_akhir_akhir = Carbon::today()->subYear(25)->toDateString();
        $dewasa_awal_akhir = Carbon::today()->subYear(35)->toDateString();
        $dewasa_akhir_akhir = Carbon::today()->subYear(45)->toDateString();
        $lansia_awal_akhir = Carbon::today()->subYear(55)->toDateString();
        $lansia_akhir_akhir = Carbon::today()->subYear(65)->toDateString();
        $manula = Carbon::today()->subYear(120)->toDateString();

        $umur['grafik']['chart'] = [
            "startingAngle"=> "120",
            "showLabels"=> "0",
            "showLegend"=> "1",
            "enableMultiSlicing"=> "0",
            "slicingDistance"=> "15",
            "showPercentValues"=> "1",
            "showPercentInTooltip"=> "0",
            "plotTooltext"=> "Kategori : \$label<br>Banyak : \$datavalue",
            "caption"=> "Grafik Penduduk Berdasarkan Umur",
        ];
        //Umur
        $grafikumur = DB::raw("
            CASE
                WHEN p.tanggal_lahir BETWEEN '$balita_akhir' AND '$today' THEN '0-5 Balita'
                WHEN p.tanggal_lahir BETWEEN '$anak_akhir' AND '$balita_akhir' THEN '06-11 Kanak-kanak'
                WHEN p.tanggal_lahir BETWEEN '$remaja_awal_akhir' AND '$anak_akhir' THEN '12-16 Remaja Awal'
                WHEN p.tanggal_lahir BETWEEN '$remaja_akhir_akhir' AND '$remaja_awal_akhir' THEN '17-25 Remaja Akhir'
                WHEN p.tanggal_lahir BETWEEN '$dewasa_awal_akhir' AND '$remaja_akhir_akhir' THEN '26-35 Dewasa Awal'
                WHEN p.tanggal_lahir BETWEEN '$dewasa_akhir_akhir' AND '$dewasa_awal_akhir' THEN '36-45 Dewasa Akhir'
                WHEN p.tanggal_lahir BETWEEN '$lansia_awal_akhir' AND '$dewasa_akhir_akhir' THEN '46-55 Lansia Awal'
                WHEN p.tanggal_lahir BETWEEN '$lansia_akhir_akhir' AND '$lansia_awal_akhir' THEN '56-65 Lansia Akhir'
                WHEN p.tanggal_lahir <= '$lansia_akhir_akhir' THEN '>= 65 Manula'
                WHEN p.tanggal_lahir IS NULL THEN '(NULL)'
            END AS label,
            COUNT(*) as value
        ");

        $umur['grafik']['data'] = DB::table('penduduk_induk AS i')
            ->select($grafikumur)
            ->join('penduduk as p', 'p.id', '=', 'i.penduduk_id')
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();

        $tabelumur = DB::raw("
            CASE
                WHEN p.tanggal_lahir BETWEEN '$balita_akhir' AND '$today' THEN '0-5 Balita'
                WHEN p.tanggal_lahir BETWEEN '$anak_akhir' AND '$balita_akhir' THEN '06-11 Kanak-kanak'
                WHEN p.tanggal_lahir BETWEEN '$remaja_awal_akhir' AND '$anak_akhir' THEN '12-16 Remaja Awal'
                WHEN p.tanggal_lahir BETWEEN '$remaja_akhir_akhir' AND '$remaja_awal_akhir' THEN '17-25 Remaja Akhir'
                WHEN p.tanggal_lahir BETWEEN '$dewasa_awal_akhir' AND '$remaja_akhir_akhir' THEN '26-35 Dewasa Awal'
                WHEN p.tanggal_lahir BETWEEN '$dewasa_akhir_akhir' AND '$dewasa_awal_akhir' THEN '36-45 Dewasa Akhir'
                WHEN p.tanggal_lahir BETWEEN '$lansia_awal_akhir' AND '$dewasa_akhir_akhir' THEN '46-55 Lansia Awal'
                WHEN p.tanggal_lahir BETWEEN '$lansia_akhir_akhir' AND '$lansia_awal_akhir' THEN '56-65 Lansia Akhir'
                WHEN p.tanggal_lahir <= '$lansia_akhir_akhir' THEN '>= 65 Manula'
                WHEN p.tanggal_lahir IS NULL THEN '(NULL)'
            END AS label,
            SUM(IF(jenis_kelamin = 'L', 1, 0)) as jumlah_laki,
            SUM(IF(jenis_kelamin = 'P', 1, 0)) as jumlah_perempuan,
            COUNT(*) as total
        ");
        $umur['table'] = DB::table('penduduk_induk AS i')
            ->select($tabelumur)
            ->join('penduduk as p', 'p.id', '=', 'i.penduduk_id')
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();

        return view('content.penduduk.grafik.kelompok-umur', compact('umur'));
    }
    public function grafikDusun()
    {
        $dusun['grafik']['chart'] = [
            "startingAngle"=> "120",
            "showLabels"=> "0",
            "showLegend"=> "1",
            "enableMultiSlicing"=> "0",
            "slicingDistance"=> "15",
            "showPercentValues"=> "1",
            "showPercentInTooltip"=> "0",
            "plotTooltext"=> "Kategori : \$label<br>Banyak : \$datavalue",
            "caption"=> "Grafik Penduduk Berdasarkan RW",
        ];
        $dusun['grafik']['data'] = DB::table('penduduk_induk AS i')
            ->select(DB::RAW('count(*) as value, r.nama as label'))
            ->join('r_ws as r', 'r.id', '=', 'i.rw_id')
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();
        $dusun['table'] = DB::table('penduduk_induk AS i')
            ->select(DB::RAW('r.nama as label, SUM(IF(jenis_kelamin = "L", 1, 0)) as jumlah_laki, SUM(IF(jenis_kelamin = "P", 1, 0)) as jumlah_perempuan ,count(*) as total'))
            ->join('penduduk as p', 'p.id', '=', 'i.penduduk_id')
            ->join('r_ws as r', 'r.id', '=', 'i.rw_id')
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();
        return view('content.penduduk.grafik.dusun', compact('dusun'));
    }
    public function grafikStatusPerkawinan()
    {
        $kawin['grafik']['chart'] = [
            "startingAngle"=> "120",
            "showLabels"=> "0",
            "showLegend"=> "1",
            "enableMultiSlicing"=> "0",
            "slicingDistance"=> "15",
            "showPercentValues"=> "1",
            "showPercentInTooltip"=> "0",
            "plotTooltext"=> "Kategori : \$label<br>Banyak : \$datavalue",
            "caption"=> "Grafik Penduduk Berdasarkan Status Perkawinan",
        ];
        $kawin['grafik']['data'] = DB::table('penduduk_induk AS i')
            ->select(DB::RAW('count(*) as value, i.status_perkawinan as label'))
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();
        $kawin['table'] = DB::table('penduduk_induk AS i')
            ->select(DB::RAW('i.status_perkawinan as label, SUM(IF(jenis_kelamin = "L", 1, 0)) as jumlah_laki, SUM(IF(jenis_kelamin = "P", 1, 0)) as jumlah_perempuan ,count(*) as total'))
            ->join('penduduk as p', 'p.id', '=', 'i.penduduk_id')
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();

        return view('content.penduduk.grafik.status-perkawinan', compact('kawin'));
    }
    public function grafikKewargaNegaraan()
    {
        $warga['grafik']['chart'] = [
            "startingAngle"=> "120",
            "showLabels"=> "0",
            "showLegend"=> "1",
            "enableMultiSlicing"=> "0",
            "slicingDistance"=> "15",
            "showPercentValues"=> "1",
            "showPercentInTooltip"=> "0",
            "plotTooltext"=> "Kategori : \$label<br>Banyak : \$datavalue",
            "caption"=> "Grafik Penduduk Berdasarkan Kewarganegaraan",
        ];
        $warga['grafik']['data'] = DB::table('penduduk_induk AS i')
            ->select(DB::RAW('count(*) as value, kewarga_negaraan as label'))
            ->join('penduduk as p', 'p.id', '=', 'i.penduduk_id')
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();
        $warga['table'] = DB::table('penduduk_induk AS i')
            ->select(DB::RAW('kewarga_negaraan as label, SUM(IF(jenis_kelamin = "L", 1, 0)) as jumlah_laki, SUM(IF(jenis_kelamin = "P", 1, 0)) as jumlah_perempuan ,count(*) as total'))
            ->join('penduduk as p', 'p.id', '=', 'i.penduduk_id')
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();

        return view('content.penduduk.grafik.kewarganegaraan', compact('warga'));
    }

    public function grafikStatusKeluarga()
    {
        $keluarga['grafik']['chart'] = [
            "startingAngle"=> "120",
            "showLabels"=> "0",
            "showLegend"=> "1",
            "enableMultiSlicing"=> "0",
            "slicingDistance"=> "15",
            "showPercentValues"=> "1",
            "showPercentInTooltip"=> "0",
            "plotTooltext"=> "Kategori : \$label<br>Banyak : \$datavalue",
            "caption"=> "Grafik Penduduk Berdasarkan Status Keluarga",
        ];
        $keluarga['grafik']['data'] = DB::table('penduduk_induk AS i')
            ->select(DB::RAW('count(*) as value, s.nama as label'))
            ->join('penduduk as p', 'p.id', '=', 'i.penduduk_id')
            ->leftJoin('status_keluarga as s', 'i.status_keluarga_id', '=', 's.id')
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();
        $keluarga['table'] = DB::table('penduduk_induk AS i')
            ->select(DB::RAW('s.nama as label, SUM(IF(jenis_kelamin = "L", 1, 0)) as jumlah_laki, SUM(IF(jenis_kelamin = "P", 1, 0)) as jumlah_perempuan ,count(*) as total'))
            ->join('penduduk as p', 'p.id', '=', 'i.penduduk_id')
            ->leftJoin('status_keluarga as s', 'i.status_keluarga_id', '=', 's.id')
            ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
            ->whereNull('m.penduduk_id')
            ->groupBy('label')
            ->get();

        return view('content.penduduk.grafik.status-keluarga', compact('keluarga'));
    }

    //-------------------------------------------------------------------------------------------------------------
    public function balita()
    {
        if(request()->wantsJson()){
            $data = $this->repository
                ->pushCriteria(BalitaCriteria::class)
                ->setPresenter(KelompokPendudukPresenter::class)
                ->all();
            return response()->json($data, 200);
        }

        return view('content.penduduk.kelompok.balita');
    }

    public function belajar()
    {
        if(request()->wantsJson()){
            $data = $this->repository
                ->pushCriteria(BelajarCriteria::class)
                ->setPresenter(KelompokPendudukPresenter::class)
                ->all();
            return response()->json($data, 200);
        }
        return view('content.penduduk.kelompok.belajar');
    }

    public function pemilu()
    {
        if(request()->wantsJson()){
            $data = $this->repository
                ->pushCriteria(PemiluCriteria::class)
                ->setPresenter(KelompokPendudukPresenter::class)
                ->all();
            return response()->json($data, 200);
        }

        return view('content.penduduk.kelompok.pemilu');
    }

}
