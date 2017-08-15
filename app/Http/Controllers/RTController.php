<?php

namespace App\Http\Controllers;

use App\Entities\RT;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\RTRepository;
use App\Validators\RTValidator;


class RTController extends Controller
{

    /**
     * @var RTRepository
     */
    protected $repository;

    /**
     * @var RTValidator
     */
    protected $validator;

    public function __construct(RTRepository $repository, RTValidator $validator)
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

            $rt = $this->repository->all();

            return response()->json([
                'data' => $rt,
            ], 200);
        }

        return view('content.master.rt');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RTCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            if ($request->wantsJson()) {

                $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

                $rt = [
                    'nama' => $request->rt,
                    'petugas' => $request->petugas,
                    'rw_id' => $request->rw,
                ];

                RT::firstOrCreate($rt);

                $response = [
                    'message' => 'Data RT Berhasil di Tambahkan.',
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

            $rt = $this->repository->find($id);

            return response()->json([
                'data' => $rt,
            ], 200);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  rtUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {
            if ($request->wantsJson()) {
                $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

                $update = [
                    'nama' => $request->rt,
                    'petugas' => $request->petugas,
                    'rw_id' => $request->rw,
                ];

                RT::find($id)->update($update);

                $response = [
                    'message' => 'Data RT Berhasil DiUbah.',
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

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
                RT::find($id)->delete();
                return response()->json([
                    'message' => 'Data RT Berhasil Dihapus.',
                ], 201);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }


    public function showSelect(Request $request, $id)
    {
        if($request->wantsJson()){
            $rt = RT::where('rw_id', $id)->get();
            $array = [];
            foreach($rt as $r){
                $row = [];
                $row[] = $r->id;
                $row[] = $r->nama;
                $array[] = $row;
            }
            return response()->json($array, 200);
        }
    }
}
