<?php

namespace App\Http\Controllers;

use App\Entities\Bidang;
use App\Entities\Pembiayaan;
use App\Validators\PembiayaanLevel1Validator;
use App\Validators\PembiayaanLevel2Validator;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\PembiayaanRepository;
use App\Validators\PembiayaanValidator;


class PerencanaanPembiayaanController extends Controller
{

    /**
     * @var PembiayaanRepository
     */
    protected $repository;

    /**
     * @var PembiayaanValidator
     */
    protected $validator;
    protected $validL1;
    protected $validL2;

    public function __construct(PembiayaanRepository $repository, PembiayaanValidator $validator, PembiayaanLevel1Validator $validL1, PembiayaanLevel2Validator $validL2)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->validL1  = $validL1;
        $this->validL2  = $validL2;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $current_year = Carbon::now()->year;
        $bidang = Bidang::where('jenis', 'pembiayaan')->get();

        if (request()->wantsJson()) {

            $table = [];
            $kode_pembiayaan = 3;
            $pem = [];
            $pem['act'] = '';
            $pem['kode_1'] = $kode_pembiayaan;
            $pem['kode_2'] = '';
            $pem['kode_3'] = '';
            $pem['kode_4'] = '';

            $pem['uraian'] = "<b>PEMBIAYAAN</b>";
            $pem['anggaran'] = '';
            $pem['keterangan'] = '';
            $table[] = $pem;

            $kode_1 = 1;
            foreach($bidang as $b){
                $row_bidang = [];
                $row_bidang['act'] = '
                '.( (Auth::user()->can('add-pembiayaan-perencanaan')) ? '<a class="btn btn-default btn-xs" onClick="return tambah(\''.$b->id.'\', \''.$b->nama.'\', \'sub-bidang\')"><i class="fa fa-plus"></i> </a>' : '' ).'
                ';
                $row_bidang['kode_1'] = $kode_pembiayaan;
                $row_bidang['kode_2'] = $kode_1;
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = $b->nama;
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;

                $pembiayaan_bidang[$kode_1] = 0;
                $kode_2 = 1;
                $pembiayaan = Pembiayaan::where('bidang_id', $b->id)->where('level', 'level_1')->where('tahun', $current_year)->get();
                foreach($pembiayaan As $p){
                    $row_pembiayaan['act'] = '
                    '.( (Auth::user()->can('edit-pembiayaan-perencanaan')) ? '<a class="btn btn-xs btn-default" onClick="return ubah(\''.$p->id.'\', \''.$p->uraian.'\', \'sub-bidang\')"><i class="fa fa-edit"></i> </a>' : '' ).'
                    '.( (Auth::user()->can('remove-pembiayaan-perencanaan')) ? '<a class="btn btn-xs btn-default" onClick="return hapus(\''.$p->id.'\', \''.$p->uraian.'\', \'sub-bidang\')"><i class="fa fa-trash"></i> </a>' : '' ).'
                    ';
                    $row_pembiayaan['kode_1'] = $kode_pembiayaan;
                    $row_pembiayaan['kode_2'] = $kode_1;
                    $row_pembiayaan['kode_3'] = $kode_2;
                    $row_pembiayaan['kode_4'] = '';

                    $row_pembiayaan['uraian'] = $p->uraian;
                    $row_pembiayaan['anggaran'] = number_format($p->jumlah_dana, 2, ',', '.');
                    $row_pembiayaan['keterangan'] = $p->keterangan;
                    $table[] = $row_pembiayaan;
                    $pembiayaan_bidang[$kode_1] +=  $p->jumlah_dana;

                    $kode_2++;
                }

                $row_bidang['act'] = '';
                $row_bidang['kode_1'] = '';
                $row_bidang['kode_2'] = '';
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = '';
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;
                $kode_1++;


            }
            $jumlah_pembiayaan = $pembiayaan_bidang[1] - $pembiayaan_bidang[2];

            $row_jlm_pembiayaan['act'] = '';
            $row_jlm_pembiayaan['kode_1'] = '';
            $row_jlm_pembiayaan['kode_2'] = '';
            $row_jlm_pembiayaan['kode_3'] = '';
            $row_jlm_pembiayaan['kode_4'] = '';

            $row_jlm_pembiayaan['uraian'] = '<b>JUMLAH PEMBIAYAAN</b>';
            $row_jlm_pembiayaan['anggaran'] = number_format($jumlah_pembiayaan, 2, ',', '.');
            $row_jlm_pembiayaan['keterangan'] = '';
            $table[] = $row_jlm_pembiayaan;

            return response()->json([
                'data' => $table,
            ]);
        }

        return view('content.perencanaan.pembiayaan', compact('current_year'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PembiayaanCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $jenis)
    {

        try {
            $tahun = (string) Carbon::now()->year;
            if($jenis == "sub-bidang"){
                $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

                $tambah = [
                    'uraian'      => $request->uraian,
                    'level'       => 'level_1',
                    'tahun'       => $tahun,
                    'jumlah_dana' => $request->anggaran,
                    'bidang_id'   => $request->bidang,
                    'keterangan'   => $request->keterangan,
                ];

                Pembiayaan::firstOrCreate($tambah);

            }elseif($jenis == "pembiayaan"){
                $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

                $tambah = [
                    'uraian' => $request->uraian,
                    'level'  => 'level_2',
                    'tahun'  => $tahun,
                    'jumlah_dana' => $request->anggaran,
                    'keterangan' => $request->keterangan
                ];

                Pembiayaan::firstOrCreate($tambah);

            }

            $response = [
                'message' => 'Pembiayaan Berhasil Ditambahkan',
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembiayaan = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pembiayaan,
            ]);
        }

        return view('pembiayaans.show', compact('pembiayaan'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PembiayaanUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $jenis, $id)
    {

        try {

            if($jenis == "sub-bidang"){
                $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

                $update = [
                    'uraian'      => $request->uraian,
                    'jumlah_dana' => $request->anggaran,
                    'keterangan' => $request->keterangan,
                ];

                Pembiayaan::find($id)->update($update);
            }

            $response = [
                'message' => 'Pembiayaan Berhasil Diubah',
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
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
                return response()->json([
                    'message' => 'Pembiayaan deleted.',
                    'deleted' => $deleted,
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
