<?php

namespace App\Http\Controllers;

use App\Entities\PeraturanDesa;
use App\Entities\ProfilDesa;
use App\Presenters\PeraturanDesaPresenter;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use PHPExcel_IOFactory;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PeraturanDesaCreateRequest;
use App\Http\Requests\PeraturanDesaUpdateRequest;
use App\Repositories\PeraturanDesaRepository;
use App\Validators\PeraturanDesaValidator;


class PeraturanDesaController extends Controller
{

    /**
     * @var PeraturanDesaRepository
     */
    protected $repository;

    /**
     * @var PeraturanDesaValidator
     */
    protected $validator;

    public function __construct(PeraturanDesaRepository $repository, PeraturanDesaValidator $validator)
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
        if (request()->wantsJson()) {
            $peraturanDesas = $this->repository->all();

            return response()->json([
                'data' => $peraturanDesas,
            ]);
        }

         return view('content.umum.peraturan_desa');
    }
    public function PeraturanExcel()
    {
        $filename = 'peraturan-desa.xls';
        if (request()->wantsJson()) {
            $peraturanDesas = $this->repository->all()['data'];

            $template = resource_path('assets/template-laporan/buku-peraturan-desa.xls');

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
            foreach ($peraturanDesas as $dataRow) {
                $row = $baseRow + $i;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row, $i + 1)
                    ->setCellValue('B' . $row, $dataRow['jenis_peraturan'])
                    ->setCellValue('C' . $row, $dataRow['ditetapkan'])
                    ->setCellValue('D' . $row, $dataRow['tentang'])
                    ->setCellValue('E' . $row, $dataRow['uraian'])
                    ->setCellValue('F' . $row, $dataRow['kesepakatan'])
                    ->setCellValue('G' . $row, $dataRow['dilaporan'])
                    ->setCellValue('H' . $row, $dataRow['diundangkan_lembaran'])
                    ->setCellValue('I' . $row, $dataRow['diundangkan_berita']);
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
     * @param  PeraturanDesaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $peraturan = [
                'jenis_peraturan' => 'Peraturan Desa',
                'nomor_ditetapkan' => $request->nomor_ditetapkan,
                'tanggal_ditetapkan' => $request->tanggal_ditetapkan,
                'tentang' => $request->tentang,
                'uraian' => $request->uraian_singkat,
                'nomor_kesepakatan' => $request->no_kesepakatan,
                'tanggal_kesepakatan' => $request->tanggal_peraturan,
                'nomor_laporan' => $request->nomor_dilaporkan,
                'tanggal_laporan' => $request->tanggal_dilaporkan,
                'keterangan' => $request->keterangan
            ];

            PeraturanDesa::firstOrCreate($peraturan);

            if ($request->wantsJson()) {

                return response()->json([
                    'message' => 'PeraturanDesa created.',
                ], 201);
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
        if (request()->wantsJson()) {

            $peraturanDesa = $this->repository->skipPresenter()->find($id);

            return response()->json([
                'data' => $peraturanDesa,
            ]);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  PeraturanDesaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $peraturan = [
                'nomor_ditetapkan' => $request->nomor_ditetapkan,
                'tanggal_ditetapkan' => $request->tanggal_ditetapkan,
                'tentang' => $request->tentang,
                'uraian' => $request->uraian_singkat,
                'nomor_kesepakatan' => $request->no_kesepakatan,
                'tanggal_kesepakatan' => $request->tanggal_peraturan,
                'nomor_laporan' => $request->nomor_dilaporkan,
                'tanggal_laporan' => $request->tanggal_dilaporkan,
                'keterangan' => $request->keterangan
            ];

            PeraturanDesa::find($id)->update($peraturan);

            $response = [
                'message' => 'Peraturan Desa Berhasil Diubah',
            ];

            if ($request->wantsJson()) {

                return response()->json($response, 201);
            }

            return redirect()->back()->with('message', $response['message']);
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
                    'message' => 'Peraturan Desa Berhasil Dihapus',
                ], 201);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }
}
