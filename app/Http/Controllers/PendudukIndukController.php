<?php

namespace App\Http\Controllers;

use App\Entities\AnggotaKeluarga;
use App\Entities\PendudukInduk;
use App\Entities\ProfilDesa;
use App\Presenters\IndukSelectAparatPresenter;
use App\Repositories\PendudukRepository;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Settings;
use PHPExcel_Shared_Date;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\PendudukIndukRepository;
use App\Validators\PendudukIndukValidator;
use App\Entities\Penduduk;
use App\Entities\PendudukInduk as Induk;


class PendudukIndukController extends Controller
{

    /**
     * @var PendudukIndukRepository
     */
    protected $repository;
    protected $repoPenduduk;

    /**
     * @var PendudukIndukValidator
     */
    protected $validator;

    public function __construct(PendudukIndukRepository $repository, PendudukIndukValidator $validator, PendudukRepository $repoPenduduk)
    {
        $this->repository = $repository;
        $this->repoPenduduk = $repoPenduduk;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {

            $induk = $this->repoPenduduk->all();

            return response()->json([
                'data' => $induk,
            ]);
        }

        return view('content.penduduk.induk');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PendudukIndukCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            if ($request->wantsJson()) {

                $penduduk = [
                    'nama' => $request->nama,
                    'tempat_lahir'     => $request->tempat_lahir,
                    'tanggal_lahir'    => $request->tanggal_lahir,
                    'jenis_kelamin'    => $request->jenis_kelamin,
                    'kewarga_negaraan' => $request->kewarga_negaraan,
                ];
                $induk = [
                    'nik'               => $request->nik,
                    'agama'             => $request->agama,
                    'status_perkawinan' => $request->status_perkawinan,
                    'pendidikan'        => $request->pendidikan,
                    'pekerjaan_id'      => $request->pekerjaan,
                    'alamat'            => $request->alamat,
                    'keterangan'        => $request->keterangan,
                    'nomor_kk'          => $request->nomor_kk,
                    'membaca'           => $request->membaca,
                    'status_keluarga_id'=> $request->status_keluarga,
                    'dusun'             => $request->dusun,
                    'rw_id'             => $request->rw,
                    'rt_id'             => $request->rt,
                    'nik_ayah'          => $request->ayah,
                    'nik_ibu'           => $request->ibu,
                    'ayah'              => ($request->ayah) ? NULL : $request->ayah_input,
                    'ibu'               => ($request->ibu) ? NULL : $request->ibu_input,
                    'golongan_darah'    => $request->golongan_darah,
//                    'penduduk_id' => $p->id,
                ];
                $data = DB::transaction(function() use ($penduduk, $induk){
                    $p = Penduduk::create($penduduk);
                    $induk_insert = $induk;
                    $induk_insert['penduduk_id'] = $p->id;
                    Induk::create($induk_insert);
                });

                $response = [
                    'message' => 'Penduduk Induk Berhasil Ditambahkan',
                ];

                return response()->json($response, 201);
            }

            return redirect()->back();
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ], 422);
            }

            return redirect()->back();
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

        if (request()->wantsJson()) {
            $data[] = $this->repoPenduduk->find($id);

            return response()->json([
                'data' => $data,
            ]);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  PendudukIndukUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            if ($request->wantsJson()) {

                $penduduk = [
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'kewarga_negaraan' => $request->kewarga_negaraan,
                ];
                $induk = [
                    'nik' => $request->nik,
                    'golongan_darah' => $request->golongan_darah,
                    'agama' => $request->agama,
                    'status_perkawinan' => $request->status_perkawinan,
                    'pendidikan' => $request->pendidikan,
                    'pekerjaan_id' => $request->pekerjaan,
                    'alamat' => $request->alamat,
                    'membaca' => $request->membaca,
                    'keterangan' => $request->keterangan,
                    'nomor_kk' => $request->nomor_kk,
                    'status_keluarga_id' => $request->status_keluarga,
                    'dusun' => $request->dusun,
                    'nik_ayah' => $request->ayah,
                    'nik_ibu' => $request->ibu,
                    'ayah'              => ($request->ayah) ? NULL : $request->ayah_input,
                    'ibu'               => ($request->ibu) ? NULL : $request->ibu_input,
                    'rw_id' => $request->rw,
                    'rt_id' => $request->rt,
                ];
                DB::transaction(function() use ($penduduk, $induk, $id){
                    Penduduk::find($id)->update($penduduk);
                    Induk::where('penduduk_id', $id)->update($induk);
                });

                $response = [
                    'message' => 'Penduduk Induk Berhasil Diubah',
//                    'data' => $request->status_keluarga
                ];

                return response()->json($response);
            }

            return redirect()->back();
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ], 422);
            }

            return redirect()->back();
        }
    }

    public function ortuAyah(Request $request, $id)
    {
        if ($request->wantsJson()) {
            $induk = [
                'nik_ayah' => $request->ayah,
                'ayah'     => ($request->ayah) ? NULL : $request->ayah_input,
            ];
            Induk::where('penduduk_id', $id)->update($induk);

            $response = [
                'message' => 'Penduduk Induk Berhasil Diubah',
            ];

            return response()->json($response);
        }
    }

    public function ortuIbu(Request $request, $id)
    {
        if ($request->wantsJson()) {
            $induk = [
                'nik_ibu'  => $request->ibu,
                'ibu'      => ($request->ibu) ? NULL : $request->ibu_input,
            ];
            Induk::where('penduduk_id', $id)->update($induk);

            $response = [
                'message' => 'Penduduk Induk Berhasil Diubah',
            ];

            return response()->json($response);
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

            try{
                DB::transaction(function() use ($id){
                    Induk::where('penduduk_id', $id)->delete();
                    Penduduk::find($id)->delete();
                });

                return response()->json([
                    'message' => 'Penduduk Induk Berhasil Dihapus',
                ]);
            }catch (QueryException $e){
                return response()->json([
                    'error'   => true,
                    'message' => 'Data Tidak Bisa Dihapus',
                    'exeption' => $e->errorInfo,
                ], 500);
            }
        }

        return redirect()->back();
    }

    public function showSelect($nik)
    {
        if(request()->wantsJson()){
            $data[] = $this->repository->setPresenter(IndukSelectAparatPresenter::class)->find($nik);

            return response()->json($data);
        }
    }

    public function excel()
    {
        $filename = Carbon::now()->format('Y-m').'-penduduk-induk.xls';
        if(request()->wantsJson()) {
            $template = resource_path('assets/template-laporan/buku-penduduk-induk.xls');

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

            $baseRow = 13;
            $i = 0;
            $induk = $this->repoPenduduk->all()['data'];
            foreach ($induk as $dataRow) {
                $row = $baseRow + $i;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row, $i + 1)
                    ->setCellValue('B' . $row, $dataRow['nama'])
                    ->setCellValue('C' . $row, $dataRow['jenis_kelamin'])
                    ->setCellValue('D' . $row, $dataRow['status_perkawinan'])
                    ->setCellValue('E' . $row, $dataRow['tempat_lahir'])
                    ->setCellValue('F' . $row, $dataRow['tanggal_lahir'])
                    ->setCellValue('G' . $row, $dataRow['agama'])
                    ->setCellValue('H' . $row, $dataRow['pendidikan'])
                    ->setCellValue('I' . $row, $dataRow['pekerjaan'])
                    ->setCellValue('J' . $row, $dataRow['membaca'])
                    ->setCellValue('K' . $row, $dataRow['kewarga_negaraan'])
                    ->setCellValue('L' . $row, $dataRow['alamat'])
                    ->setCellValue('M' . $row, $dataRow['status_keluarga'])
                    ->setCellValue('N' . $row, $dataRow['nik'])
                    ->setCellValue('O' . $row, $dataRow['nomor_kk'])
                    ->setCellValue('P' . $row, $dataRow['keterangan']);
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

    public function SelectKK()
    {
        $kartu_keluarga = [];
        $kartu = AnggotaKeluarga::all();
        $induk = new PendudukInduk();
        foreach($kartu as $k){
            $kk = $induk->whereHas('statusKeluarga', function($q){
                $q->where('kode', 'KK');
            })->where('nomor_kk', $k->nomor_kk)->first()['penduduk_id'];
            $row['nomor_kk'] = $k->nomor_kk;
            $row['kepala_keluarga'] = Penduduk::find($kk)['nama'];
            $row['act'] = '<button class="btn btn-flat btn-default btn-sm" onclick="pilih('.$k->nomor_kk.')" data-dismiss="modal"><i class="fa fa-download"></i></button> ';

            $kartu_keluarga[] = $row;
        }
        return response()->json(['data'=>$kartu_keluarga]);
    }


    public function print_data()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);

        define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

        date_default_timezone_set('Europe/London');

        $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;

//        $rendererLibrary = 'tc';
        echo $rendererLibraryPath = resource_path('assets/tcpdf');

//        $template = resource_path('assets/template-laporan/buku-penduduk-induk.xlsx');
        $template = resource_path('assets/template-laporan/induk.xlsx');
//        $template = base_path('vendor/phpoffice/phpexcel/Examples/templates/26template.xlsx');

        echo date('H:i:s') , " Load Excel2007 template file" , EOL;
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($template);


// Export to Excel2007 (.xlsx)
        echo date('H:i:s') , " Write to Excel5 format" , EOL;
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('file-laporan/template.xlsx');
        //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        echo date('H:i:s') , " File written to ", EOL;

        echo date('H:i:s') , " Write to PDF format" , EOL;
        try {
            if (!PHPExcel_Settings::setPdfRenderer(
                $rendererName,
                $rendererLibraryPath
            )) {
                echo (
                    'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
                    EOL .
                    'at the top of this script as appropriate for your directory structure' .
                    EOL
                );
            } else {
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
                $objWriter->save('file-laporan/template.pdf');
                echo date('H:i:s') , " File written to " , EOL;
            }
        } catch (Exception $e) {
            echo date('H:i:s') , ' EXCEPTION: ', $e->getMessage() , EOL;
        }

    }
}
