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
use App\Repositories\RKKRepository;
use App\Validators\RKKValidator;


class RKKController extends Controller
{

    /**
     * @var RKKRepository
     */
    protected $repository;

    /**
     * @var RKKValidator
     */
    protected $validator;

    public function __construct(RKKRepository $repository, RKKValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $rpjm = RPJM::all()->last();

        if($id <= ($rpjm['tahun_akhir'] - $rpjm['tahun_awal']) ){
            $tahun = Carbon::createFromDate($rpjm['tahun_awal'])->addYears($id-1)->year;

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
            $subbidang = KegiatanKerja::where('jenis', 'level_1')
                ->where('bidang_id', 5)
                ->whereIn('id', $current_subbidang_id)
                ->where('rpjm_id', $rpjm['id'])
                ->get();
            if(request()->wantsJson()){

                $tabel = [];
                $i = 1;
                foreach($bidang as $b) {
                    $row['act']                 = '';
                    $row['no']                  = $i;
                    $row['bidang']              = $b->nama;
                    $row['sub_bidang']          = '';
                    $row['jenis_kegiatan']      = '';
                    $row['lokasi']              = '';
                    $row['volume']              = '';
                    $row['satuan']              = '';
                    $row['biaya']               = '';
                    $row['jumlah_sasaran']      = '';
                    $row['jumlah_laki_laki']    = '';
                    $row['jumlah_perempuan']    = '';
                    $row['jumlah_rtm']          = '';
                    $row['pelaksanaan_durasi']  = '';
                    $row['pelaksanaan_mulai']   = '';
                    $row['pelaksanaan_selesai'] = '';
                    $tabel[] = $row;
                    //--------------------------------------------------------------------------------------------------
                    $subbidang = KegiatanKerja::where('jenis', 'level_1')
                        ->where('bidang_id', $b->id)
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

                        $row['act']                 = '';
                        $row['no']                  = '';
                        $row['bidang']              = '';
                        $row['sub_bidang']          = $sb->uraian;
                        $row['jenis_kegiatan']      = '';
                        $row['lokasi']              = '';
                        $row['volume']              = '';
                        $row['satuan']              = '';
                        $row['biaya']               = '';
                        $row['jumlah_sasaran']      = '';
                        $row['jumlah_laki_laki']    = '';
                        $row['jumlah_perempuan']    = '';
                        $row['jumlah_rtm']          = '';
                        $row['pelaksanaan_durasi']  = '';
                        $row['pelaksanaan_mulai']   = '';
                        $row['pelaksanaan_selesai'] = '';
                        $tabel[] = $row;

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

                            $row['act']                 = '';
                            $row['no']                  = '';
                            $row['bidang']              = '';
                            $row['sub_bidang']          = '';
                            $row['jenis_kegiatan']      = $k->uraian;
                            $row['lokasi']              = '';
                            $row['volume']              = '';
                            $row['satuan']              = '';
                            $row['biaya']               = '';
                            $row['jumlah_sasaran']      = '';
                            $row['jumlah_laki_laki']    = '';
                            $row['jumlah_perempuan']    = '';
                            $row['jumlah_rtm']          = '';
                            $row['pelaksanaan_durasi']  = '';
                            $row['pelaksanaan_mulai']   = '';
                            $row['pelaksanaan_selesai'] = '';
                            $tabel[] = $row;


                            foreach($sub_kegiatan as $sk){
                                $rkp = RKP::where('tahun', $tahun)->where('rpjm_id', $rpjm['id'])->where('kegiatan_kerja_id', $current_subkegiatan_id)->first();

                                $id_detail = $sk->detailKegiatanKerjas->first()['id'];
                                $rkk = RKK::where('detail_kegiatan_kerja_id', $id_detail)->where('rkp_id', $rkp['id'])->first();
                                $mulai = Carbon::parse($rkk['mulai']);
                                $selesai = Carbon::parse($rkk['selesai']);
                                $row['act']                 = '
                                '. ((Auth::user()->can('add-rkk-perencanaan')) ? '
                                <a class="btn btn-xs btn-default" onclick="return tambah(
                                \''.$id_detail.'\', \''.$sk->uraian.'\', \''.$rkp['id'].'\'
                                )" '.(($rkk) ? 'disabled' : '').'><i class="fa fa-plus"></i></a>
                                ' : '' ).'
                                '.( (Auth::user()->can('edit-rkk-perencanaan')) ? '<a class="btn btn-xs btn-default" onclick="return ubah(
                                \''.$sk->uraian.'\', \''.$rkk['id'].'\', \''.$rkk['sasaran_laki_laki'].'\', \''.$rkk['sasaran_perempuan'].'\', \''.$rkk['sasaran_a_rtm'].'\', \''.$rkk['mulai'].'\', \''.$rkk['selesai'].'\'
                                )"><i class="fa fa-edit"></i></a>' : '').'
                                ';
                                $row['no']                  = '';
                                $row['bidang']              = '';
                                $row['sub_bidang']          = '';
                                $row['jenis_kegiatan']      = '<i class="fa fa-minus"></i>'.$sk->uraian;
                                $row['lokasi']              = $sk->detailKegiatanKerjas->first()->lokasi;
                                $row['volume']              = $sk->detailKegiatanKerjas->first()->volume;
                                $row['satuan']              = '';
                                $row['biaya']               = number_format($sk->detailKegiatanKerjas->first()->jumlah_dana, 2, ',', '.');
                                $row['jumlah_sasaran']      = $rkk['sasaran_laki_laki'] + $rkk['sasaran_perempuan'] +$rkk['sasaran_a_rtm'];
                                $row['jumlah_laki_laki']    = $rkk['sasaran_laki_laki'];
                                $row['jumlah_perempuan']    = $rkk['sasaran_perempuan'];
                                $row['jumlah_rtm']          = $rkk['sasaran_a_rtm'];
                                $row['pelaksanaan_durasi']  = ($rkk['mulai']) ? $selesai->diffInDays($mulai).' Hari' : '';
                                $row['pelaksanaan_mulai']   = ($rkk['mulai']) ? $mulai->format('d-m-Y') : '';
                                $row['pelaksanaan_selesai'] = ($rkk['selesai']) ? $selesai->format('d-m-Y') : '';
                                $tabel[] = $row;
                            }
                        }
                    }
                    //--------------------------------------------------------------------------------------------------
                    $i++;
                }
                return response()->json(['data'=>$tabel]);
            }

            return view('content.perencanaan.rkk', compact('tahun', 'id'));

        }
        return redirect()->route('rkk.index', ($rpjm['tahun_akhir'] - $rpjm['tahun_awal']) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RKKCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tambah = [
                'sasaran_laki_laki' => $request->jumlah_laki_laki,
                'sasaran_perempuan' => $request->jumlah_perempuan,
                'sasaran_a_rtm' => $request->jumlah_rt_m,
                'mulai' => $request->waktu_mulai,
                'selesai' => $request->waktu_selesai,
                'rkp_id' => $request->rkp_id,
                'detail_kegiatan_kerja_id' => $request->detail_kegiatan_kerja_id
            ];

            RKK::firstOrCreate($tambah);

            $response = [
                'message' => 'RKK Berhasil Ditambahkan',
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rKK = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $rKK,
            ]);
        }

        return view('rKKs.show', compact('rKK'));
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

        $rKK = $this->repository->find($id);

        return view('rKKs.edit', compact('rKK'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RKKUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $ubah = [
                'sasaran_laki_laki' => $request->jumlah_laki_laki,
                'sasaran_perempuan' => $request->jumlah_perempuan,
                'sasaran_a_rtm' => $request->jumlah_rt_m,
                'mulai' => $request->waktu_mulai,
                'selesai' => $request->waktu_selesai,
            ];

            RKK::find($id)->update($ubah);

            $response = [
                'message' => 'RKK updated.',
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
                    'message' => 'RKK Berhasil Dihapus',
                ], 201);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }

        return redirect()->back()->with('message', 'RKK deleted.');
    }

    public function excel($id)
    {
        $rpjm = RPJM::all()->last();

        if($id <= ($rpjm['tahun_akhir'] - $rpjm['tahun_awal']) ){
            $tahun = Carbon::createFromDate($rpjm['tahun_awal'])->addYears($id-1)->year;

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

            $filename = 'rkk-'.str_replace(' ', '', $tahun).'.xls';

            $bidang = Bidang::where('jenis', 'belanja')->get();
            $subbidang = KegiatanKerja::where('jenis', 'level_1')
                ->where('bidang_id', 5)
                ->whereIn('id', $current_subbidang_id)
                ->where('rpjm_id', $rpjm['id'])
                ->get();
            if(request()->wantsJson()){
                $template = resource_path('assets/template-laporan/rkk.xls');
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

                $tabel = [];
                $i = 1;
                foreach($bidang as $b) {
                    $row['no']                  = $i;
                    $row['bidang']              = $b->nama;
                    $row['sub_bidang']          = '';
                    $row['jenis_kegiatan']      = '';
                    $row['lokasi']              = '';
                    $row['volume']              = '';
                    $row['satuan']              = '';
                    $row['biaya']               = '';
                    $row['jumlah_sasaran']      = '';
                    $row['jumlah_laki_laki']    = '';
                    $row['jumlah_perempuan']    = '';
                    $row['jumlah_rtm']          = '';
                    $row['pelaksanaan_durasi']  = '';
                    $row['pelaksanaan_mulai']   = '';
                    $row['pelaksanaan_selesai'] = '';
                    $tabel[] = $row;
                    //--------------------------------------------------------------------------------------------------
                    $subbidang = KegiatanKerja::where('jenis', 'level_1')
                        ->where('bidang_id', $b->id)
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

                        $row['no']                  = '';
                        $row['bidang']              = '';
                        $row['sub_bidang']          = $sb->uraian;
                        $row['jenis_kegiatan']      = '';
                        $row['lokasi']              = '';
                        $row['volume']              = '';
                        $row['satuan']              = '';
                        $row['biaya']               = '';
                        $row['jumlah_sasaran']      = '';
                        $row['jumlah_laki_laki']    = '';
                        $row['jumlah_perempuan']    = '';
                        $row['jumlah_rtm']          = '';
                        $row['pelaksanaan_durasi']  = '';
                        $row['pelaksanaan_mulai']   = '';
                        $row['pelaksanaan_selesai'] = '';
                        $tabel[] = $row;

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

                            $row['no']                  = '';
                            $row['bidang']              = '';
                            $row['sub_bidang']          = '';
                            $row['jenis_kegiatan']      = $k->uraian;
                            $row['lokasi']              = '';
                            $row['volume']              = '';
                            $row['satuan']              = '';
                            $row['biaya']               = '';
                            $row['jumlah_sasaran']      = '';
                            $row['jumlah_laki_laki']    = '';
                            $row['jumlah_perempuan']    = '';
                            $row['jumlah_rtm']          = '';
                            $row['pelaksanaan_durasi']  = '';
                            $row['pelaksanaan_mulai']   = '';
                            $row['pelaksanaan_selesai'] = '';
                            $tabel[] = $row;


                            foreach($sub_kegiatan as $sk){
                                $rkp = RKP::where('tahun', $tahun)->where('rpjm_id', $rpjm['id'])->where('kegiatan_kerja_id', $current_subkegiatan_id)->first();

                                $id_detail = $sk->detailKegiatanKerjas->first()['id'];
                                $rkk = RKK::where('detail_kegiatan_kerja_id', $id_detail)->where('rkp_id', $rkp['id'])->first();
                                $mulai = Carbon::parse($rkk['mulai']);
                                $selesai = Carbon::parse($rkk['selesai']);
                                $row['no']                  = '';
                                $row['bidang']              = '';
                                $row['sub_bidang']          = '';
                                $row['jenis_kegiatan']      = '- '.$sk->uraian;
                                $row['lokasi']              = $sk->detailKegiatanKerjas->first()->lokasi;
                                $row['volume']              = $sk->detailKegiatanKerjas->first()->volume;
                                $row['satuan']              = '';
                                $row['biaya']               = $sk->detailKegiatanKerjas->first()->jumlah_dana;
                                $row['jumlah_sasaran']      = $rkk['sasaran_laki_laki'] + $rkk['sasaran_perempuan'] +$rkk['sasaran_a_rtm'];
                                $row['jumlah_laki_laki']    = $rkk['sasaran_laki_laki'];
                                $row['jumlah_perempuan']    = $rkk['sasaran_perempuan'];
                                $row['jumlah_rtm']          = $rkk['sasaran_a_rtm'];
                                $row['pelaksanaan_durasi']  = ($rkk['mulai']) ? $selesai->diffInDays($mulai).' Hari' : '';
                                $row['pelaksanaan_mulai']   = ($rkk['mulai']) ? $mulai->format('d-m-Y') : '';
                                $row['pelaksanaan_selesai'] = ($rkk['selesai']) ? $selesai->format('d-m-Y') : '';
                                $tabel[] = $row;
                            }
                        }
                    }
                    //--------------------------------------------------------------------------------------------------
                    $i++;
                }

                //save
                $baseRow = 12;
                $j = 0;
                foreach($tabel as $t){
                    $row_excel = $baseRow + $j;

                    $objPHPExcel->getActiveSheet()->insertNewRowBefore($row_excel, 1);
                    $objPHPExcel->getActiveSheet()
                        ->setCellValue('A' . $row_excel, $t['no'])
                        ->setCellValue('B' . $row_excel, $t['bidang'])
                        ->setCellValue('C' . $row_excel, $t['sub_bidang'])
                        ->setCellValue('D' . $row_excel, $t['jenis_kegiatan'])
                        ->setCellValue('E' . $row_excel, $t['lokasi'])
                        ->setCellValue('F' . $row_excel, $t['volume'])
                        ->setCellValue('G' . $row_excel, $t['satuan'])
                        ->setCellValue('H' . $row_excel, $t['biaya'])
                        ->setCellValue('I' . $row_excel, $t['jumlah_sasaran'])
                        ->setCellValue('J' . $row_excel, $t['jumlah_laki_laki'])
                        ->setCellValue('K' . $row_excel, $t['jumlah_perempuan'])
                        ->setCellValue('L' . $row_excel, $t['jumlah_rtm'])
                        ->setCellValue('M' . $row_excel, $t['pelaksanaan_durasi'])
                        ->setCellValue('N' . $row_excel, $t['pelaksanaan_mulai'])
                        ->setCellValue('O' . $row_excel, $t['pelaksanaan_selesai']);
                    $j++;
                }

                $objPHPExcel->getActiveSheet()->removeRow($baseRow - 1, 1);
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('file-laporan/'.$filename);

                return response()->json([
                    'message' => 'Data Berhasil diExport'
                ], 201);

            }
            //doenload
            return response()->download(public_path('file-laporan/'.$filename));

        }
        return redirect()->route('rkk.index', ($rpjm['tahun_akhir'] - $rpjm['tahun_awal']) );
    }
}
