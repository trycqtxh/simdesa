<?php

namespace App\Http\Controllers;

use App\Entities\Bidang;
use App\Entities\KegiatanKerja;
use App\Entities\ProfilDesa;
use App\Entities\RPJM;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use PHPExcel_IOFactory;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RPJMCreateRequest;
use App\Http\Requests\RPJMUpdateRequest;
use App\Repositories\RPJMRepository;
use App\Validators\RPJMValidator;
use App\Entities\RKP as rkp;
use Zizaco\Entrust\Entrust;

class RPJMController extends Controller
{

    /**
     * @var RPJMRepository
     */
    protected $repository;

    /**
     * @var RPJMValidator
     */
    protected $validator;

    public function __construct(RPJMRepository $repository, RPJMValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rpjm = RPJM::all()->last();

        $bidang = Bidang::where('jenis', 'belanja')->get();

        if (request()->wantsJson()) {

            $table = [];
            $i = 1;
            foreach($bidang as $b){
                $row_bidang = [];
//                $row_bidang['action'] = '
//                <div class="btn-group">
//                    <button class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
//                    <ul class="dropdown-menu">
//                        <li><a href="#" onClick="return tambah_subbidang(\''.$b->id.'\', \''.$b->nama.'\')"><i class="fa fa-plus"></i> Tambah SubBidang</a></li>
//                    </ul>
//                </div>
//                ';
                $row_bidang['action'] = '
                '.((Auth::user()->can('add-rpjm-perencanaan')) ? '<a class="btn btn-xs btn-default" onClick="return tambah_subbidang(\''.$b->id.'\', \''.$b->nama.'\')"><i class="fa fa-plus"></i> </a>' : '').'';
                $row_bidang['no'] = $i++;
                $row_bidang['bidang'] = $b['nama'];
                $row_bidang['kosong'] = '';
                $row_bidang['sub_bidang'] = '';
                $row_bidang['jenis_kegiatan'] = '';
                $row_bidang['lokasi'] = '';
                $row_bidang['volume'] = '';
                $row_bidang['manfaat'] = '';
                $row_bidang['th_1'] = '';
                $row_bidang['th_2'] = '';
                $row_bidang['th_3'] = '';
                $row_bidang['th_4'] = '';
                $row_bidang['th_5'] = '';
                $row_bidang['th_6'] = '';
                $row_bidang['jml'] = '';
                $row_bidang['sumber'] = '';
                $row_bidang['swakelola'] = '';
                $row_bidang['antar_desa'] = '';
                $row_bidang['pihak_tiga'] = '';
                $table[] = $row_bidang;

                $subbidang = KegiatanKerja::where('jenis', 'level_1')->where('bidang_id', $b['id'])->where('rpjm_id', $rpjm['id'])->get();
                foreach($subbidang as $sb){
//                    $row_subbidang['action'] = '
//                    <div class="btn-group">
//                        <button class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
//                        <ul class="dropdown-menu">
//                            <li><a href="#" onClick="return ubah_subbidang(\''.$sb->id.'\')"><i class="fa fa-edit"></i> Ubah</a></li>
//                            <li><a href="#" onClick="return tambah_kegiatan(\''.$sb->id.'\', \''.$b->nama.' - '.$sb->uraian.'\')"><i class="fa fa-plus"></i> Tambah Jenis Kegiatan</a></li>
//                            <li><a href="#" onClick="return hapus_kegiatan(\''.$sb->id.'\')"><i class="fa fa-trash"></i> Hapus</a></li>
//                        </ul>
//                    </div>
//                    ';
                    $row_subbidang['action'] = '
                    <div class="btn-group">
                    '.((Auth::user()->can('add-rpjm-perencanaan')) ? '<a class="btn btn-xs btn-default" onClick="return tambah_kegiatan(\''.$sb->id.'\', \''.$b->nama.' - '.$sb->uraian.'\')"><i class="fa fa-plus"></i> </a>' : '').'
                    '.((Auth::user()->can('edit-rpjm-perencanaan')) ? '<a class="btn btn-xs btn-default" onClick="return ubah_subbidang(\''.$sb->id.'\')"><i class="fa fa-edit"></i> </a>' : '').'
                    '.((Auth::user()->can('remove-rpjm-perencanaan')) ? '<a class="btn btn-xs btn-default" onClick="return hapus_kegiatan(\''.$sb->id.'\')"><i class="fa fa-trash"></i> </a>' : '' ).'
                    </div>
                    ';
                    $row_subbidang['no'] = '';
                    $row_subbidang['bidang'] = '';
                    $row_subbidang['kosong'] = '';
                    $row_subbidang['sub_bidang'] = $sb['uraian'];
                    $row_subbidang['jenis_kegiatan'] = '';
                    $row_subbidang['lokasi'] = '';
                    $row_subbidang['volume'] = '';
                    $row_subbidang['manfaat'] = '';
                    $row_subbidang['th_1'] = '';
                    $row_subbidang['th_2'] = '';
                    $row_subbidang['th_3'] = '';
                    $row_subbidang['th_4'] = '';
                    $row_subbidang['th_5'] = '';
                    $row_subbidang['th_6'] = '';
                    $row_subbidang['jml'] = '';
                    $row_subbidang['sumber'] = '';
                    $row_subbidang['swakelola'] = '';
                    $row_subbidang['antar_desa'] = '';
                    $row_subbidang['pihak_tiga'] = '';
                    $table[] = $row_subbidang;

                    $kegiatan = KegiatanKerja::where('jenis', 'level_2')->where('kegiatan_kerja_id', $sb->id)->where('rpjm_id', $rpjm['id'])->get();
                    foreach($kegiatan as $k){
//                        $row_kegiatan['action'] = '
//                        <div class="btn-group">
//                            <button class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
//                            <ul class="dropdown-menu">
//                                <li><a href="#" onClick="return ubah_kegiatan(\''.$k->id.'\')"><i class="fa fa-edit"></i> Ubah</a></li>
//                                <li><a href="#" onClick="return tambah_subkegiatan(\''.$k->id.'\', \''.$sb->uraian.' - '. $k->uraian.'\')"><i class="fa fa-plus"></i> Tambah Sub Kegiatan</a></li>
//                                <li><a href="#" onClick="return hapus_kegiatan('.$k->id.')"><i class="fa fa-trash"></i> Hapus</a></li>
//                            </ul>
//                        </div>
//                        ';
                        $row_kegiatan['action'] = '
                        <div class="btn-group">
                        '.( (Auth::user()->can('add-rpjm-perencanaan')) ? '<a class="btn btn-default btn-xs" onClick="return tambah_subkegiatan(\''.$k->id.'\', \''.$sb->uraian.' - '. $k->uraian.'\')"><i class="fa fa-plus"></i> </a>' : '').'
                        '.( (Auth::user()->can('edit-rpjm-perencanaan')) ? '<a class="btn btn-default btn-xs" onClick="return ubah_kegiatan(\''.$k->id.'\')"><i class="fa fa-edit"></i> </a>' : '' ).'
                        '.( (Auth::user()->can('remove-rpjm-perencanaan')) ? '<a class="btn btn-default btn-xs" onClick="return hapus_kegiatan('.$k->id.')"><i class="fa fa-trash"></i> </a>' : '').'
                        </div>
                        ';
                        $row_kegiatan['no'] = '';
                        $row_kegiatan['bidang'] = '';
                        $row_kegiatan['kosong'] = '';
                        $row_kegiatan['sub_bidang'] = '';
                        $row_kegiatan['jenis_kegiatan'] = $k['uraian'];
                        $row_kegiatan['lokasi'] = '';
                        $row_kegiatan['volume'] = '';
                        $row_kegiatan['manfaat'] = '';
                        $row_kegiatan['th_1'] = '';
                        $row_kegiatan['th_2'] = '';
                        $row_kegiatan['th_3'] = '';
                        $row_kegiatan['th_4'] = '';
                        $row_kegiatan['th_5'] = '';
                        $row_kegiatan['th_6'] = '';
                        $row_kegiatan['jml'] = '';
                        $row_kegiatan['sumber'] = '';
                        $row_kegiatan['swakelola'] = '';
                        $row_kegiatan['antar_desa'] = '';
                        $row_kegiatan['pihak_tiga'] = '';
                        $table[] = $row_kegiatan;

                        $sub_kegiatan = KegiatanKerja::where('jenis', 'level_3')->where('kegiatan_kerja_id', $k->id)->where('rpjm_id', $rpjm['id'])->get();
                        foreach($sub_kegiatan as $sk){
//                            $year   = Carbon::createFromDate($rpjm['tahun_awal'])->addYears(0)->year;
//                            $year_1 = Carbon::createFromDate($rpjm['tahun_awal'])->addYears(1)->year;
//                            $year_2 = Carbon::createFromDate($rpjm['tahun_awal'])->addYears(2)->year;
//                            $year_3 = Carbon::createFromDate($rpjm['tahun_awal'])->addYears(3)->year;
//                            $year_4 = Carbon::createFromDate($rpjm['tahun_awal'])->addYears(4)->year;
//                            $year_5 = Carbon::createFromDate($rpjm['tahun_awal'])->addYears(5)->year;
//                            $id = $sk->id;
//                            $rpjm_id = $rpjm['id'];

                            //untuk checked
//                            $checked_year = RPJM::whereHas('Rkps', function($q) use($year, $id){
//                                $q->where('tahun', $year)->where('kegiatan_kerja_id', $id);
//                            })->where('id', $rpjm_id)->count();
//
//                            $checked_year_1 = RPJM::whereHas('Rkps', function($q) use($year_1, $id){
//                                $q->where('tahun', $year_1)->where('kegiatan_kerja_id', $id);
//                            })->where('id', $rpjm_id)->count();
//                            $checked_year_2 = RPJM::whereHas('Rkps', function($q) use($year_2, $id){
//                                $q->where('tahun', $year_2)->where('kegiatan_kerja_id', $id);
//                            })->where('id', $rpjm_id)->count();
//                            $checked_year_3 = RPJM::whereHas('Rkps', function($q) use($year_3, $id){
//                                $q->where('tahun', $year_3)->where('kegiatan_kerja_id', $id);
//                            })->where('id', $rpjm_id)->count();
//                            $checked_year_4 = RPJM::whereHas('Rkps', function($q) use($year_4, $id){
//                                $q->where('tahun', $year_4)->where('kegiatan_kerja_id', $id);
//                            })->where('id', $rpjm_id)->count();
//                            $checked_year_5 = RPJM::whereHas('Rkps', function($q) use($year_5, $id){
//                                $q->where('tahun', $year_5)->where('kegiatan_kerja_id', $id);
//                            })->where('id', $rpjm_id)->count();

                            //untuk disabled
//                            $disabled_year = RPJM::whereHas('Rkps', function($q) use($year){
//                                $q->where('tahun', $year);
//                            })->where('id', $rpjm_id)->count();
//                            $disabled_year_1 = RPJM::whereHas('Rkps', function($q) use($year_1){
//                                $q->where('tahun', $year_1);
//                            })->where('id', $rpjm_id)->count();
//                            $disabled_year_2 = RPJM::whereHas('Rkps', function($q) use($year_2){
//                                $q->where('tahun', $year_2);
//                            })->where('id', $rpjm_id)->count();
//                            $disabled_year_3 = RPJM::whereHas('Rkps', function($q) use($year_3){
//                                $q->where('tahun', $year_3);
//                            })->where('id', $rpjm_id)->count();
//                            $disabled_year_4 = RPJM::whereHas('Rkps', function($q) use($year_4){
//                                $q->where('tahun', $year_4);
//                            })->where('id', $rpjm_id)->count();
//                            $disabled_year_5 = RPJM::whereHas('Rkps', function($q) use($year_5){
//                                $q->where('tahun', $year_5);
//                            })->where('id', $rpjm_id)->count();

//                            $row_subkegiatan['action'] = '
//                            <div class="btn-group">
//                                <button class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
//                                <ul class="dropdown-menu">
//                                    <li><a href="#" onClick="return ubah_subkegiatan(\''.$sk->id.'\')"><i class="fa fa-edit"></i> Ubah</a></li>
//                                    <li><a href="#" onClick="return hapus_kegiatan(\''.$sk->id.'\')"><i class="fa fa-trash"></i> Hapus</a></li>
//                                </ul>
//                            </div>
//                            ';
                            $row_subkegiatan['action'] = '
                            <div class="btn-group">
                            '.( (Auth::user()->can('edit-rpjm-perencanaan')) ? '<a class="btn btn-default btn-xs" onClick="return ubah_subkegiatan(\''.$sk->id.'\')"><i class="fa fa-edit"></i> </a>': '' ).'
                            '.( (Auth::user()->can('remove-rpjm-perencanaan')) ? '<a class="btn btn-default btn-xs" onClick="return hapus_kegiatan(\''.$sk->id.'\')"><i class="fa fa-trash"></i> </a>' : '' ).'
                            </div>
                            ';
                            $row_subkegiatan['no'] = '';
                            $row_subkegiatan['bidang'] = '';
                            $row_subkegiatan['kosong'] = '';
                            $row_subkegiatan['sub_bidang'] = '';
                            $row_subkegiatan['jenis_kegiatan'] = '<i class="fa fa-minus"></i> '.$sk['uraian'];
                            $row_subkegiatan['lokasi'] = ($sk->detailKegiatanKerjas) ? $sk->detailKegiatanKerjas->first()->lokasi : '';
                            $row_subkegiatan['volume'] = $sk->detailKegiatanKerjas->first()->volume;
                            $row_subkegiatan['manfaat'] = $sk->detailKegiatanKerjas->first()->manfaat;

                            $id = $sk->id;
                            $rpjm_id = $rpjm['id'];

                            $selisih = $rpjm['tahun_akhir'] - $rpjm['tahun_awal'];
                            $x = 1;
                            for($z=0; $z<$selisih; $z++){
                                $year = Carbon::createFromDate($rpjm['tahun_awal'])->addYears($z)->year;

                                $checked_year = RPJM::whereHas('Rkps', function($q) use($year, $id){
                                    $q->where('tahun', $year)->where('kegiatan_kerja_id', $id);
                                })->where('id', $rpjm_id)->count();

                                $disabled_year = RPJM::whereHas('Rkps', function($q) use($year){
                                    $q->where('tahun', $year);
                                })->where('id', $rpjm_id)->count();

                                $row_subkegiatan['th_'.$x] = '
                                <input type="checkbox" name="kegiatan_'.$rpjm_id.$id.$year.'[kegiatan_kerja_id]" value="'.$id.'" '.(($checked_year) ? 'checked' : '').' '.(($disabled_year) ? 'disabled' : '').'>
                                <input type="hidden" name="kegiatan_'.$rpjm_id.$id.$year.'[rpjm_id]" value="'.$rpjm_id.'">
                                <input type="hidden" name="kegiatan_'.$rpjm_id.$id.$year.'[tahun]" value="'.$year.'">';

                                $x++;
                            }

                            //Sesa
                            $y = (6 - $selisih);
                            for($z=0; $z<$y; $z++){
                                $row_subkegiatan['th_'.$x] = '';
                                $x++;
                            }

//                            $row_subkegiatan['th_1'] = '
//                            <input type="checkbox" name="kegiatan_'.$rpjm_id.$id.$year.'[kegiatan_kerja_id]" value="'.$id.'" '.(($checked_year) ? 'checked' : '').' '.(($disabled_year) ? 'disabled' : '').'>
//                            <input type="hidden" name="kegiatan_'.$rpjm_id.$id.$year.'[rpjm_id]" value="'.$rpjm_id.'">
//                            <input type="hidden" name="kegiatan_'.$rpjm_id.$id.$year.'[tahun]" value="'.$year.'">';
//                            $row_subkegiatan['th_2'] = '
//                            <input type="checkbox" name="kegiatan_'.$rpjm_id.$id.$year_1.'[kegiatan_kerja_id]" value="'.$id.'" '.(($checked_year_1) ? 'checked' : '').' '.(($disabled_year_1) ? 'disabled' : '').'>
//                            <input type="hidden" name="kegiatan_'.$rpjm_id.$id.$year_1.'[rpjm_id]" value="'.$rpjm_id.'">
//                            <input type="hidden" name="kegiatan_'.$rpjm_id.$id.$year_1.'[tahun]" value="'.$year_1.'">';
//                            $row_subkegiatan['th_3'] = '
//                            <input type="checkbox" name="kegiatan_'.$rpjm_id.$id.$year_2.'[kegiatan_kerja_id]" value="'.$id.'" '.(($checked_year_2) ? 'checked' : '').' '.(($disabled_year_2) ? 'disabled' : '').'>
//                            <input type="hidden" name="kegiatan_'.$rpjm_id.$id.$year_2.'[rpjm_id]" value="'.$rpjm_id.'">
//                            <input type="hidden" name="kegiatan_'.$rpjm_id.$id.$year_2.'[tahun]" value="'.$year_2.'">';
//                            $row_subkegiatan['th_4'] = '
//                            <input type="checkbox" name="kegiatan_'.$rpjm_id.$id.$year_3.'[kegiatan_kerja_id]" value="'.$id.'" '.(($checked_year_3) ? 'checked' : '').' '.(($disabled_year_3) ? 'disabled' : '').'>
//                            <input type="hidden" name="kegiatan_'.$rpjm_id.$id.$year_3.'[rpjm_id]" value="'.$rpjm_id.'">
//                            <input type="hidden" name="kegiatan_'.$rpjm_id.$id.$year_3.'[tahun]" value="'.$year_3.'">';
//                            $row_subkegiatan['th_5'] = '
//                            <input type="checkbox" name="kegiatan_'.$rpjm_id.$id.$year_4.'[kegiatan_kerja_id]" value="'.$id.'" '.(($checked_year_4) ? 'checked' : '').' '.(($disabled_year_4) ? 'disabled' : '').'>
//                            <input type="hidden" name="kegiatan_'.$rpjm_id.$id.$year_4.'[rpjm_id]" value="'.$rpjm_id.'">
//                            <input type="hidden" name="kegiatan_'.$rpjm_id.$id.$year_4.'[tahun]" value="'.$year_4.'">';
//                            $row_subkegiatan['th_6'] = '
//                            <input type="checkbox" name="kegiatan_'.$rpjm_id.$id.$year_5.'[kegiatan_kerja_id]" value="'.$id.'" '.(($checked_year_5) ? 'checked' : '').' '.(($disabled_year_5) ? 'disabled' : '').'>
//                            <input type="hidden" name="kegiatan_'.$rpjm_id.$id.$year_5.'[rpjm_id]" value="'.$rpjm_id.'">
//                            <input type="hidden" name="kegiatan_'.$rpjm_id.$id.$year_5.'[tahun]" value="'.$year_5.'">';

                            $row_subkegiatan['jml'] = number_format($sk->detailKegiatanKerjas->first()->jumlah_dana, 2, ',', '.');
                            $row_subkegiatan['sumber'] = $sk->detailKegiatanKerjas->first()->sumberDana->nama;
                            $row_subkegiatan['swakelola'] = ($sk->detailKegiatanKerjas->first()->pola_pelaksanaan == "SWAKELOLA") ? '<i class="fa fa-check"></i>' : '';
                            $row_subkegiatan['antar_desa'] = ($sk->detailKegiatanKerjas->first()->pola_pelaksanaan == "KERJASAMA ANTAR DESA") ? '<i class="fa fa-check"></i>' : '';
                            $row_subkegiatan['pihak_tiga'] = ($sk->detailKegiatanKerjas->first()->pola_pelaksanaan == "KERJASAMA PIHAK 3") ? '<i class="fa fa-check"></i>' : '';
                            $table[] = $row_subkegiatan;
                        }
                    }
                }
            }

            return response()->json(['data'=>$table], 200);
        }

        return view('content.perencanaan.rpjm', compact('rpjm', 'bidang'));
    }

    public function tambahRpjm(Request $request, RPJM $rpjm, Carbon $carbon)
    {
        $jumlah = $request->jumlah_tahun;
        $tahun_awal = $carbon->now()->year;
        $tahun_akhir = $carbon->now()->addYears($jumlah)->year;
        $periode = $tahun_awal.' - '.$tahun_akhir;
        $tambah = [
            'periode' => $periode,
            'tahun_awal' => $tahun_awal,
            'tahun_akhir' => $tahun_akhir
        ];
        $rpjm->firstOrCreate($tambah);

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RPJMCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $array = [];
        foreach($data as $d){
            if(!empty($d['kegiatan_kerja_id'])){
                $array[] = $d;
            }
        }

        foreach($array as $key=>$val){
            rkp::firstOrCreate($val);
        }
        //return $array;
        return redirect()->back();
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
        $rPJM = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $rPJM,
            ]);
        }

        return view('rpjm.show', compact('rPJM'));
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

        $rPJM = $this->repository->find($id);

        return view('rpjm.edit', compact('rPJM'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RPJMUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $rPJM = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'RPJM updated.',
                'data'    => $rPJM->toArray(),
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
                    'message' => 'RPJM Berhasil Dihapus',
                ], 201);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }

        return redirect()->back()->with('message', 'RPJM deleted.');
    }

    public function excel()
    {
        $rpjm = RPJM::all()->last();
        $bidang = Bidang::where('jenis', 'belanja')->get();

        $filename = 'rpjm-'.str_replace(' ', '', $rpjm->periode).'.xls';
        if(request()->wantsJson()) {
            $template = resource_path('assets/template-laporan/rpjm.xls');

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
            $objPHPExcel->getActiveSheet()->setCellValue('A6', strtoupper('Rancangan RPJM '.$desa.' '.$namaDesa));
            //---------------End Header

            $table = [];
            $i = 1;
            foreach($bidang as $b){
                $row_bidang['no'] = $i++;
                $row_bidang['bidang'] = $b['nama'];
                $row_bidang['kosong'] = '';
                $row_bidang['sub_bidang'] = '';
                $row_bidang['jenis_kegiatan'] = '';
                $row_bidang['lokasi'] = '';
                $row_bidang['volume'] = '';
                $row_bidang['manfaat'] = '';
                $row_bidang['th_1'] = '';
                $row_bidang['th_2'] = '';
                $row_bidang['th_3'] = '';
                $row_bidang['th_4'] = '';
                $row_bidang['th_5'] = '';
                $row_bidang['th_6'] = '';
                $row_bidang['jml'] = '';
                $row_bidang['sumber'] = '';
                $row_bidang['swakelola'] = '';
                $row_bidang['antar_desa'] = '';
                $row_bidang['pihak_tiga'] = '';
                $table[] = $row_bidang;

                $subbidang = KegiatanKerja::where('jenis', 'level_1')->where('bidang_id', $b['id'])->where('rpjm_id', $rpjm['id'])->get();
                foreach($subbidang as $sb){
                    $row_subbidang['no'] = '';
                    $row_subbidang['bidang'] = '';
                    $row_subbidang['kosong'] = '';
                    $row_subbidang['sub_bidang'] = $sb['uraian'];
                    $row_subbidang['jenis_kegiatan'] = '';
                    $row_subbidang['lokasi'] = '';
                    $row_subbidang['volume'] = '';
                    $row_subbidang['manfaat'] = '';
                    $row_subbidang['th_1'] = '';
                    $row_subbidang['th_2'] = '';
                    $row_subbidang['th_3'] = '';
                    $row_subbidang['th_4'] = '';
                    $row_subbidang['th_5'] = '';
                    $row_subbidang['th_6'] = '';
                    $row_subbidang['jml'] = '';
                    $row_subbidang['sumber'] = '';
                    $row_subbidang['swakelola'] = '';
                    $row_subbidang['antar_desa'] = '';
                    $row_subbidang['pihak_tiga'] = '';
                    $table[] = $row_subbidang;

                    $kegiatan = KegiatanKerja::where('jenis', 'level_2')->where('kegiatan_kerja_id', $sb->id)->where('rpjm_id', $rpjm['id'])->get();
                    foreach($kegiatan as $k){
                        $row_kegiatan['no'] = '';
                        $row_kegiatan['bidang'] = '';
                        $row_kegiatan['kosong'] = '';
                        $row_kegiatan['sub_bidang'] = '';
                        $row_kegiatan['jenis_kegiatan'] = $k['uraian'];
                        $row_kegiatan['lokasi'] = '';
                        $row_kegiatan['volume'] = '';
                        $row_kegiatan['manfaat'] = '';
                        $row_kegiatan['th_1'] = '';
                        $row_kegiatan['th_2'] = '';
                        $row_kegiatan['th_3'] = '';
                        $row_kegiatan['th_4'] = '';
                        $row_kegiatan['th_5'] = '';
                        $row_kegiatan['th_6'] = '';
                        $row_kegiatan['jml'] = '';
                        $row_kegiatan['sumber'] = '';
                        $row_kegiatan['swakelola'] = '';
                        $row_kegiatan['antar_desa'] = '';
                        $row_kegiatan['pihak_tiga'] = '';
                        $table[] = $row_kegiatan;

                        $sub_kegiatan = KegiatanKerja::where('jenis', 'level_3')->where('kegiatan_kerja_id', $k->id)->where('rpjm_id', $rpjm['id'])->get();
                        foreach($sub_kegiatan as $sk){

                            $row_subkegiatan['no'] = '';
                            $row_subkegiatan['bidang'] = '';
                            $row_subkegiatan['kosong'] = '';
                            $row_subkegiatan['sub_bidang'] = '';
                            $row_subkegiatan['jenis_kegiatan'] = '- '.$sk['uraian'];
                            $row_subkegiatan['lokasi'] = $sk->detailKegiatanKerjas->first()->lokasi;
                            $row_subkegiatan['volume'] = $sk->detailKegiatanKerjas->first()->volume;
                            $row_subkegiatan['manfaat'] = $sk->detailKegiatanKerjas->first()->manfaat;

                            $id = $sk->id;
                            $rpjm_id = $rpjm['id'];

                            $selisih = $rpjm['tahun_akhir'] - $rpjm['tahun_awal'];
                            $x = 1;
                            for($z=0; $z<$selisih; $z++){
                                $year = Carbon::createFromDate($rpjm['tahun_awal'])->addYears($z)->year;

                                $checked_year = RPJM::whereHas('Rkps', function($q) use($year, $id){
                                    $q->where('tahun', $year)->where('kegiatan_kerja_id', $id);
                                })->where('id', $rpjm_id)->count();

                                $row_subkegiatan['th_'.$x] = ($checked_year) ? 'V' : '';
                                $x++;
                            }
                            //Sesa
                            $y = (6 - $selisih);
                            for($z=0; $z<$y; $z++){
                                $row_subkegiatan['th_'.$x] = '';
                                $x++;
                            }

                            $row_subkegiatan['jml'] = number_format($sk->detailKegiatanKerjas->first()->jumlah_dana, 2, ',', '.');
                            $row_subkegiatan['sumber'] = $sk->detailKegiatanKerjas->first()->sumberDana->nama;
                            $row_subkegiatan['swakelola'] = ($sk->detailKegiatanKerjas->first()->pola_pelaksanaan == "SWAKELOLA") ? 'V' : '';
                            $row_subkegiatan['antar_desa'] = ($sk->detailKegiatanKerjas->first()->pola_pelaksanaan == "KERJASAMA ANTAR DESA") ? 'V' : '';
                            $row_subkegiatan['pihak_tiga'] = ($sk->detailKegiatanKerjas->first()->pola_pelaksanaan == "KERJASAMA PIHAK 3") ? 'V' : '';
                            $table[] = $row_subkegiatan;
                        }
                    }
                }
            }

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
                    ->setCellValue('I' . $row_excel, $t['th_1'])
                    ->setCellValue('J' . $row_excel, $t['th_2'])
                    ->setCellValue('K' . $row_excel, $t['th_3'])
                    ->setCellValue('L' . $row_excel, $t['th_4'])
                    ->setCellValue('M' . $row_excel, $t['th_5'])
                    ->setCellValue('N' . $row_excel, $t['th_6'])
                    ->setCellValue('O' . $row_excel, $t['jml'])
                    ->setCellValue('P' . $row_excel, $t['sumber'])
                    ->setCellValue('Q' . $row_excel, $t['swakelola'])
                    ->setCellValue('R' . $row_excel, $t['antar_desa'])
                    ->setCellValue('S' . $row_excel, $t['pihak_tiga']);
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
}
