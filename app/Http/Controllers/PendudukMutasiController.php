<?php

namespace App\Http\Controllers;

use App\Criteria\NotPendudukKeluarCriteria;
use App\Criteria\PendudukIndukCriteria;
use App\Criteria\PendudukMutasiCriteria;
use App\Entities\Penduduk;
use App\Entities\PendudukMutasi;
use App\Entities\ProfilDesa;
use App\Presenters\PendudukMutasiPresenter;
use App\Repositories\PendudukRepository;
use App\Validators\MutasiPindahMatiValidator;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use PHPExcel_IOFactory;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\PendudukMutasiRepository;
use App\Validators\PendudukMutasiValidator;


class PendudukMutasiController extends Controller
{

    /**
     * @var PendudukMutasiRepository
     */
    protected $repository;
    protected $repoPenduduk;

    /**
     * @var PendudukMutasiValidator
     */
    protected $validator;
    protected $validMutasi;

    public function __construct(PendudukMutasiRepository $repository, PendudukMutasiValidator $validator, PendudukRepository $repoPenduduk, MutasiPindahMatiValidator $validMutasi)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->repoPenduduk  = $repoPenduduk;
        $this->validMutasi  = $validMutasi;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $pendudukMutasis = $this->repoPenduduk
                ->popCriteria(NotPendudukKeluarCriteria::class)
                ->popCriteria(PendudukIndukCriteria::class)
                ->pushCriteria(PendudukMutasiCriteria::class)
                ->setPresenter(PendudukMutasiPresenter::class)
                ->all();

            return response()->json([
                'data' => $pendudukMutasis,
            ], 200);
        }

        return view('content.penduduk.mutasi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PendudukMutasiCreateRequest $request
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
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'kewarga_negaraan' => $request->kewarga_negaraan,
                ];
                $mutasi = [
                    'nik' => $request->nik,
                    'tanggal' => $request->tanggal_datang,
                    'jenis' => $request->jenis,
                    'daerah' => $request->datang_dari,
                    'keterangan' => $request->keterangan,
                ];

                DB::transaction(function() use($penduduk, $mutasi){
                    $p = Penduduk::create($penduduk);
                    $insert_mutasi = $mutasi;
                    $insert_mutasi['penduduk_id'] = $p->id;
                    PendudukMutasi::create($insert_mutasi);
                });


                $response = [
                    'message' => 'Penduduk Mutasi Berhasil Ditambahakan',
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

    public function pindah(Request $request, $id)
    {
        try{
            $this->validMutasi->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $mutasi = [
                'nik' => $request->nik,
                'tanggal' => $request->tanggal_pindah,
                'jenis' => $request->jenis,
                'daerah' => $request->pindah_ke,
                'keterangan' => $request->keterangan,
                'penduduk_id' => $id,
            ];

            PendudukMutasi::create($mutasi);

            $response = [
                'message' => 'Penduduk Berhasil diMutasi',
            ];
            return response()->json($response, 201);

        }catch (ValidatorException $e){
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ], 422);
            }

            return redirect()->back();
        }
    }

    public function mati(Request $request, $id)
    {
        try{
            $this->validMutasi->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $mutasi = [
                'nik' => $request->nik,
                'tanggal' => $request->tanggal_meninggal,
                'jenis' => $request->jenis,
                'daerah' => $request->meninggal_di,
                'keterangan' => $request->keterangan,
                'penduduk_id' => $id,
            ];
            PendudukMutasi::create($mutasi);

            $response = [
                'message' => 'Penduduk Berhasil diMutasi',
            ];

            return response()->json($response, 201);

        }catch (ValidatorException $e){
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
            $pendudukMutasis = $this->repoPenduduk
                ->popCriteria(NotPendudukKeluarCriteria::class)
                ->popCriteria(PendudukIndukCriteria::class)
                ->pushCriteria(PendudukMutasiCriteria::class)
                ->setPresenter(PendudukMutasiPresenter::class)
                ->find($id);
            return response()->json([
                'data' => $pendudukMutasis,
            ], 200);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PendudukMutasiUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            if ($request->wantsJson()) {
                $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

                $pendudukMutasi = $this->repository->update($request->all(), $id);

                $response = [
                    'message' => 'Penduduk Mutasi Berhasil Diubah',
                    'data'    => $pendudukMutasi->toArray(),
                ];
                return response()->json($response, 200);
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
                    'message' => 'Penduduk Mutasi Berhasil Dihapus',
                    'deleted' => $deleted,
                ]);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }

        return redirect()->back();
    }

    public function excel()
    {
        $filename = Carbon::now()->format('Y-m').'-penduduk-mutasi.xls';
        if(request()->wantsJson()) {
            $template = resource_path('assets/template-laporan/buku-penduduk-mutasi.xls');

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
            $mutasi = $this->repoPenduduk
                ->popCriteria(NotPendudukKeluarCriteria::class)
                ->popCriteria(PendudukIndukCriteria::class)
                ->pushCriteria(PendudukMutasiCriteria::class)
                ->setPresenter(PendudukMutasiPresenter::class)
                ->all()['data'];
            foreach ($mutasi as $dataRow) {
                $row = $baseRow + $i;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row, $i + 1)
                    ->setCellValue('B' . $row, $dataRow['nama'])
                    ->setCellValue('C' . $row, $dataRow['tempat_lahir'])
                    ->setCellValue('D' . $row, $dataRow['tanggal_lahir'])
                    ->setCellValue('E' . $row, $dataRow['jenis_kelamin'])
                    ->setCellValue('F' . $row, $dataRow['kewarga_negaraan'])
                    ->setCellValue('G' . $row, $dataRow['datang_dari'])
                    ->setCellValue('H' . $row, $dataRow['datang_tanggal'])
                    ->setCellValue('I' . $row, $dataRow['pindah_ke'])
                    ->setCellValue('J' . $row, $dataRow['pindah_tanggal'])
                    ->setCellValue('K' . $row, $dataRow['meninggal'])
                    ->setCellValue('L' . $row, $dataRow['meninggal_tanggal'])
                    ->setCellValue('M' . $row, $dataRow['keterangan']);
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
}
