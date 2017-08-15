<?php

namespace App\Http\Controllers;

use App\Entities\ProfilDesa;
use App\Entities\TanahDesa;
use App\Entities\TanahKasDesa;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use PHPExcel_IOFactory;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TanahDesaCreateRequest;
use App\Http\Requests\TanahDesaUpdateRequest;
use App\Repositories\TanahDesaRepository;
use App\Validators\TanahDesaValidator;


class TanahDesaController extends Controller
{

    /**
     * @var TanahDesaRepository
     */
    protected $repository;

    /**
     * @var TanahDesaValidator
     */
    protected $validator;

    public function __construct(TanahDesaRepository $repository, TanahDesaValidator $validator)
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
        $tanahDesas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tanahDesas,
            ]);
        }

         return view('content.umum.tanah_desa');
    }
    public function excel()
    {
        $filename = 'tanah-desa.xls';
        if (request()->wantsJson()) {
            $tanahDesas = $this->repository->all()['data'];
            $template = resource_path('assets/template-laporan/buku-tanah-desa.xls');

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

            $baseRow = 14;
            $i = 0;
            foreach ($tanahDesas as $dataRow) {
                $row = $baseRow + $i;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row, $i + 1)
                    ->setCellValue('B' . $row, $dataRow['nama'])
                    ->setCellValue('C' . $row, $dataRow['jumlah'])
                    ->setCellValue('D' . $row, $dataRow['hm'])
                    ->setCellValue('E' . $row, $dataRow['hgb'])
                    ->setCellValue('F' . $row, $dataRow['hp'])
                    ->setCellValue('G' . $row, $dataRow['hgu'])
                    ->setCellValue('H' . $row, $dataRow['hpl'])
                    ->setCellValue('I' . $row, $dataRow['ma'])
                    ->setCellValue('J' . $row, $dataRow['vi'])
                    ->setCellValue('K' . $row, $dataRow['tn'])
                    ->setCellValue('L' . $row, $dataRow['non_perumahan'])
                    ->setCellValue('M' . $row, $dataRow['non_perdagangan'])
                    ->setCellValue('N' . $row, $dataRow['non_perkantoran'])
                    ->setCellValue('O' . $row, $dataRow['non_industri'])
                    ->setCellValue('P' . $row, $dataRow['non_fasilitas'])
                    ->setCellValue('Q' . $row, $dataRow['sawah'])
                    ->setCellValue('R' . $row, $dataRow['tegalan'])
                    ->setCellValue('S' . $row, $dataRow['perkebunan'])
                    ->setCellValue('T' . $row, $dataRow['peternakan_perikanan'])
                    ->setCellValue('U' . $row, $dataRow['hutan_belukar'])
                    ->setCellValue('V' . $row, $dataRow['hutan_lebat'])
                    ->setCellValue('W' . $row, $dataRow['mutasi'])
                    ->setCellValue('X' . $row, $dataRow['tanah_kosong'])
                    ->setCellValue('Y' . $row, $dataRow['lain_lain']);
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
     * @param  TanahDesaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tanah = [
                'nama' => $request->nama,
                'jumlah' => $request->jumlah,
                'status_tanah' => $request->status_tanah,
                'luas_status' => $request->luas_status_tanah,
                'penggunaan_tanah' => $request->penggunaan_tanah,
                'luas_penggunaan' => $request->luas_penggunaan_tanah,
                'keterangan' => $request->keterangan
            ];

            TanahDesa::create($tanah);

            $response = [
                'message' => 'Tanah Desa Berhasil Ditambahkan.',
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
        $tanahDesa = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tanahDesa,
            ]);
        }

        return view('tanahDesas.show', compact('tanahDesa'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  TanahDesaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tanah = [
                'nama' => $request->nama,
                'jumlah' => $request->jumlah,
                'status_tanah' => $request->status_tanah,
                'luas_status' => $request->luas_status_tanah,
                'penggunaan_tanah' => $request->penggunaan_tanah,
                'luas_penggunaan' => $request->luas_penggunaan_tanah,
                'keterangan' => $request->keterangan
            ];

            TanahDesa::find($id)->update($tanah);

            $response = [
                'message' => 'Tanah Desa Berhasil Diubah.',
            ];

            if ($request->wantsJson()) {

                return response()->json($response, 201);
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
                DB::transaction(function () use ($id) {
                    $tanah = TanahDesa::findOrFail($id)->get();
                    TanahDesa::findOrFail($id)->delete();
                    TanahKasDesa::findOrFail($tanah[0]['id_tanah_kas_desa'])->delete();
                });
                return response()->json([
                    'message' => 'Tanah Desa Berhasil Dihapus',
                ]);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }
}
