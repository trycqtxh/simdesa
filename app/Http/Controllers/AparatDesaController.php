<?php

namespace App\Http\Controllers;

use App\Entities\AparatDesa;
use App\Entities\ProfilDesa;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use PHPExcel_IOFactory;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\AparatDesaRepository;
use App\Validators\AparatDesaValidator;


class AparatDesaController extends Controller
{

    /**
     * @var AparatDesaRepository
     */
    protected $repository;

    /**
     * @var AparatDesaValidator
     */
    protected $validator;

    public function __construct(AparatDesaRepository $repository, AparatDesaValidator $validator)
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
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $aparatDesas = $this->repository->findWhere(['admin'=>0]);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $aparatDesas,
            ]);
        }

         return view('content.umum.aparat_pemerintah');
    }
    public function excel()
    {
        $filename = 'aparat-desa.xls';
        if (request()->wantsJson()) {
//            $aparatDesas = $this->repository->all()['data'];
            $aparatDesas = $this->repository->findWhere(['admin'=>0])['data'];
            $template = resource_path('assets/template-laporan/buku-aparat-desa.xls');

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

            $baseRow = 12;
            $i = 0;
            foreach ($aparatDesas as $dataRow) {
                $row = $baseRow + $i;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row, $i + 1)
                    ->setCellValue('B' . $row, $dataRow['nama'])
                    ->setCellValue('C' . $row, $dataRow['niap'])
                    ->setCellValue('D' . $row, $dataRow['nip'])
                    ->setCellValue('E' . $row, $dataRow['jenis_kelamin'])
                    ->setCellValue('F' . $row, $dataRow['tempat_tanggal_lahir'])
                    ->setCellValue('G' . $row, $dataRow['agama'])
                    ->setCellValue('H' . $row, $dataRow['golongan'])
                    ->setCellValue('I' . $row, $dataRow['jabatan'])
                    ->setCellValue('J' . $row, $dataRow['pendidikan'])
                    ->setCellValue('K' . $row, $dataRow['nomor_tanggal_pengangkatan'])
                    ->setCellValue('L' . $row, $dataRow['nomor_tanggal_pemberhentian'])
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  AparatDesaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            if ($request->wantsJson()) {

                $aparatDesa = [
                    'niap' => $request->niap,
                    'nip' => $request->nip,
                    'golongan' => $request->golongan,
                    'no_pengangkatan' => $request->nomor_pengangkatan,
                    'tanggal_pengangkatan' => $request->tanggal_pengangkatan,
                    'keterangan' => $request->keterangan,
                    'jabatan_id' => $request->jabatan,
                    'nik_penduduk' => $request->nik,
                    'password' => $request->password,
                ];
                AparatDesa::firstOrCreate($aparatDesa);

                $response = [
                    'message' => 'Aparat Desa Berhasil Ditambahkan',
                ];

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
        $aparatDesa = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $aparatDesa,
            ]);
        }

        return view('aparatDesas.show', compact('aparatDesa'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  AparatDesaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $aparatDesa = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'AparatDesa updated.',
                'data'    => $aparatDesa->toArray(),
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
                ], 422);
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
                    'message' => 'Kartu Keluarga Berhasil Dihapus',
                ], 201);

            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }

        return redirect()->back()->with('message', 'AparatDesa deleted.');
    }
}
