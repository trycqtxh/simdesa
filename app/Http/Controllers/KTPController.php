<?php

namespace App\Http\Controllers;

use App\Entities\KTP;
use App\Entities\PendudukInduk;
use App\Entities\ProfilDesa;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use PHPExcel_IOFactory;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\KTPCreateRequest;
use App\Http\Requests\KTPUpdateRequest;
use App\Repositories\KTPRepository;
use App\Validators\KTPValidator;


class KTPController extends Controller
{

    /**
     * @var KTPRepository
     */
    protected $repository;

    /**
     * @var KTPValidator
     */
    protected $validator;

    public function __construct(KTPRepository $repository, KTPValidator $validator)
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
            $ktp = $this->repository->all();

            return response()->json([
                'data' => $ktp,
            ]);
        }

        return view('content.penduduk.ktp');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  KTPCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $ktp = [
                'tanggal_mulai_di_desa' => $request->tanggal_mulai_didesa,
                'tanggal_dikeluarkan' => $request->tanggal_dikeluarkan,
                'tempat_dikeluarkan' => $request->tempat_dikeluarkan,
                'keterangan' => $request->keterangan,
                'nik' => $request->nik,
            ];
            KTP::create($ktp);

            $response = [
                'message' => 'KTP Berhasil Ditambahkan',
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
        $kTP = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $kTP,
            ]);
        }

        return view('kTPs.show', compact('kTP'));
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

        $kTP = $this->repository->find($id);

        return view('kTPs.edit', compact('kTP'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  KTPUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $ktp = [
                'tanggal_mulai_di_desa' => $request->tanggal_mulai_didesa,
                'tanggal_dikeluarkan' => $request->tanggal_dikeluarkan,
                'tempat_dikeluarkan' => $request->tempat_dikeluarkan,
                'keterangan' => $request->keterangan,
                'nik' => $request->nik,
            ];

            KTP::find($id)->update($ktp);

            $response = [
                'message' => 'KTP Berhasil Diubah',
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

                KTP::find($id)->delete();

                return response()->json([
                    'message' => 'KTP Berhasil Dihapus',
                ]);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }

    public function SelectKtp()
    {
        $penduduk = PendudukInduk::has('ktp', '=', 0)->get();
        $data = [];
        foreach($penduduk as $p){
            $row['nik'] = $p->nik;
            $row['nama'] = $p->penduduk->nama;
            $row['jenis_kelamin'] = $p->penduduk->jenis_kelamin;
            $row['act'] = '<button class="btn btn-flat btn-sm btn-default" onclick="pilih('.$p->nik.')" data-dismiss="modal"><i class="fa fa-download"></i></button>';
            $data[] = $row;
        }
        return response()->json(['data'=>$data]);
    }

    public function excel()
    {
        $filename = Carbon::now()->format('Y-m').'-buku-ktp.xls';
        if(request()->wantsJson()) {
            $template = resource_path('assets/template-laporan/buku-kartu-tanda-penduduk.xls');

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
            $ktp = $this->repository->all()['data'];
            foreach ($ktp as $dataRow) {
                $row = $baseRow + $i;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row, $i + 1)
                    ->setCellValue('B' . $row, $dataRow['nomor_kk'])
                    ->setCellValue('C' . $row, $dataRow['nama'])
                    ->setCellValue('D' . $row, $dataRow['nik'])
                    ->setCellValue('E' . $row, $dataRow['jenis_kelamin'])
                    ->setCellValue('F' . $row, $dataRow['tempat_tanggal_lahir'])
                    ->setCellValue('G' . $row, $dataRow['golongan_darah'])
                    ->setCellValue('H' . $row, $dataRow['agama'])
                    ->setCellValue('I' . $row, $dataRow['pendidikan'])
                    ->setCellValue('J' . $row, $dataRow['pekerjaan'])
                    ->setCellValue('K' . $row, $dataRow['alamat'])
                    ->setCellValue('L' . $row, $dataRow['status_perkawinan'])
                    ->setCellValue('M' . $row, $dataRow['tempat_tanggal_dikeluarkan'])
                    ->setCellValue('N' . $row, $dataRow['status_keluarga'])
                    ->setCellValue('O' . $row, $dataRow['kewarga_negaraan'])
                    ->setCellValue('P' . $row, $dataRow['ayah'])
                    ->setCellValue('Q' . $row, $dataRow['ibu'])
                    ->setCellValue('R' . $row, $dataRow['tanggal_mulai_di_desa'])
                    ->setCellValue('S' . $row, $dataRow['keterangan']);
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
