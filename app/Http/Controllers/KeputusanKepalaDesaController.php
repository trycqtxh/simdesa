<?php

namespace App\Http\Controllers;

use App\Entities\PeraturanDesa;
use App\Entities\ProfilDesa;
use App\Presenters\KeputusanKepalaDesaPresenter;
use App\Repositories\PeraturanDesaRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use PHPExcel_IOFactory;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Validators\KeputusanKepalaDesaValidator;


class KeputusanKepalaDesaController extends Controller
{

    /**
     * @var KeputusanKepalaDesaRepository
     */
    protected $repository;

    /**
     * @var KeputusanKepalaDesaValidator
     */
    protected $validator;

    public function __construct(PeraturanDesaRepository $repository, KeputusanKepalaDesaValidator $validator)
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
            $keputusanKepalaDesas = $this->repository->setPresenter(KeputusanKepalaDesaPresenter::class)->findWhere(['jenis_peraturan'=>'Peraturan Kepala Desa']);

            return response()->json([
                'data' => $keputusanKepalaDesas,
            ]);
        }

         return view('content.umum.keputusan_kades');
    }
    public function KeputusanExcel()
    {
        $filename = 'keputusan-kepala-desa.xls';
        if (request()->wantsJson()) {
            $keputusanKepalaDesas = $this->repository->setPresenter(KeputusanKepalaDesaPresenter::class)->findWhere(['jenis_peraturan'=>'Peraturan Kepala Desa'])['data'];

            $template = resource_path('assets/template-laporan/buku-keputusan-kepala-desa.xls');

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
            foreach ($keputusanKepalaDesas as $dataRow) {
                $row = $baseRow + $i;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row, $i + 1)
                    ->setCellValue('B' . $row, $dataRow['keputusan'])
                    ->setCellValue('C' . $row, $dataRow['judul'])
                    ->setCellValue('D' . $row, $dataRow['uraian'])
                    ->setCellValue('E' . $row, $dataRow['dilaporkan'])
                    ->setCellValue('F' . $row, $dataRow['keterangan']);
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
     * @param  KeputusanKepalaDesaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $keputusan = [
                'jenis_peraturan' => 'Peraturan Kepala Desa',
                'nomor_ditetapkan' => $request->nomor_keputusan,
                'tanggal_ditetapkan' => $request->tanggal_keputusan,
                'tentang' => $request->tentang,
                'uraian' => $request->uraian_singkat,
                'nomor_laporan' => $request->nomor_dilaporkan,
                'tanggal_laporan' => $request->tanggal_dilaporkan,
                'keterangan' => $request->keterangan
            ];

            PeraturanDesa::firstOrCreate($keputusan);

            $response = [
                'message' => 'Keputusan Kepala Desa Berhasil Ditambahkan',
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (request()->wantsJson()) {
            $keputusanKepalaDesa = $this->repository->skipPresenter()->find($id);

            return response()->json([
                'data' => $keputusanKepalaDesa,
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  KeputusanKepalaDesaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $keputusan = [
                'nomor_ditetapkan' => $request->nomor_keputusan,
                'tanggal_ditetapkan' => $request->tanggal_keputusan,
                'tentang' => $request->tentang,
                'uraian' => $request->uraian_singkat,
                'nomor_laporan' => $request->nomor_dilaporkan,
                'tanggal_laporan' => $request->tanggal_dilaporkan,
                'keterangan' => $request->keterangan
            ];

            PeraturanDesa::find($id)->update($keputusan);

            $response = [
                'message' => 'Keputusan Kepala Desa Berhasil diubah',
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
                $this->repository->delete($id);

                return response()->json([
                    'message' => 'Keputusan Kepala Desa Berhasil Dihapus',
                ]);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }
}
