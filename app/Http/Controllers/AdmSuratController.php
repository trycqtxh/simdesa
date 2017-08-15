<?php

namespace App\Http\Controllers;

use App\Entities\AdmSurat;
use App\Entities\ProfilDesa;
use App\Presenters\AgendaDesaPresenter;
use App\Presenters\EkspedisiDesaPresenter;
use App\Validators\AgendaKeluarDesaValidator;
use App\Validators\AgendaMasukDesaValidator;
use App\Validators\EkspedisiDesaValidator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PHPExcel_IOFactory;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AdmSuratCreateRequest;
use App\Http\Requests\AdmSuratUpdateRequest;
use App\Repositories\AdmSuratRepository;
use App\Validators\AdmSuratValidator;


class AdmSuratController extends Controller
{

    /**
     * @var AdmSuratRepository
     */
    protected $repository;

    /**
     * @var AdmSuratValidator
     */
    protected $validator;
    protected $validExpedisi;
    protected $validMasuk;
    protected $validKeluar;

    public function __construct(AdmSuratRepository $repository, AdmSuratValidator $validator, EkspedisiDesaValidator $validExpedisi,
                                AgendaMasukDesaValidator $validMasuk, AgendaKeluarDesaValidator $validKeluar)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->validExpedisi  = $validExpedisi;
        $this->validMasuk  = $validMasuk;
        $this->validKeluar  = $validKeluar;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_agenda()
    {
        if (request()->wantsJson()) {
            $admSurats = $this->repository
                ->setPresenter(AgendaDesaPresenter::class)
                ->findWhereIn('jenis', ['masuk', 'keluar']);

            return response()->json([
                'data' => $admSurats,
            ]);
        }

        return view('content.umum.agenda');
    }
    public function AgendaExcel()
    {
        $filename = 'agenda-surat.xls';
        if (request()->wantsJson()) {
            $admSurats = $this->repository
                ->setPresenter(AgendaDesaPresenter::class)
                ->findWhereIn('jenis', ['masuk', 'keluar'])['data'];

            $template = resource_path('assets/template-laporan/buku-agenda.xls');

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
            foreach ($admSurats as $dataRow) {
                $row = $baseRow + $i;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row, $i + 1)
                    ->setCellValue('B' . $row, $dataRow['tanggal_pengiriman'])
                    ->setCellValue('C' . $row, $dataRow['nomor_masuk'])
                    ->setCellValue('D' . $row, $dataRow['tanggal_masuk'])
                    ->setCellValue('E' . $row, $dataRow['nama_pengirim_masuk'])
                    ->setCellValue('F' . $row, $dataRow['isi_singkat_masuk'])
                    ->setCellValue('G' . $row, $dataRow['nomor_keluar'])
                    ->setCellValue('H' . $row, $dataRow['tanggal_keluar'])
                    ->setCellValue('I' . $row, $dataRow['ditujukan_kepada'])
                    ->setCellValue('J' . $row, $dataRow['isi_singkat_keluar'])
                    ->setCellValue('K' . $row, $dataRow['keterangan']);
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

    public function index_ekpedisi()
    {
        if (request()->wantsJson()) {
            $admSurats = $this->repository
                ->setPresenter(EkspedisiDesaPresenter::class)
                ->findWhere(['jenis'=>'ekspedisi']);

            return response()->json([
                'data' => $admSurats,
            ]);
        }

        return view('content.umum.ekspedisi');
    }
    public function ExpedisiExcel()
    {
        $filename = 'expedisi-surat.xls';
        if (request()->wantsJson()) {
            $admSurats = $this->repository
                ->setPresenter(EkspedisiDesaPresenter::class)
                ->findWhere(['jenis'=>'ekspedisi'])['data'];

            $template = resource_path('assets/template-laporan/buku-expedisi.xls');

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
            foreach ($admSurats as $dataRow) {
                $row = $baseRow + $i;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row, $i + 1)
                    ->setCellValue('B' . $row, $dataRow['tanggal_pengirim_penerima'])
                    ->setCellValue('C' . $row, $dataRow['tanggal_nomor_surat'])
                    ->setCellValue('D' . $row, $dataRow['pengirim_penerima'])
                    ->setCellValue('E' . $row, $dataRow['isi_surat'])
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
     * @param  AdmSuratCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $jenis)
    {
        try {
            if($jenis == 'masuk'){

                $this->validMasuk->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

                $agenda = [
                    'tanggal_pengirim_penerima' => $request->tanggal_penerimaan,
                    'nomor_surat'               => $request->nomor_surat,
                    'tanggal_surat'             => $request->tanggal_surat,
                    'pengirim_penerima'         => $request->pengirim,
                    'isi_surat'                 => $request->isi_surat,
                    'keterangan'                => $request->keterangan,
                    'penanggung_jawab_id'       => 1,
                    'jenis'                     => 'masuk',
                ];
                AdmSurat::firstOrCreate($agenda);

                $respons = ['message'=>'Surat Agenda Masuk Berhasil Ditambahkan'];

                return response()->json($respons, 201);

            }elseif($jenis == 'keluar'){

                $this->validKeluar->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

                $agenda = [
                    'tanggal_pengirim_penerima' => $request->tanggal_pengiriman,
                    'nomor_surat'               => $request->nomor_surat,
                    'tanggal_surat'             => $request->tanggal_surat,
                    'pengirim_penerima'         => $request->ditujukan_kepada,
                    'isi_surat'                 => $request->isi_surat,
                    'keterangan'                => $request->keterangan,
                    'penanggung_jawab_id'       => 1,
                    'jenis'                     => 'keluar',
                ];

                AdmSurat::firstOrCreate($agenda);

                $respons = ['message'=>'Surat Agenda Keluar Berhasil Ditambahkan'];

                return response()->json($respons, 201);

            }elseif($jenis == 'ekspedisi'){

                $this->validExpedisi->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

                $expedisi = [
                    'tanggal_pengirim_penerima' => $request->tanggal_pengiriman,
                    'nomor_surat'               => $request->nomor_surat,
                    'tanggal_surat'             => $request->tanggal_surat,
                    'pengirim_penerima'         => $request->ditujukan_kepada,
                    'isi_surat'                 => $request->isi_surat,
                    'keterangan'                => $request->keterangan,
                    'penanggung_jawab_id'       => 1,
                    'jenis'                     => 'ekspedisi',
                ];

                AdmSurat::firstOrCreate($expedisi);

                $respons = ['message'=>'Surat Expedisi Berhasil Ditambahkan'];

                return response()->json($respons, 201);

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
        $admSurat = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $admSurat,
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  AdmSuratUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $jenis, $id)
    {
        try {

            if($jenis == 'masuk'){

                $this->validMasuk->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

                $masuk = [
                    'tanggal_pengirim_penerima' => $request->tanggal_penerimaan,
                    'nomor_surat'               => $request->nomor_surat,
                    'tanggal_surat'             => $request->tanggal_surat,
                    'pengirim_penerima'         => $request->pengirim,
                    'isi_surat'                 => $request->isi_surat,
                    'keterangan'                => $request->keterangan,
                    'penanggung_jawab_id'       => 1,
                    'jenis'                     => 'masuk',
                ];

                AdmSurat::find($id)->update($masuk);

                $respons = ['message'=>'Surat Agenda Masuk Berhasil Diubah'];

                return response()->json($respons, 201);

            }elseif($jenis == 'keluar'){

                $this->validKeluar->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

                $keluar = [
                    'tanggal_pengirim_penerima' => $request->tanggal_pengiriman,
                    'nomor_surat'               => $request->nomor_surat,
                    'tanggal_surat'             => $request->tanggal_surat,
                    'pengirim_penerima'         => $request->ditujukan_kepada,
                    'isi_surat'                 => $request->isi_surat,
                    'keterangan'                => $request->keterangan,
                    'penanggung_jawab_id'       => 1,
                    'jenis'                     => 'keluar',
                ];

                AdmSurat::find($id)->update($keluar);

                $respons = ['message'=>'Surat Agenda Keluar Berhasil Diubah'];

                return response()->json($respons, 201);


            }elseif($jenis == 'ekspedisi'){

                $this->validExpedisi->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

                $expedisi = [
                    'tanggal_pengirim_penerima' => $request->tanggal_pengiriman,
                    'nomor_surat'               => $request->nomor_surat,
                    'tanggal_surat'             => $request->tanggal_surat,
                    'pengirim_penerima'         => $request->ditujukan_kepada,
                    'isi_surat'                 => $request->isi_surat,
                    'keterangan'                => $request->keterangan,
                    'penanggung_jawab_id'       => 1,
                    'jenis'                     => 'ekspedisi',
                ];
                AdmSurat::find($id)->update($expedisi);

                $respons = ['message'=>'Surat Expedisi Berhasil Diubah'];

                return response()->json($respons, 201);

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
            try{
                $deleted = $this->repository->delete($id);

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
    }
}
