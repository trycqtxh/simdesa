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
use App\Http\Requests\TanahKasDesaCreateRequest;
use App\Http\Requests\TanahKasDesaUpdateRequest;
use App\Repositories\TanahKasDesaRepository;
use App\Validators\TanahKasDesaValidator;


class TanahKasDesaController extends Controller
{

    /**
     * @var TanahKasDesaRepository
     */
    protected $repository;

    /**
     * @var TanahKasDesaValidator
     */
    protected $validator;

    public function __construct(TanahKasDesaRepository $repository, TanahKasDesaValidator $validator)
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
        $tanahKasDesas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tanahKasDesas,
            ]);
        }

         return view('content.umum.tanah_kas');
    }
    public function excel()
    {
        $filename = 'tanah-kas-desa.xls';
        if (request()->wantsJson()) {
            $tanahDesas = $this->repository->all()['data'];
            $template = resource_path('assets/template-laporan/buku-tanah-kas-desa.xls');

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
                    ->setCellValue('B' . $row, $dataRow['asal_tanah'])
                    ->setCellValue('C' . $row, $dataRow['no_sertifikat'])
                    ->setCellValue('D' . $row, $dataRow['luas_kas'])
                    ->setCellValue('E' . $row, $dataRow['kelas'])
                    ->setCellValue('F' . $row, $dataRow['milik_desa'])
                    ->setCellValue('G' . $row, $dataRow['pemerintah'])
                    ->setCellValue('H' . $row, $dataRow['provinsi'])
                    ->setCellValue('I' . $row, $dataRow['kabkota'])
                    ->setCellValue('J' . $row, $dataRow['lain_lain'])
                    ->setCellValue('K' . $row, $dataRow['tgl_perolehan'])
                    ->setCellValue('L' . $row, $dataRow['sawah'])
                    ->setCellValue('M' . $row, $dataRow['tegal'])
                    ->setCellValue('N' . $row, $dataRow['kebun'])
                    ->setCellValue('O' . $row, $dataRow['tambak'])
                    ->setCellValue('P' . $row, $dataRow['tanah_kering'])
                    ->setCellValue('Q' . $row, $dataRow['patok_ada'])
                    ->setCellValue('R' . $row, $dataRow['patok_tidak'])
                    ->setCellValue('S' . $row, $dataRow['papan_ada'])
                    ->setCellValue('T' . $row, $dataRow['papan_tidak'])
                    ->setCellValue('U' . $row, $dataRow['lokasi'])
                    ->setCellValue('V' . $row, $dataRow['peruntukan'])
                    ->setCellValue('W' . $row, $dataRow['mutasi'])
                    ->setCellValue('X' . $row, $dataRow['keterangan']);
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
     * @param  TanahKasDesaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tanah = [
                'nama' => 'Pemerintah Desa',
                'jumlah' => $request->luas,
                'status_tanah' => 'tn',
                'luas_status' => $request->luas,
                'penggunaan_tanah' => $request->jenis_tkd,
                'luas_penggunaan' => $request->luas_jenis_tkd,
                'keterangan' => $request->keterangan
            ];
            $tanah_kas = [
                'asal_tanah' => $request->asal_tanah,
                'nomor_sertifikat' => $request->nomor_sertifikat,
                'kelas' => $request->kelas,
                'luas' => $request->luas,
                'peroleh_tkd' => $request->perolehan_tkd,
                'luas_perolehan_tkd' => $request->luas_jenis_tkd,
                'tanggal_peroleh' => $request->tanggal_perolehan,
                'luas_ada_patok' => $request->luas_patok_ada,
                'luas_tidak_patok' => $request->luas_patok_tidak_ada,
                'luas_ada_papan_nama' => $request->luas_papan_nama_ada,
                'luas_tidak_papan_nama' => $request->luas_papan_nama_tidak_ada,
                'lokasi' => $request->lokasi,
                'manfaat' => $request->peruntukan,
                'mutasi' => $request->mutasi,
                'keterangan' => $request->keterangan,
            ];

            DB::transaction(function()use($tanah, $tanah_kas){
                $tanah['id_tanah_kas_desa'] = TanahKasDesa::firstOrCreate($tanah_kas)['id'];
                TanahDesa::firstOrcreate($tanah);
            });

            $response = [
                'message' => 'Tanah Kas Desa Berhasil Ditambahkan',
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
        $tanahKasDesa = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tanahKasDesa,
            ]);
        }

        return view('tanahKasDesas.show', compact('tanahKasDesa'));
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

        $tanahKasDesa = $this->repository->find($id);

        return view('tanahKasDesas.edit', compact('tanahKasDesa'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  TanahKasDesaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $tanah = [
                'nama' => 'Pemerintah Desa',
                'jumlah' => $request->luas,
                'status_tanah' => 'tn',
                'luas_status' => $request->luas,
                'penggunaan_tanah' => $request->jenis_tkd,
                'luas_penggunaan' => $request->luas_jenis_tkd,
                'keterangan' => $request->keterangan
            ];
            $tanah_kas = [
                'asal_tanah' => $request->asal_tanah,
                'nomor_sertifikat' => $request->nomor_sertifikat,
                'kelas' => $request->kelas,
                'luas' => $request->luas,
                'peroleh_tkd' => $request->perolehan_tkd,
                'luas_perolehan_tkd' => $request->luas_jenis_tkd,
                'tanggal_peroleh' => $request->tanggal_perolehan,
                'luas_ada_patok' => $request->luas_patok_ada,
                'luas_tidak_patok' => $request->luas_patok_tidak_ada,
                'luas_ada_papan_nama' => $request->luas_papan_nama_ada,
                'luas_tidak_papan_nama' => $request->luas_papan_nama_tidak_ada,
                'lokasi' => $request->lokasi,
                'manfaat' => $request->peruntukan,
                'mutasi' => $request->mutasi,
                'keterangan' => $request->keterangan,
            ];

            DB::transaction(function()use($tanah, $tanah_kas, $id){
                TanahKasDesa::find($id)->update($tanah_kas);
                TanahDesa::where('id_tanah_kas_desa', $id)->update($tanah);
            });

            $response = [
                'message' => 'Tanah Kas Desa Berhasil Diubah',
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
                DB::transaction(function () use ($id) {
                    TanahDesa::where('id_tanah_kas_desa', $id)->delete();
                    TanahKasDesa::find($id)->delete();
                });
                return response()->json([
                    'message' => 'TanahKasDesa deleted.',
                ]);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }
}
