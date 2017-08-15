<?php

namespace App\Http\Controllers;

use App\Entities\LembarBeritaDesa;
use App\Entities\ProfilDesa;
use App\Presenters\BeritaDesaPresenter;
use App\Presenters\LembarDesaPresenter;
use App\Repositories\PeraturanDesaRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use PHPExcel_IOFactory;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\LembarBeritaDesaRepository;
use App\Validators\LembarBeritaDesaValidator;


class LembarBeritaDesaController extends Controller
{

    /**
     * @var LembarBeritaDesaRepository
     */
    protected $repository;

    /**
     * @var LembarBeritaDesaValidator
     */
    protected $validator;

    public function __construct(LembarBeritaDesaRepository $repository, LembarBeritaDesaValidator $validator)
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
            $lembarBeritaDesas = $this->repository->has('peraturanDesaBerita')->setPresenter(BeritaDesaPresenter::class)->all();

            return response()->json([
                'data' => $lembarBeritaDesas,
            ]);
        }

         return view('content.umum.lembar_berita');

    }
    public function LembarExcel()
    {
        $filename = 'lembar-berita-desa.xls';
        if (request()->wantsJson()) {
            $lembarBeritaDesas = $this->repository->has('peraturanDesaBerita')->setPresenter(BeritaDesaPresenter::class)->all()['data'];

            $template = resource_path('assets/template-laporan/buku-lembar-berita-desa.xls');

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
            foreach ($lembarBeritaDesas as $dataRow) {
                $row = $baseRow + $i;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row, $i + 1)
                    ->setCellValue('B' . $row, $dataRow['jenis_peraturan'])
                    ->setCellValue('C' . $row, $dataRow['ditetapkan'])
                    ->setCellValue('D' . $row, $dataRow['tentang'])
                    ->setCellValue('E' . $row, $dataRow['tanggal_diundangkan'])
                    ->setCellValue('F' . $row, $dataRow['nomor_diundangkan'])
                    ->setCellValue('G' . $row, $dataRow['keterangan']);
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
     * @param  LembarBeritaDesaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            if ($request->wantsJson()) {


                $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

                $lembar_berita = [
                    'nomor_diundangkan' => $request->nomor_diundangkan,
                    'tanggal_diundangkan' => $request->tanggal_diundangkan,
                    'keterangan' => $request->keterangan,
                    'peraturan_id' => $request->peraturan,
                ];

                LembarBeritaDesa::firstOrCreate($lembar_berita);

                $response = [
                    'message' => 'Lembar Berita Desa Berhasil Ditambahkan.',
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
        $lembarBeritaDesa = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $lembarBeritaDesa,
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  LembarBeritaDesaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $lembar_berita = [
                'nomor_diundangkan' => $request->nomor_diundangkan,
                'tanggal_diundangkan' => $request->tanggal_diundangkan,
                'keterangan' => $request->keterangan,
            ];

            LembarBeritaDesa::find($id)->update($lembar_berita);

            $response = [
                'message' => 'Lembar Berita Desa Behasil Diubah.',
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

                KTP::find($id)->delete();

                return response()->json([
                    'message' => 'Lembaran Berita Desa Berhasil Dihapus',
                ]);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }

        return redirect()->back()->with('message', 'LembarBeritaDesa deleted.');
    }
}
