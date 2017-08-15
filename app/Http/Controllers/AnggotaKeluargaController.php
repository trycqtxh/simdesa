<?php

namespace App\Http\Controllers;

use App\Criteria\IndukKepalaKeluargaCriteria;
use App\Criteria\PendudukIndukCriteria;
use App\Entities\AnggotaKeluarga;
use App\Entities\Penduduk;
use App\Entities\PendudukInduk;
use App\Entities\ProfilDesa;
use App\Presenters\AnggotaKeluargaPresenter;
use App\Repositories\PendudukIndukRepository;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use PHPExcel_IOFactory;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\AnggotaKeluargaRepository;
use App\Validators\AnggotaKeluargaValidator;


class AnggotaKeluargaController extends Controller
{

    /**
     * @var AnggotaKeluargaRepository
     */
    protected $repository;

    /**
     * @var AnggotaKeluargaValidator
     */
    protected $validator;

    public function __construct(PendudukIndukRepository $repository, AnggotaKeluargaValidator $validator)
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
        $anggotaKeluargas = $this->repository
            ->pushCriteria(IndukKepalaKeluargaCriteria::class)
            ->setPresenter(AnggotaKeluargaPresenter::class)
            ->all();

        if (request()->wantsJson()) {
            $kartu_keluarga = [];
            $kartu = AnggotaKeluarga::all();
            $induk = new PendudukInduk();
            foreach($kartu as $k){
//                $kk = $k->whereHas('induks', function($q){
//                    $q->where('status_keluarga_id', 1);
//                })->get();
                $kk = $induk->whereHas('statusKeluarga', function($q){
                    $q->where('kode', 'KK');
                })->where('nomor_kk', $k->nomor_kk)->first()['penduduk_id'];
                $row['nomor_kk'] = $k->nomor_kk;
                $row['kepala_keluarga'] = Penduduk::find($kk)['nama'];
                $row['tanggal_dikeluarkan'] = $k->tanggal_dikeluarkan;
                $row['tempat_dikeluarkan'] = $k->tempat_dikeluarkan;
                $row['tanggal_mulai_di_desa'] = $k->tanggal_mulai_di_desa;
                $row['keterangan'] = $k->keterangan;
                $kartu_keluarga[] = $row;
            }

            return response()->json([
                'data' => $anggotaKeluargas, 'kartu_keluarga'=>$kartu_keluarga,
            ]);
        }

        return view('content.penduduk.anggota-keluarga');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AnggotaKeluargaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tambah = [
                'nomor_kk' => $request->nomor_kk,
                'tanggal_dikeluarkan' => $request->tanggal_dikeluarkan,
                'tempat_dikeluarkan' => $request->tempat_dikeluarkan,
                'tanggal_mulai_di_desa' => $request->tanggal_mulai_didesa,
                'keterangan' => $request->keterangan,
            ];
            AnggotaKeluarga::create($tambah);

            $response = [
                'message' => 'Kartu Keluarga Berhasil Ditambahkan',
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
        $anggotaKeluarga = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $anggotaKeluarga,
            ]);
        }

        return view('anggotaKeluargas.show', compact('anggotaKeluarga'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  AnggotaKeluargaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tambah = [
                'nomor_kk' => $request->nomor_kk,
                'tanggal_dikeluarkan' => $request->tanggal_dikeluarkan,
                'tempat_dikeluarkan' => $request->tempat_dikeluarkan,
                'tanggal_mulai_di_desa' => $request->tanggal_mulai_didesa,
                'keterangan' => $request->keterangan,
            ];
            AnggotaKeluarga::find($id)->update($tambah);

            if ($request->wantsJson()) {

                return response()->json(['message'=>'Kartu Keluarga Berhasil Diubah'], 201);
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

                AnggotaKeluarga::find($id)->delete();

                return response()->json([
                    'message' => 'Kartu Keluarga Berhasil Dihapus',
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
        $filename = Carbon::now()->format('Y-m').'-kartu-keluarga.xls';
        if(request()->wantsJson()) {
            $template = resource_path('assets/template-laporan/buku-kartu-keluarga.xls');

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
            $kartu = AnggotaKeluarga::all();
            $induk = new PendudukInduk();
            foreach ($kartu as $dataRow) {
                $kk = $induk->whereHas('statusKeluarga', function($q){
                    $q->where('kode', 'KK');
                })->where('nomor_kk', $dataRow->nomor_kk)->first()['penduduk_id'];

                $row = $baseRow + $i;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row, $i + 1)
                    ->setCellValue('B' . $row, $dataRow['nomor_kk'])
                    ->setCellValue('C' . $row, Penduduk::find($kk)['nama'])
                    ->setCellValue('D' . $row, $dataRow['tanggal_dikeluarkan'])
                    ->setCellValue('E' . $row, $dataRow['tempat_dikeluarkan'])
                    ->setCellValue('F' . $row, $dataRow['tanggal_mulai_di_desa'])
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
}
