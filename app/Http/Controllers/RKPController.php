<?php

namespace App\Http\Controllers;

use App\Entities\Bidang;
use App\Entities\KegiatanKerja;
use App\Entities\ProfilDesa;
use App\Entities\RKK;
use App\Entities\RKP;
use App\Entities\RPJM;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use PHPExcel_IOFactory;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RKPCreateRequest;
use App\Http\Requests\RKPUpdateRequest;
use App\Repositories\RKPRepository;
use App\Validators\RKPValidator;


class RKPController extends Controller
{

    /**
     * @var RKPRepository
     */
    protected $repository;

    /**
     * @var RKPValidator
     */
    protected $validator;

    public function __construct(RKPRepository $repository, RKPValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    public function belanja()
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

            $table = [];

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
            foreach($bidang as $b){
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

                $row_bidang['act'] = '';
                $row_bidang['kode_1'] = '';
                $row_bidang['kode_2'] = '';
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = '';
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;
            }

            $row_jumlah['act'] = '';
            $row_jumlah['kode_1'] = '';
            $row_jumlah['kode_2'] = '';
            $row_jumlah['kode_3'] = '';
            $row_jumlah['kode_4'] = '';

            $row_jumlah['uraian'] = '<b>JUMLAH BELANJA</b>';
            $row_jumlah['anggaran'] = number_format($jumlah_belanja, 2, ',', '.');
            $row_jumlah['keterangan'] = '';
            $table[] = $row_jumlah;

            return response()->json(['data'=>$table], 200);
        }

        return view('content.perencanaan.belanja', compact('current_year'));
    }

    public function anggaran()
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
        $table = [];

        $kode_belanja = 2;
        $kode_1 = 1;
        $data_1 = [];
        foreach($bidang as $b){
            //------------------------------------------------------------------------------------------------------
            $subbidang = KegiatanKerja::where('jenis', 'level_1')
                ->where('bidang_id', $b['id'])
                ->whereIn('id', $current_subbidang_id)
                ->where('rpjm_id', $rpjm['id'])
                ->get();
            $kode_2 = 1;
            $data_2 = [];
            foreach($subbidang as $sb){
                $data_2[$kode_2]['value'] = $kode_belanja.$kode_1.$kode_2.' - '.$sb->uraian;
                $data_2[$kode_2]['index'] = $sb->id;
                $kode_2++;
            }
            $data_1[$b->nama] = $data_2;
            //------------------------------------------------------------------------------------------------------
            $kode_1++;
        }
        $table = $data_1;
//        dd($table);

        return view('content.perencanaan.belanja_anggaran', compact('current_year', 'table'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {

        $rpjm = RPJM::all()->last();

        if($id <= ( $rpjm['tahun_akhir'] - $rpjm['tahun_awal']) ){
            $tahun = Carbon::parse($rpjm['tahun_awal'])->addYears($id-1)->year;

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



            $bidang = Bidang::where('jenis', 'belanja')->get();

            if($request->wantsJson()){

                $table = [];

                foreach($bidang as $b){
                    $row_bidang = [];
                    $row_bidang['action'] = '';
                    $row_bidang['no'] = '';
                    $row_bidang['bidang'] = $b['nama'];
                    $row_bidang['kosong'] = '';
                    $row_bidang['sub_bidang'] = '';
                    $row_bidang['jenis_kegiatan'] = '';
                    $row_bidang['lokasi'] = '';
                    $row_bidang['volume'] = '';
                    $row_bidang['manfaat'] = '';
                    $row_bidang['waktu_pelaksanaan'] = '';
                    $row_bidang['jml'] = '';//number_format($jumlah_bidang, 2, ',', '.');
                    $row_bidang['sumber'] = '';
                    $row_bidang['swakelola'] = '';
                    $row_bidang['antar_desa'] = '';
                    $row_bidang['pihak_tiga'] = '';
                    $row_bidang['rencana_pelaksanaan'] = '';
                    $table[] = $row_bidang;

                    $subbidang = KegiatanKerja::where('jenis', 'level_1')
                        ->where('bidang_id', $b['id'])
                        ->whereIn('id', $current_subbidang_id)
                        ->where('rpjm_id', $rpjm['id'])
                        ->get();

                    foreach($subbidang as $sb){
                        $kegiatan = KegiatanKerja::where('jenis', 'level_2')
                            ->where('kegiatan_kerja_id', $sb->id)
                            ->whereIn('id', $current_kegiatan_id)
                            ->where('rpjm_id', $rpjm['id'])
                            ->get();
                        $jumlah_subbidang = 0;
                        foreach($kegiatan as $k){
                            foreach($k->kerjas as $g){
                                $jumlah_subbidang += (int) $g->detailKegiatanKerjas->first()->jumlah_dana;
                            }
                        }
                        $row_subbidang['action'] = '';
                        $row_subbidang['no'] = '';
                        $row_subbidang['bidang'] = '';
                        $row_subbidang['kosong'] = '';
                        $row_subbidang['sub_bidang'] = $sb['uraian'];
                        $row_subbidang['jenis_kegiatan'] = '';
                        $row_subbidang['lokasi'] = '';
                        $row_subbidang['volume'] = '';
                        $row_subbidang['manfaat'] = '';
                        $row_subbidang['waktu_pelaksanaan'] = '';
                        $row_subbidang['jml'] = number_format($jumlah_subbidang, 2, ',', '.');
                        $row_subbidang['sumber'] = '';
                        $row_subbidang['swakelola'] = '';
                        $row_subbidang['antar_desa'] = '';
                        $row_subbidang['pihak_tiga'] = '';
                        $row_subbidang['rencana_pelaksanaan'] = '';
                        $table[] = $row_subbidang;

                        foreach($kegiatan as $k){

                            $sub_kegiatan = KegiatanKerja::where('jenis', 'level_3')
                                ->where('kegiatan_kerja_id', $k->id)
                                ->whereIn('id', $current_subkegiatan_id)
                                ->where('rpjm_id', $rpjm['id'])
                                ->get();
                            $jumlah_kegiatan = 0;
                            foreach($sub_kegiatan as $sk){
                                $jumlah_kegiatan += (int) $sk->detailKegiatanKerjas->first()->jumlah_dana;
                            }
                            $row_kegiatan['action'] = '';
                            $row_kegiatan['no'] = '';
                            $row_kegiatan['bidang'] = '';
                            $row_kegiatan['kosong'] = '';
                            $row_kegiatan['sub_bidang'] = '';
                            $row_kegiatan['jenis_kegiatan'] = $k['uraian'];
                            $row_kegiatan['lokasi'] = '';
                            $row_kegiatan['volume'] = '';
                            $row_kegiatan['manfaat'] = '';
                            $row_kegiatan['waktu_pelaksanaan'] = '';
                            $row_kegiatan['jml'] = number_format($jumlah_kegiatan, 2, ',', '.');
                            $row_kegiatan['sumber'] = '';
                            $row_kegiatan['swakelola'] = '';
                            $row_kegiatan['antar_desa'] = '';
                            $row_kegiatan['pihak_tiga'] = '';
                            $row_kegiatan['rencana_pelaksanaan'] = '';
                            $table[] = $row_kegiatan;

                            foreach($sub_kegiatan as $sk){
                                $rkp = RKP::where('kegiatan_kerja_id', $sk->id )->where('tahun', $tahun)->first();

                                $rkk = RKK::where('rkp_id', $rkp['id'] )->first();
                                $row_subkegiatan['action'] = '
                                '. ((Auth::user()->can('edit-rkp-perencanaan')) ? '
                                <button class="btn btn-xs btn-default" onclick="return ubah(\''.$rkp['id'].'\', \''.$rkp['rencana_kegiatan'].'\', \''.$sk['uraian'].'\', )"><i class="fa fa-edit"></i></button>
                                ' : '') .'
                                ';
                                $row_subkegiatan['no'] = '';
                                $row_subkegiatan['bidang'] = '';
                                $row_subkegiatan['kosong'] = '';
                                $row_subkegiatan['sub_bidang'] = '';
                                $row_subkegiatan['jenis_kegiatan'] = '<i class="fa fa-minus"></i>'.$sk['uraian'];
                                $row_subkegiatan['lokasi'] = $sk->detailKegiatanKerjas->first()->lokasi;
                                $row_subkegiatan['volume'] = $sk->detailKegiatanKerjas->first()->volume;
                                $row_subkegiatan['manfaat'] = $sk->detailKegiatanKerjas->first()->manfaat;
                                $row_subkegiatan['waktu_pelaksanaan'] = $rkk['mulai'].' sampai '.$rkk['selesai'];
                                $row_subkegiatan['jml'] = number_format($sk->detailKegiatanKerjas->first()->jumlah_dana, 2, ',', '.');
                                $row_subkegiatan['sumber'] = $sk->detailKegiatanKerjas->first()->sumberDana->nama;
                                $row_subkegiatan['swakelola'] = ($sk->detailKegiatanKerjas->first()->pola_pelaksanaan == "SWAKELOLA") ? '<i class="fa fa-check"></i>' : '';
                                $row_subkegiatan['antar_desa'] = ($sk->detailKegiatanKerjas->first()->pola_pelaksanaan == "KERJASAMA ANTAR DESA") ? '<i class="fa fa-check"></i>' : '';
                                $row_subkegiatan['pihak_tiga'] = ($sk->detailKegiatanKerjas->first()->pola_pelaksanaan == "KERJASAMA PIHAK 3") ? '<i class="fa fa-check"></i>' : '';
                                $row_subkegiatan['rencana_pelaksanaan'] = $rkp['rencana_kegiatan'];
                                $table[] = $row_subkegiatan;
                            }
                        }
                    }
                }

                return response()->json(['data'=>$table]);
            }

            return view('content.perencanaan.rkp', compact('id', 'tahun'));
        }
        //else
        return redirect()->route('rkp.index', ($rpjm['tahun_akhir'] - $rpjm['tahun_awal']) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RKPCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $rKP = $this->repository->create($request->all());

            $response = [
                'message' => 'RKP created.',
                'data'    => $rKP->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rKP = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $rKP,
            ]);
        }

        return view('rKPs.show', compact('rKP'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $rKP = $this->repository->find($id);

        return view('rKPs.edit', compact('rKP'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RKPUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $ubah = [
                'rencana_kegiatan' => $request->rencana_kegiatan
            ];
            RKP::find($id)->update($ubah);

            $response = [
                'message' => 'RKP Berhasil Diubah',
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

        } catch (ValidatorException $e) {

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
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (request()->wantsJson()) {

            try {
                $deleted = $this->repository->delete($id);
                return response()->json([
                    'message' => 'RKP Berhasil Dihapus',
                ], 201);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }

    public function excel(Request $request, $id)
    {

        $rpjm = RPJM::all()->last();

        if($id <= ( $rpjm['tahun_akhir'] - $rpjm['tahun_awal']) ){
            $tahun = Carbon::parse($rpjm['tahun_awal'])->addYears($id-1)->year;

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


            $bidang = Bidang::where('jenis', 'belanja')->get();
            $filename = 'rkp-'.str_replace(' ', '', $tahun).'.xls';

            if($request->wantsJson()){
                $template = resource_path('assets/template-laporan/rkp.xls');

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

                $table = [];
                $i = 1;
                foreach($bidang as $b){
                    $row_bidang['no'] = $i;
                    $row_bidang['bidang'] = $b['nama'];
                    $row_bidang['kosong'] = '';
                    $row_bidang['sub_bidang'] = '';
                    $row_bidang['jenis_kegiatan'] = '';
                    $row_bidang['lokasi'] = '';
                    $row_bidang['volume'] = '';
                    $row_bidang['manfaat'] = '';
                    $row_bidang['waktu_pelaksanaan'] = '';
                    $row_bidang['jml'] = '';
                    $row_bidang['sumber'] = '';
                    $row_bidang['swakelola'] = '';
                    $row_bidang['antar_desa'] = '';
                    $row_bidang['pihak_tiga'] = '';
                    $row_bidang['rencana_pelaksanaan'] = '';
                    $table[] = $row_bidang;

                    $subbidang = KegiatanKerja::where('jenis', 'level_1')
                        ->where('bidang_id', $b['id'])
                        ->whereIn('id', $current_subbidang_id)
                        ->where('rpjm_id', $rpjm['id'])
                        ->get();

                    foreach($subbidang as $sb){
                        $kegiatan = KegiatanKerja::where('jenis', 'level_2')
                            ->where('kegiatan_kerja_id', $sb->id)
                            ->whereIn('id', $current_kegiatan_id)
                            ->where('rpjm_id', $rpjm['id'])
                            ->get();
                        $jumlah_subbidang = 0;
                        foreach($kegiatan as $k){
                            foreach($k->kerjas as $g){
                                $jumlah_subbidang += (int) $g->detailKegiatanKerjas->first()->jumlah_dana;
                            }
                        }
                        $row_subbidang['no'] = '';
                        $row_subbidang['bidang'] = '';
                        $row_subbidang['kosong'] = '';
                        $row_subbidang['sub_bidang'] = $sb['uraian'];
                        $row_subbidang['jenis_kegiatan'] = '';
                        $row_subbidang['lokasi'] = '';
                        $row_subbidang['volume'] = '';
                        $row_subbidang['manfaat'] = '';
                        $row_subbidang['waktu_pelaksanaan'] = '';
                        $row_subbidang['jml'] = $jumlah_subbidang;
                        $row_subbidang['sumber'] = '';
                        $row_subbidang['swakelola'] = '';
                        $row_subbidang['antar_desa'] = '';
                        $row_subbidang['pihak_tiga'] = '';
                        $row_subbidang['rencana_pelaksanaan'] = '';
                        $table[] = $row_subbidang;

                        foreach($kegiatan as $k){

                            $sub_kegiatan = KegiatanKerja::where('jenis', 'level_3')
                                ->where('kegiatan_kerja_id', $k->id)
                                ->whereIn('id', $current_subkegiatan_id)
                                ->where('rpjm_id', $rpjm['id'])
                                ->get();
                            $jumlah_kegiatan = 0;
                            foreach($sub_kegiatan as $sk){
                                $jumlah_kegiatan += (int) $sk->detailKegiatanKerjas->first()->jumlah_dana;
                            }
                            $row_kegiatan['no'] = '';
                            $row_kegiatan['bidang'] = '';
                            $row_kegiatan['kosong'] = '';
                            $row_kegiatan['sub_bidang'] = '';
                            $row_kegiatan['jenis_kegiatan'] = $k['uraian'];
                            $row_kegiatan['lokasi'] = '';
                            $row_kegiatan['volume'] = '';
                            $row_kegiatan['manfaat'] = '';
                            $row_kegiatan['waktu_pelaksanaan'] = '';
                            $row_kegiatan['jml'] = $jumlah_kegiatan;
                            $row_kegiatan['sumber'] = '';
                            $row_kegiatan['swakelola'] = '';
                            $row_kegiatan['antar_desa'] = '';
                            $row_kegiatan['pihak_tiga'] = '';
                            $row_kegiatan['rencana_pelaksanaan'] = '';
                            $table[] = $row_kegiatan;

                            foreach($sub_kegiatan as $sk){
                                $rkp = RKP::where('kegiatan_kerja_id', $sk->id )->where('tahun', $tahun)->first();

                                $rkk = RKK::where('rkp_id', $rkp['id'] )->first();
                                $row_subkegiatan['no'] = '';
                                $row_subkegiatan['bidang'] = '';
                                $row_subkegiatan['kosong'] = '';
                                $row_subkegiatan['sub_bidang'] = '';
                                $row_subkegiatan['jenis_kegiatan'] = '- '.$sk['uraian'];
                                $row_subkegiatan['lokasi'] = $sk->detailKegiatanKerjas->first()->lokasi;
                                $row_subkegiatan['volume'] = $sk->detailKegiatanKerjas->first()->volume;
                                $row_subkegiatan['manfaat'] = $sk->detailKegiatanKerjas->first()->manfaat;
                                $row_subkegiatan['waktu_pelaksanaan'] = $rkk['mulai'].' sampai '.$rkk['selesai'];
                                $row_subkegiatan['jml'] = $sk->detailKegiatanKerjas->first()->jumlah_dana;
                                $row_subkegiatan['sumber'] = $sk->detailKegiatanKerjas->first()->sumberDana->nama;
                                $row_subkegiatan['swakelola'] = ($sk->detailKegiatanKerjas->first()->pola_pelaksanaan == "SWAKELOLA") ? 'V' : '';
                                $row_subkegiatan['antar_desa'] = ($sk->detailKegiatanKerjas->first()->pola_pelaksanaan == "KERJASAMA ANTAR DESA") ? 'V' : '';
                                $row_subkegiatan['pihak_tiga'] = ($sk->detailKegiatanKerjas->first()->pola_pelaksanaan == "KERJASAMA PIHAK 3") ? 'V' : '';
                                $row_subkegiatan['rencana_pelaksanaan'] = $rkp['rencana_kegiatan'];
                                $table[] = $row_subkegiatan;
                            }
                        }
                    }
                    $i++;
                }

                //save
                $baseRow = 12;
                $j = 0;
                foreach($table as $t){
                    $row_excel = $baseRow + $j;

                    $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_excel, 1);
                    $objPHPExcel->getActiveSheet()
                        ->setCellValue('A' . $row_excel, $t['no'])
                        ->setCellValue('B' . $row_excel, $t['bidang'])
                        ->setCellValue('C' . $row_excel, $t['kosong'])
                        ->setCellValue('D' . $row_excel, $t['sub_bidang'])
                        ->setCellValue('E' . $row_excel, $t['jenis_kegiatan'])
                        ->setCellValue('F' . $row_excel, $t['lokasi'])
                        ->setCellValue('G' . $row_excel, $t['volume'])
                        ->setCellValue('H' . $row_excel, $t['manfaat'])
                        ->setCellValue('I' . $row_excel, $t['waktu_pelaksanaan'])
                        ->setCellValue('J' . $row_excel, $t['jml'])
                        ->setCellValue('K' . $row_excel, $t['sumber'])
                        ->setCellValue('L' . $row_excel, $t['swakelola'])
                        ->setCellValue('M' . $row_excel, $t['antar_desa'])
                        ->setCellValue('N' . $row_excel, $t['pihak_tiga'])
                        ->setCellValue('O' . $row_excel, $t['rencana_pelaksanaan']);
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
        //else
        return redirect()->route('rkp.index', ($rpjm['tahun_akhir'] - $rpjm['tahun_awal']) );
    }
}
