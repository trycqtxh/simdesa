<?php

namespace App\Http\Controllers;

use App\Entities\Bidang;
use App\Entities\Pembiayaan;
use App\Entities\RealisasiPembiayaan;
use App\Validators\RealisasiPendapatanValidator;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class RealisasiPembiayaanController extends Controller
{
    protected $validator;

    public function __construct(RealisasiPendapatanValidator $validator)
    {
        $this->validator =$validator;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $current_year = Carbon::now()->year;
        $bidang = Bidang::where('jenis', 'pembiayaan')->get();

        $tahun = $current_year;

        if(request()->wantsJson()){
            $tabel = [];
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
            //----------------------------------------------------------------------------------------------------------
            $kode_2 = 1;
            foreach($bidang as $b){
                $row['kode_1'] = $kode_pembiayaan;
                $row['kode_2'] = $kode_2;
                $row['kode_3'] = '';
                $row['kode_4'] = '';
                $row['uraian'] = '<a href="'.route('pelaksanaan.apbd.pembiayaan.bidang', $b->id).'"><b><i>'.$b->nama.'</i></b></a>';
                $row['anggaran'] = '';
                $row['realisasi'] = '';
                $row['lebih_kurang'] = '';
                $row['keterangan'] = '';
                $tabel[] = $row;
                //------------------------------------------------------------------------------------------------------

                $jumlah_pembiayaan_sub[$kode_2] = 0;
                $jumlah_realisasi_sub[$kode_2] = 0;
                $jumlah_selisih_sub[$kode_2] = 0;
                $sub_bidang = Pembiayaan::where('tahun', $current_year)->where('bidang_id', $b->id)->get();
                $kode_3 = 1;
                foreach($sub_bidang as $sb){
                    $anggaran = $sb->jumlah_dana;
                    $realisasi = RealisasiPembiayaan::where('pembiayaan_id', $sb->id)->sum('jumlah');
                    $selisih = $anggaran - $realisasi;

                    $row['kode_1'] = $kode_pembiayaan;
                    $row['kode_2'] = $kode_2;
                    $row['kode_3'] = $kode_3;
                    $row['kode_4'] = '';
                    $row['uraian'] = '<a href="'.route('pelaksanaan.apbd.pembiayaan.kegiatan', $sb->id).'">'.$sb->uraian.'</a>';
                    $row['anggaran'] = number_format($anggaran, 2, ',', '.');
                    $row['realisasi'] = number_format($realisasi, 2, ',', '.');
                    $row['lebih_kurang'] = number_format($selisih, 2, ',', '.');
                    $row['keterangan'] = '';
                    $tabel[] = $row;
                    $kode_3++;
                    $jumlah_pembiayaan_sub[$kode_2] += $sb->jumlah_dana;
                    $jumlah_realisasi_sub[$kode_2] += $realisasi;
                    $jumlah_selisih_sub[$kode_2] += $selisih;
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
            //----------------------------------------------------------------------------------------------------------
            $jumlah_pembiayaan = $jumlah_pembiayaan_sub[1] - $jumlah_pembiayaan_sub[2];
            $jumlah_realisasi = $jumlah_realisasi_sub[1] - $jumlah_realisasi_sub[2];
            $jumlah_selisih = $jumlah_selisih_sub[1] +  $jumlah_selisih_sub[2];
            $row['kode_1'] = '';
            $row['kode_2'] = '';
            $row['kode_3'] = '';
            $row['kode_4'] = '';
            $row['uraian'] = '<b>JUMLAH</b>';
            $row['anggaran'] = number_format($jumlah_pembiayaan, 2, ',', '.');
            $row['realisasi'] = number_format($jumlah_realisasi, 2, ',', '.');
            $row['lebih_kurang'] = number_format($jumlah_selisih, 2, ',', '.');
            $row['keterangan'] = '';
            $tabel[] = $row;

            return response()->json(['data'=>$tabel], 200);
        }

        return view('content.pelaksanaan.pembiayaan', compact('current_year', 'tahun'));
    }

    public function bidang($id)
    {
        $bidang = Bidang::where('jenis', 'pembiayaan')->where('id',$id)->first();
        $pembiayaan = Pembiayaan::where('bidang_id', $bidang->id);
        $anggaran = $pembiayaan->sum('jumlah_dana');
        $realisasi = RealisasiPembiayaan::whereIn('pembiayaan_id', $pembiayaan->pluck('id'))->get();

        if(request()->wantsJson()){
            $table = [];
            $bidang = Bidang::where('jenis', 'pembiayaan')->where('id',$id)->first();
            $pembiayaan = Pembiayaan::where('bidang_id', $bidang->id);
            $anggaran = $pembiayaan->sum('jumlah_dana');
            $realisasiPembiyaan = RealisasiPembiayaan::whereIn('pembiayaan_id', $pembiayaan->pluck('id'));
            $realisasi = $realisasiPembiyaan->sum('jumlah');
            $selisih = $anggaran - $realisasi;

            $row['index'] = 'Uraian';
            $row['value']  = $bidang->nama;
            $table['info'][] = $row;
            $row['index'] = 'Anggaran';
            $row['value']  = 'Rp.'.number_format($anggaran, 2, ',', '.');
            $table['info'][] = $row;
            $row['index'] = 'Realisasi';
            $row['value']  = 'Rp.'.number_format($realisasi, 2, ',', '.');
            $table['info'][] = $row;
            $row['index'] = 'Selisih';
            $row['value']  = 'Rp.'.number_format($selisih, 2, ',', '.');
            $table['info'][] = $row;

            $jumlah = 0;
            foreach($realisasiPembiyaan->get() as $r){
                $row_rincian['metode']      = $r->metode;
                $row_rincian['tanggal']     = Carbon::parse($r->tanggal)->format('d M Y');
                $row_rincian['uraian']      = $r->uraian;
                $row_rincian['nomor_bukti'] = $r->nomor_bukti;
                $row_rincian['jumlah']      = 'Rp.'.number_format($r->jumlah, 2, ',', '.');
                $table['rincian'][] = $row_rincian;
                $jumlah += $r->jumlah;
            }
            $row_rincian['metode']      = '';
            $row_rincian['tanggal']     = '';
            $row_rincian['uraian']      = '';
            $row_rincian['nomor_bukti'] = '';
            $row_rincian['jumlah']      = 'Rp.'.number_format($jumlah, 2, ',', '.');
            $table['rincian'][] = $row_rincian;

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
        return view('content.pelaksanaan.pembiayaan.bidang');
    }


    public function kegiatan($id)
    {
        if(request()->wantsJson()){
            $pembiayaan = Pembiayaan::where('id', $id)->first();

            $row['satu'] = 'Uraian';
            $row['dua']  = $pembiayaan->uraian;
            $table['info'][] = $row;
            $row['satu'] = 'Anggaran';
            $row['dua']  = 'Rp.'.number_format($pembiayaan->jumlah_dana, 2, ',', '.');
            $table['info'][] = $row;
            $row['satu'] = 'Realisasi';
            $row['dua']  = 'Rp.'.number_format($pembiayaan->realisasi->sum('jumlah'), 2, ',', '.');
            $table['info'][] = $row;
            $row['satu'] = 'Selisih';
            $row['dua']  = 'Rp.'.number_format($pembiayaan->jumlah_dana - $pembiayaan->realisasi->sum('jumlah'), 2, ',', '.');
            $table['info'][] = $row;


            $realisasi = RealisasiPembiayaan::where('pembiayaan_id', $id)->orderBy('tanggal', 'desc')->get();
            $jumlah = 0;
            foreach($realisasi as $r){
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

            $control['anggaran'] = $pembiayaan->jumlah_dana;
            $control['realisasi'] = $pembiayaan->realisasi->sum('jumlah');
            $control['selisih'] = $pembiayaan->jumlah_dana - $pembiayaan->realisasi->sum('jumlah');

            $control['anggaran_progress_bar'] = '100%';
            $control['realisasi_progress_bar'] = '100%';
            $control['selisih_progress_bar'] = '100%';

            $control['anggaran_progress_description'] = 'Anggaran';
            $control['realisasi_progress_description'] = 'Realisasi';
            $control['selisih_progress_description'] = 'Selisih';

            return response()->json(['data'=>$table, 'control'=>$control], 200);
        }
        return view('content.pelaksanaan.pembiayaan.kegiatan', compact('tahun', 'id', 'uraian'));
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

            if(request()->wantsJson()){
                $tambah = [
                    'nomor_bukti'   => $request->nomor_bukti,
                    'tanggal'       => $request->tanggal,
                    'metode'        => $request->metode,
                    'uraian'        => $request->uraian,
                    'jumlah'        => $request->jumlah,
                    'pembiayaan_id' => $request->pendapatan_id,
                ];
                RealisasiPembiayaan::create($tambah);
                return response()->json(['message'=>'Rincian Realisasi Berhasil Ditambahkan'], 201);
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
     * @param  \App\RealisasiPembiayaan  $realisasiPembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show($id, RealisasiPembiayaan $realisasiPembiayaan)
    {
        if(request()->wantsJson()){

            return response()->json([
                $realisasiPembiayaan->find($id)->first()
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RealisasiPembiayaan  $realisasiPembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, RealisasiPembiayaan $realisasiPembiayaan)
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

                $realisasiPembiayaan->find($id)->update($ubah);
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
     * @param  \App\RealisasiPembiayaan  $realisasiPembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, RealisasiPembiayaan $realisasiPembiayaan)
    {
        if(request()->wantsJson()){
            try{
                $realisasiPembiayaan->find($id)->delete();

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
