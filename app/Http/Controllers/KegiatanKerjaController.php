<?php

namespace App\Http\Controllers;

use App\Entities\DetailKegiatanKerja;
use App\Entities\KegiatanKerja;
use App\Entities\RPJM;
use App\Validators\BidangValidator;
use App\Validators\KegiatanValidator;
use App\Validators\SubBidangValidator;
use App\Validators\SubKegiatanValidator;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\KegiatanKerjaRepository;
use App\Validators\KegiatanKerjaValidator;


class KegiatanKerjaController extends Controller
{

    /**
     * @var KegiatanKerjaRepository
     */
    protected $repository;

    /**
     * @var KegiatanKerjaValidator
     */
    protected $validSubBidang;
    protected $validKegiatan;
    protected $validSubKegiatan;

    public function __construct(KegiatanKerjaRepository $repository, SubBidangValidator $validSubBidang, KegiatanValidator $validKegiatan, SubKegiatanValidator $validSubKegiatan)
    {
        $this->repository = $repository;
        $this->validSubBidang = $validSubBidang;
        $this->validKegiatan = $validKegiatan;
        $this->validSubKegiatan = $validSubKegiatan;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $kegiatanKerjas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $kegiatanKerjas,
            ]);
        }

        return view('kegiatanKerjas.index', compact('kegiatanKerjas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  KegiatanKerjaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $jenis)
    {
        $rpjm = RPJM::all()->last();
        if($jenis == "sub-bidang"){
            try{
                $this->validSubBidang->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

                $sub_bidang = [
                    'bidang_id' => $request->bidang,
                    'uraian' => $request->sub_bidang,
                    'jenis' => 'level_1',
                    'rpjm_id' => $rpjm['id'],
                ];
                KegiatanKerja::firstOrCreate($sub_bidang);

                $response = [
                    'message' => 'Sub Bidang Berhasil Di Simpan',
                ];

                return response()->json($response, 201);


            }catch (ValidatorException $e){
                if ($request->wantsJson()) {
                    return response()->json([
                        'error'   => true,
                        'message' => $e->getMessageBag()
                    ], 422);
                }
            }
        }

        if($jenis == "kegiatan"){
            try{
                $this->validKegiatan->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

                $kegiatan = [
                    'kegiatan_kerja_id' => $request->sub_kegiatan,
                    'uraian' => $request->jenis_kegiatan,
                    'jenis' => 'level_2',
                    'rpjm_id' => $rpjm['id'],
                ];
                KegiatanKerja::firstOrCreate($kegiatan);

                $response = [
                    'message' => 'Kegiatan Berhasil Di Simpan',
                ];

                return response()->json($response, 201);

            }catch (ValidatorException $e){
                if ($request->wantsJson()) {
                    return response()->json([
                        'error'   => true,
                        'message' => $e->getMessageBag()
                    ], 422);
                }
            }
        }

        if($jenis == "sub-kegiatan"){
            try{
                $this->validSubKegiatan->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

                $subkegiatan = [
                    'kegiatan_kerja_id' => $request->sub_kegiatan,
                    'uraian' => $request->kegiatan,
                    'jenis' => 'level_3',
                    'rpjm_id' => $rpjm['id'],
                ];
                $detailSubKegiatan = [
                    'lokasi' => $request->lokasi,
                    'volume' => $request->volume,
                    'manfaat' => $request->manfaat,
                    'jumlah_dana' => $request->jumlah,
                    'sumber_dana_id' => $request->sumber_dana,
                    'pola_pelaksanaan' => $request->pola_pelaksanaan,
                ];
                DB::transaction(function() use ($subkegiatan, $detailSubKegiatan){
                    $id = KegiatanKerja::firstOrCreate($subkegiatan);
                    $detail = $detailSubKegiatan;
                    $detail['kegiatan_kerja_id'] = $id->id;

                    DetailKegiatanKerja::firstOrCreate($detail);
                });

                $response = [
                    'message' => 'Sub Kegiatan Berhasil Di Simpan',
                ];

                return response()->json($response, 201);

            }catch (ValidatorException $e){
                if ($request->wantsJson()) {
                    return response()->json([
                        'error'   => true,
                        'message' => $e->getMessageBag()
                    ], 422);
                }
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
    public function show($jenis, $id)
    {
        if($jenis == "sub-bidang"){
            $level = "level_1";
        }elseif($jenis == "kegiatan"){
            $level = "level_2";
        }elseif($jenis == "sub-kegiatan"){
           $level = 'level_3';
        }

        if (request()->wantsJson()) {

            $kegiatanKerja = $this->repository->findWhere(['jenis'=>$level, 'id'=>$id]);
//            $kegiatanKerja = KegiatanKerja::where('jenis', $level)->where('id', $id)->get();

            return response()->json([
                $kegiatanKerja,
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  KegiatanKerjaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $jenis, $id)
    {

        if($jenis == "sub-bidang"){
            try{
                $this->validSubBidang->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

                $sub_bidang = [
                    'bidang_id' => $request->bidang,
                    'uraian' => $request->sub_bidang,
                ];
                KegiatanKerja::find($id)->update($sub_bidang);

                $response = [
                    'message' => 'Sub Bidang Berhasil Di Ubah',
                ];

                return response()->json($response, 201);


            }catch (ValidatorException $e){
                if ($request->wantsJson()) {
                    return response()->json([
                        'error'   => true,
                        'message' => $e->getMessageBag()
                    ], 422);
                }
            }
        }

        if($jenis == "kegiatan"){
            try{
                $this->validKegiatan->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

                $kegiatan = [
                    'kegiatan_kerja_id' => $request->sub_kegiatan,
                    'uraian' => $request->jenis_kegiatan,
                ];
                KegiatanKerja::find($id)->update($kegiatan);

                $response = [
                    'message' => 'Kegiatan Berhasil Di Ubah',
                ];

                return response()->json($response, 201);

            }catch (ValidatorException $e){
                if ($request->wantsJson()) {
                    return response()->json([
                        'error'   => true,
                        'message' => $e->getMessageBag()
                    ], 422);
                }
            }
        }

        if($jenis == "sub-kegiatan"){
            try{
                $this->validSubKegiatan->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
                $subkegiatan = [
                    'uraian' => $request->kegiatan,
                ];

                $detail_kegiatan = [
                    'lokasi' => $request->lokasi,
                    'volume' => $request->volume,
                    'manfaat' => $request->manfaat,
                    'jumlah_dana' => $request->jumlah,
                    'sumber_dana_id' => $request->sumber_dana,
                    'pola_pelaksanaan' => $request->pola_pelaksanaan,
                ];
                DB::transaction(function() use($subkegiatan, $detail_kegiatan, $id) {
                    KegiatanKerja::find($id)->update($subkegiatan);
                    DetailKegiatanKerja::where('kegiatan_kerja_id', $id)->update($detail_kegiatan);
                });

                $response = [
                    'message' => 'Sub Kegiatan Berhasil Di Ubah',
                ];

                return response()->json($response, 201);

            }catch (ValidatorException $e){
                if ($request->wantsJson()) {
                    return response()->json([
                        'error'   => true,
                        'message' => $e->getMessageBag()
                    ], 422);
                }
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
                    DetailKegiatanKerja::where('kegiatan_kerja_id', $id)->delete();
                    KegiatanKerja::find($id)->delete();
                });

                return response()->json([
                    'message' => 'Kegiatan Kerja Berhasil Dihapus',
                ], 201);
            }catch (QueryException $e){
                return response()->json([
                    'error'   => true,
//                    'title' => 'Data Tidak Bisa Dihapus',
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }
}
