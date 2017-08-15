<?php

namespace App\Http\Controllers;

use App\Entities\Bidang;
use App\Entities\Pendapatan;
use App\Entities\RealisasiPendapatan as RP;
use App\Entities\RealisasiPendapatan;
use App\Validators\RealisasiPendapatanValidator;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class RealisasiPendapatanController extends Controller
{

    protected $validator;

    public function __construct(RealisasiPendapatanValidator $validator)
    {
        $this->validator = $validator;
    }

    public function index()
    {
        $current_year = Carbon::now()->year;
        $bidang = Bidang::where('jenis', 'pendapatan')->get();

        if(request()->wantsJson()){
            $tabel = [];

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

            $jumlah_anggaran_pendapatan = 0;
            $jumlah_realisasi_pendapatan = 0;
            $kode_2 = 1;
            foreach($bidang as $b){
                $row['kode_1'] = $kode_pendapatan;
                $row['kode_2'] = $kode_2;
                $row['kode_3'] = '';
                $row['kode_4'] = '';
                $row['uraian'] = '<a href="'.route('pelaksanaan.apbd.pendapatan.bidang', $b->id).'"><b><i>'.$b->nama.'</i></b></a>';
                $row['anggaran'] = '';
                $row['realisasi'] = '';
                $row['lebih_kurang'] = '';
                $row['keterangan'] = '';
                $tabel[] = $row;
                //------------------------------------------------------------------------------------------------------
                $pendapatan = Pendapatan::where('tahun', $current_year)->where('level', 'level_1')->where('bidang_id', $b->id)->get();
                $kode_3 = 1;
                foreach($pendapatan as $pl1){
                    $row['kode_1'] = $kode_pendapatan;
                    $row['kode_2'] = $kode_2;
                    $row['kode_3'] = $kode_3;
                    $row['kode_4'] = '';
                    $row['uraian'] = '<a href="'.route('pelaksanaan.apbd.pendapatan.subbidang', $pl1->id).'">'.$pl1->uraian.'</a>';
                    $row['anggaran'] = '';
                    $row['realisasi'] = '';
                    $row['lebih_kurang'] = '';
                    $row['keterangan'] = '';
                    $tabel[] = $row;
                    //--------------------------------------------------------------------------------------------------
                    $pendapatan_l2 = Pendapatan::where('tahun', $current_year)->where('level', 'level_2')->where('pendapatan_id', $pl1->id)->get();
                    $kode_4 = 1;
                    foreach($pendapatan_l2 as $pl2){

                        $realisasi = RP::where('pendapatan_id', $pl2->id)->sum('jumlah');

                        $row['kode_1'] = $kode_pendapatan;
                        $row['kode_2'] = $kode_2;
                        $row['kode_3'] = $kode_3;
                        $row['kode_4'] = $kode_4;
                        $row['uraian'] = '<a href="'.route('pelaksanaan.apbd.pendapatan.kegiatan', $pl2->id).'">'.$pl2->uraian.'</a>';
                        $row['anggaran'] = number_format($pl2->jumlah_dana, 2,',', '.');
                        $row['realisasi'] = number_format($realisasi, 2, ',', '.');
                        $row['lebih_kurang'] = number_format($pl2->jumlah_dana - $realisasi, 2, ',', '.');
                        $row['keterangan'] = '';
                        $tabel[] = $row;
                        $jumlah_realisasi_pendapatan += $realisasi;
                        $jumlah_anggaran_pendapatan += (int) $pl2->jumlah_dana;
                        $kode_4++;
                    }
                    //--------------------------------------------------------------------------------------------------
                    $kode_3++;
                }
                //------------------------------------------------------------------------------------------------------
                $kode_2++;

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
            }

            $row['kode_1'] = '';
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = '<b>JUMLAH</b>';
            $row['anggaran'] = number_format($jumlah_anggaran_pendapatan, 2, ',', '.');
            $row['realisasi'] = number_format($jumlah_realisasi_pendapatan, 2, ',', '.');
            $row['lebih_kurang'] = number_format($jumlah_anggaran_pendapatan - $jumlah_realisasi_pendapatan, 2, ',', '.');
            $row['keterangan'] = '';
            $tabel[] = $row;

            return response()->json(['data'=>$tabel]);
        }

        return view('content.pelaksanaan.pendapatan', compact('current_year'));
    }

    public function bidang($id)
    {
        if(request()->wantsJson()){
            $table = [];
            $bidang = Bidang::where('id', $id)->first();
            $p = Pendapatan::where('bidang_id', $bidang->id);
            $pendapatan = Pendapatan::whereIn('pendapatan_id', $p->pluck('id'))->sum('jumlah_dana');
            $sub_pendapatan = Pendapatan::whereIn('pendapatan_id', $p->pluck('id'));
            $realisasi = RealisasiPendapatan::whereIn('pendapatan_id', $sub_pendapatan->pluck('id'))->sum('jumlah');
            $selisih = $pendapatan - $realisasi;

            $row['index'] = "Uraian";
            $row['value'] = $bidang->nama;
            $table['info'][] = $row;
            $row['index'] = "Anggaran";
            $row['value'] = number_format($pendapatan, 2, ',', '.');
            $table['info'][] = $row;
            $row['index'] = "Realisasi";
            $row['value'] = number_format($realisasi, 2, ',', '.');
            $table['info'][] = $row;
            $row['index'] = "Selisih";
            $row['value'] = number_format($selisih, 2, ',', '.');
            $table['info'][] = $row;

            $rincian = RealisasiPendapatan::whereIn('pendapatan_id', $sub_pendapatan->pluck('id'))->orderBy('tanggal', 'desc')->get();
            $jumlah = 0;
            foreach($rincian as $r){
                $row_selisih['metode'] = $r->metode;
                $row_selisih['tanggal'] = Carbon::parse($r->tanggal)->format('d M Y');
                $row_selisih['uraian'] = $r->uraian;
                $row_selisih['nomor_bukti'] = $r->nomor_bukti;
                $row_selisih['file'] = $r->file;
                $row_selisih['jumlah'] = number_format($r->jumlah, 2, ',', '.');
                $jumlah += $r->jumlah;
                $table['rincian'][] = $row_selisih;
            }
            $row['metode']      = '';
            $row['tanggal']     = '';
            $row['uraian']      = '';
            $row['nomor_bukti'] = '';
            $row['file'] = '';
            $row['jumlah']      = '<b>Rp.'.number_format($jumlah, 2, ',', '.').'</b>';
            $table['rincian'][] = $row;

            $control['anggaran'] = $pendapatan;
            $control['realisasi'] = $realisasi;
            $control['selisih'] = $selisih;

            $control['anggaran_progress_bar'] = '20%';
            $control['realisasi_progress_bar'] = '30%';
            $control['selisih_progress_bar'] = '50%';

            $control['anggaran_progress_description'] = 'Anggaran';
            $control['realisasi_progress_description'] = 'Realisasi';
            $control['selisih_progress_description'] = 'Selisih';

            return response()->json(['data'=>$table, 'control'=>$control], 200);
        }
        return view('content.pelaksanaan.pendapatan.bidang', compact('info'));
    }

    public function subbidang($id)
    {
        if(request()->wantsJson()){
            $p = Pendapatan::where('id', $id)->first();
            $pendapatan = $p->pendapatans->sum('jumlah_dana');
            $sub_pendapatan = Pendapatan::where('pendapatan_id', $id);
            $realisasi = RealisasiPendapatan::whereIn('pendapatan_id', $sub_pendapatan->pluck('id'))->sum('jumlah');
            $selisih = $pendapatan - $realisasi;

            $row['index'] = "Uraian";
            $row['value'] = $p->uraian;
            $table['info'][] = $row;
            $row['index'] = "Anggaran";
            $row['value'] = "Rp.".number_format($pendapatan, 2, ',', '.');
            $table['info'][] = $row;
            $row['index'] = "Realisasi";
            $row['value'] = "Rp.".number_format($realisasi, 2, ',', '.');
            $table['info'][] = $row;
            $row['index'] = "Selisih";
            $row['value'] = "Rp.".number_format($selisih, 2, ',', '.');
            $table['info'][] = $row;

            $rincian = RealisasiPendapatan::whereIn('pendapatan_id', $sub_pendapatan->pluck('id'))->orderBy('tanggal', 'desc')->get();
            $jumlah  = 0;
            foreach($rincian as $r){
                $row_selisih['file'] = $r->file;
                $row_selisih['metode'] = $r->metode;
                $row_selisih['tanggal'] = Carbon::parse($r->tanggal)->format('d M Y');
                $row_selisih['uraian'] = $r->uraian;
                $row_selisih['nomor_bukti'] = $r->nomor_bukti;
                $row_selisih['jumlah'] = number_format($r->jumlah, 2, ',', '.');
                $jumlah += $r->jumlah;
                $table['rincian'][] = $row_selisih;
            }
            $row['metode']      = '';
            $row['tanggal']     = '';
            $row['uraian']      = '';
            $row['nomor_bukti'] = '';
            $row['jumlah']      = '<b>Rp.'.number_format($jumlah, 2, ',', '.').'</b>';
            $table['rincian'][] = $row;

            $control['anggaran'] = $pendapatan;
            $control['realisasi'] = $realisasi;
            $control['selisih'] = $selisih;

            $control['anggaran_progress_bar'] = '20%';
            $control['realisasi_progress_bar'] = '30%';
            $control['selisih_progress_bar'] = '50%';

            $control['anggaran_progress_description'] = 'Anggaran';
            $control['realisasi_progress_description'] = 'Realisasi';
            $control['selisih_progress_description'] = 'Selisih';

            return response()->json(['data'=>$table, 'control'=>$control], 200);
        }
        return view('content.pelaksanaan.pendapatan.subbidang', compact('info'));
    }

    public function kegiatan($id)
    {
        if(request()->wantsJson()){
            $pendapatan = Pendapatan::where('id', $id)->first();

            $row['satu'] = 'Uraian';
            $row['dua']  = $pendapatan->uraian;
            $table['info'][] = $row;
            $row['satu'] = 'Anggaran';
            $row['dua']  = 'Rp.'.number_format($pendapatan->jumlah_dana, 2, ',', '.');
            $table['info'][] = $row;
            $row['satu'] = 'Realisasi';
            $row['dua']  = 'Rp.'.number_format($pendapatan->realisasi->sum('jumlah'), 2, ',', '.');
            $table['info'][] = $row;
            $row['satu'] = 'Selisih';
            $row['dua']  = 'Rp.'.number_format($pendapatan->jumlah_dana - $pendapatan->realisasi->sum('jumlah'), 2, ',', '.');
            $table['info'][] = $row;

            $realisasi = RealisasiPendapatan::where('pendapatan_id', $id)->orderBy('tanggal', 'desc')->get();
            $jumlah = 0;
            foreach($realisasi as $r){
                $row['file'] = $r->file;
                $row['id']          = $r->id;
                $row['metode']      = $r->metode;
                $row['tanggal']     = Carbon::parse($r->tanggal)->format('d M Y');
                $row['uraian']      = $r->uraian;
                $row['nomor_bukti'] = $r->nomor_bukti;
                $row['jumlah']      = 'Rp.'.number_format($r->jumlah, 2, ',', '.');
                $table['rincian'][] = $row;
                $jumlah += $r->jumlah;
            }
            $row['metode']      = '';
            $row['tanggal']     = '';
            $row['uraian']      = '';
            $row['nomor_bukti'] = '';
            $row['jumlah']      = '<b>Rp.'.number_format($jumlah, 2, ',', '.').'</b>';
            $table['rincian'][] = $row;

            $control['anggaran'] = $pendapatan->jumlah_dana;
            $control['realisasi'] = $pendapatan->realisasi->sum('jumlah');
            $control['selisih'] = $pendapatan->jumlah_dana  - $pendapatan->realisasi->sum('jumlah');

            $control['anggaran_progress_bar'] = '20%';
            $control['realisasi_progress_bar'] = '30%';
            $control['selisih_progress_bar'] = '50%';

            $control['anggaran_progress_description'] = 'Anggaran';
            $control['realisasi_progress_description'] = 'Realisasi';
            $control['selisih_progress_description'] = 'Selisih';

            return response()->json(['data'=>$table, 'control'=>$control], 200);
        }
        return view('content.pelaksanaan.pendapatan.kegiatan', compact('tahun', 'id', 'uraian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            if($request->wantsJson()){

                $tambah = [
                    'nomor_bukti'   => $request->nomor_bukti,
                    'tanggal'       => $request->tanggal,
                    'metode'        => $request->metode,
                    'uraian'        => $request->uraian,
                    'jumlah'        => $request->jumlah,
                    'pendapatan_id' => $request->pendapatan_id,
                ];

                RealisasiPendapatan::firstOrCreate($tambah);

                return response()->json([
                    'message'=>'Rincian Realisasi Berhasil Ditambahkan'
                ], 200);
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
     * Display the specified resource.
     *
     * @param  \App\RealisasiPendapatan  $realisasiPendapatan
     * @return \Illuminate\Http\Response
     */
    public function show($id, RealisasiPendapatan $realisasiPendapatan)
    {
        if(request()->wantsJson()){

            return response()->json([
                $realisasiPendapatan->find($id)->first()
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RealisasiPendapatan  $realisasiPendapatan
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, RealisasiPendapatan $realisasiPendapatan)
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

                $realisasiPendapatan->find($id)->update($ubah);
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
     * @param  \App\RealisasiPendapatan  $realisasiPendapatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(request()->wantsJson()){
            try{

                RealisasiPendapatan::find($id)->delete();

                return response()->json(['message'=>'Rincian Berhasil Dihapus'], 201);

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
