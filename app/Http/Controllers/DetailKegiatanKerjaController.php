<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DetailKegiatanKerjaCreateRequest;
use App\Http\Requests\DetailKegiatanKerjaUpdateRequest;
use App\Repositories\DetailKegiatanKerjaRepository;
use App\Validators\DetailKegiatanKerjaValidator;


class DetailKegiatanKerjaController extends Controller
{

    /**
     * @var DetailKegiatanKerjaRepository
     */
    protected $repository;

    /**
     * @var DetailKegiatanKerjaValidator
     */
    protected $validator;

    public function __construct(DetailKegiatanKerjaRepository $repository, DetailKegiatanKerjaValidator $validator)
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
        $detailKegiatanKerjas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $detailKegiatanKerjas,
            ]);
        }

        return view('detailKegiatanKerjas.index', compact('detailKegiatanKerjas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DetailKegiatanKerjaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DetailKegiatanKerjaCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $detailKegiatanKerja = $this->repository->create($request->all());

            $response = [
                'message' => 'DetailKegiatanKerja created.',
                'data'    => $detailKegiatanKerja->toArray(),
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
                ]);
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
        $detailKegiatanKerja = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $detailKegiatanKerja,
            ]);
        }

        return view('detailKegiatanKerjas.show', compact('detailKegiatanKerja'));
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

        $detailKegiatanKerja = $this->repository->find($id);

        return view('detailKegiatanKerjas.edit', compact('detailKegiatanKerja'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  DetailKegiatanKerjaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $detailKegiatanKerja = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'DetailKegiatanKerja updated.',
                'data'    => $detailKegiatanKerja->toArray(),
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
                ]);
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
                $deleted = $this->repository->delete($id);

                return response()->json([
                    'message' => 'Data Berhasil di hapus.',
                ]);

            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }

        return redirect()->back()->with('message', 'DetailKegiatanKerja deleted.');
    }
}
