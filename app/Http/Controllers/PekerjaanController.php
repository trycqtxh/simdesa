<?php

namespace App\Http\Controllers;

use App\Entities\Pekerjaan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PekerjaanCreateRequest;
use App\Http\Requests\PekerjaanUpdateRequest;
use App\Repositories\PekerjaanRepository;
use App\Validators\PekerjaanValidator;


class PekerjaanController extends Controller
{

    /**
     * @var PekerjaanRepository
     */
    protected $repository;

    /**
     * @var PekerjaanValidator
     */
    protected $validator;

    public function __construct(PekerjaanRepository $repository, PekerjaanValidator $validator)
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
            $pekerjaans = $this->repository->all();

            return response()->json([
                'data' => $pekerjaans,
            ]);
        }

        return view('content.master.pekerjaan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PekerjaanCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tambah = [
                'nama'=>$request->pekerjaan
            ];

            Pekerjaan::create($tambah);
            $response = [
                'message' => 'Pekerjaan Berhasil Ditambahkan',
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
            $pekerjaan = $this->repository->find($id);

            return response()->json([
                'data' => $pekerjaan,
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PekerjaanUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $ubah = [
                'nama' => $request->pekerjaan
            ];
            Pekerjaan::find($id)->update($ubah);

            $response = [
                'message' => 'Pekerjaan Berhasil Diubah',
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
                $deleted = $this->repository->delete($id);
                return response()->json([
                    'message' => 'Pekerjaan Berhasil Dihapus',
                ], 201);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }
}
