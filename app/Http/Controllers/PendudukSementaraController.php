<?php

namespace App\Http\Controllers;

use App\Criteria\NotPendudukSementaraCriteria;
use App\Criteria\PendudukIndukCriteria;
use App\Criteria\PendudukSementaraCriteria;
use App\Entities\Penduduk;
use App\Entities\PendudukSementara;
use App\Entities\ProfilDesa;
use App\Presenters\PendudukSementaraPresenter;
use App\Repositories\PendudukRepository;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use PHPExcel_IOFactory;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PendudukSementaraCreateRequest;
use App\Http\Requests\PendudukSementaraUpdateRequest;
use App\Repositories\PendudukSementaraRepository;
use App\Validators\PendudukSementaraValidator;


class PendudukSementaraController extends Controller
{

    /**
     * @var PendudukSementaraRepository
     */
    protected $repository;
    protected $repoPenduduk;

    /**
     * @var PendudukSementaraValidator
     */
    protected $validator;

    public function __construct(PendudukSementaraRepository $repository, PendudukSementaraValidator $validator, PendudukRepository $repoPenduduk)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->repoPenduduk = $repoPenduduk;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->wantsJson()) {
            $pendudukSementaras = $this->repoPenduduk
                ->popCriteria(PendudukIndukCriteria::class)
                ->popCriteria(NotPendudukSementaraCriteria::class)
                ->pushCriteria(PendudukSementaraCriteria::class)
                ->setPresenter(PendudukSementaraPresenter::class)
                ->all();
            return response()->json([
                'data' => $pendudukSementaras,
            ], 200);
        }

        return view('content.penduduk.sementara');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PendudukSementaraCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            if ($request->wantsJson()) {
                $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

                DB::transaction(function() use($request){
                    $penduduk = [
                        'nama' => $request->nama,
                        'tempat_lahir' => $request->tempat_lahir,
                        'tanggal_lahir' => $request->tanggal_lahir,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'kewarga_negaraan' => $request->kewarga_negaraan,
                    ];
                    $id = Penduduk::create($penduduk);
                    $sementara = [
                        'tipe_identitas' => $request->jenis_identitas,
                        'no_identitas' => $request->no_identitas,
                        'pekerjaan_id' => $request->pekerjaan,
                        'turunan' => $request->keturunan,
                        'daerah_asal' => $request->datang_dari,
                        'tujuan' => $request->maksud_tujuan,
                        'alamat_tujuan' => $request->alamat_tujuan,
                        'tanggal_datang' => $request->tanggal_datang,
                        'tanggal_pergi' => $request->tanggal_pergi,
                        'keterangan' => $request->keterangan,
                        'penduduk_id' => $id->id
                    ];
                    PendudukSementara::create($sementara);
                });

                $response = [
                    'message' => 'Data Penduduk Sementara Berhasil Ditambahkan',
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
            $pendudukSementaras = $this->repoPenduduk
                ->popCriteria(PendudukIndukCriteria::class)
                ->popCriteria(NotPendudukSementaraCriteria::class)
                ->pushCriteria(PendudukSementaraCriteria::class)
                ->setPresenter(PendudukSementaraPresenter::class)
                ->find($id);

            return response()->json([
                'data' => $pendudukSementaras,
            ], 200);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PendudukSementaraUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            if ($request->wantsJson()) {

                $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

                $pendudukSementara = $this->repository->update($request->all(), $id);

                $response = [
                    'message' => 'PendudukSementara updated.',
                    'data'    => $pendudukSementara->toArray(),
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
                    'message' => 'Penduduk Sementara Berhasil Dihapus',
                ], 201);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }

    public function excel()
    {
        $filename = Carbon::now()->format('Y-m').'-penduduk-sementara.xls';
        if(request()->wantsJson()) {
            $template = resource_path('assets/template-laporan/buku-penduduk-sementara.xls');

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
            $semntara = $this->repoPenduduk
                ->popCriteria(PendudukIndukCriteria::class)
                ->popCriteria(NotPendudukSementaraCriteria::class)
                ->pushCriteria(PendudukSementaraCriteria::class)
                ->setPresenter(PendudukSementaraPresenter::class)
                ->all()['data'];
            foreach ($semntara as $dataRow) {
                $row = $baseRow + $i;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row, $i + 1)
                    ->setCellValue('B' . $row, $dataRow['nama'])
                    ->setCellValue('C' . $row, $dataRow['laki'])
                    ->setCellValue('D' . $row, $dataRow['perempuan'])
                    ->setCellValue('E' . $row, $dataRow['no_identitas'])
                    ->setCellValue('F' . $row, $dataRow['tempat_tanggal_lahir'])
                    ->setCellValue('G' . $row, $dataRow['pekerjaan'])
                    ->setCellValue('H' . $row, $dataRow['kewarga_negaraan'])
                    ->setCellValue('I' . $row, $dataRow['keturunan'])
                    ->setCellValue('J' . $row, $dataRow['datang_dari'])
                    ->setCellValue('K' . $row, $dataRow['maksud_tujuan'])
                    ->setCellValue('L' . $row, $dataRow['alamat_tujuan'])
                    ->setCellValue('M' . $row, $dataRow['datang_tanggal'])
                    ->setCellValue('N' . $row, $dataRow['pergi_tanggal'])
                    ->setCellValue('O' . $row, $dataRow['keterangan']);
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
