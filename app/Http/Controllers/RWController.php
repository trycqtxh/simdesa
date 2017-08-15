<?php

namespace App\Http\Controllers;

use App\Entities\RW;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RWCreateRequest;
use App\Http\Requests\RWUpdateRequest;
use App\Repositories\RWRepository;
use App\Validators\RWValidator;


class RWController extends Controller
{

    /**
     * @var RWRepository
     */
    protected $repository;

    /**
     * @var RWValidator
     */
    protected $validator;

    public function __construct(RWRepository $repository, RWValidator $validator)
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
            $rw = $this->repository->all();
            return response()->json([
                'data' => $rw,
            ], 200);
        }

        return view('content.master.rw');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RWCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);


            if ($request->wantsJson()) {

                $data = [
                    'nama' => $request->rw,
                    'petugas' => $request->petugas,
                ];

                RW::firstOrCreate($data);

                $response = [
                    'message' => 'Data RW Berhasil Ditambahakan.',
                ];
                return response()->json($response, 201);
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
        if (request()->wantsJson()) {

            $rW = $this->repository->find($id);

            return response()->json([
                'data' => $rW,
            ], 200);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RWUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            //$rW = $this->repository->update($request->all(), $id);

            if ($request->wantsJson()) {

                $update = [
                    'nama' => $request->rw,
                    'petugas' => $request->petugas,
                ];

                RW::find($id)->update($update);

                $response = [
                    'message' => 'Data RW Berhasil Diubah.',
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
                    'message' => 'Data RW Berhasil Dihapus',
                ]);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }
}
