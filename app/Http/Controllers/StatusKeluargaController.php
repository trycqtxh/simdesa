<?php

namespace App\Http\Controllers;

use App\Entities\StatusKeluarga;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StatusKeluargaCreateRequest;
use App\Http\Requests\StatusKeluargaUpdateRequest;
use App\Repositories\StatusKeluargaRepository;
use App\Validators\StatusKeluargaValidator;


class StatusKeluargaController extends Controller
{

    /**
     * @var StatusKeluargaRepository
     */
    protected $repository;

    /**
     * @var StatusKeluargaValidator
     */
    protected $validator;

    public function __construct(StatusKeluargaRepository $repository, StatusKeluargaValidator $validator)
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


        if (request()->wantsJson()) {

            $statusKeluargas = $this->repository->all();

            return response()->json([
                'data' => $statusKeluargas,
            ]);
        }

        return view('content.master.statuskeluarga');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StatusKeluargaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            if ($request->wantsJson()) {

                $tambah = [
                    'kode' => $request->kode,
                    'nama' => $request->status,
                ];

                StatusKeluarga::firstOrCreate($tambah);

                $response = [
                    'message' => 'Data Status Keluarga Behasil Dibuat',
                ];

                return response()->json($response, 201);
            }

            return redirect()->back();
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ], 422);
            }

            return redirect()->back();
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
            $statusKeluarga = $this->repository->find($id);
            return response()->json([
                'data' => $statusKeluarga,
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  StatusKeluargaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            if ($request->wantsJson()) {
                $update = [
                    'kode' => $request->kode,
                    'nama' => $request->status,
                ];

                StatusKeluarga::find($id)->update($update);

                $response = [
                    'message' => 'Data Status Keluarga Berhasil Diubah',
                ];
                return response()->json($response, 201);
            }

            return redirect()->back();
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ], 422);
            }

            return redirect()->back();
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
                    'message' => 'Data Status Keluarga Berhasil Dihapus',
                ]);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }
}
