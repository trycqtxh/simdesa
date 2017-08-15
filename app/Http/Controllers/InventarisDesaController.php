<?php

namespace App\Http\Controllers;

use App\Presenters\InventarisDesaPresenter;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InventarisDesaCreateRequest;
use App\Http\Requests\InventarisDesaUpdateRequest;
use App\Repositories\InventarisDesaRepository;
use App\Validators\InventarisDesaValidator;


class InventarisDesaController extends Controller
{

    /**
     * @var InventarisDesaRepository
     */
    protected $repository;

    /**
     * @var InventarisDesaValidator
     */
    protected $validator;

    public function __construct(InventarisDesaRepository $repository, InventarisDesaValidator $validator)
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

            $inventarisDesas = $this->repository->setPresenter(InventarisDesaPresenter::class)->all();

            return response()->json([
                'data' => $inventarisDesas,
            ]);
        }

         return view('content.umum.inventaris_kekayaan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InventarisDesaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(InventarisDesaCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $inventarisDesa = $this->repository->create($request->all());

            $response = [
                'message' => 'InventarisDesa created.',
                'data'    => $inventarisDesa->toArray(),
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
        $inventarisDesa = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $inventarisDesa,
            ]);
        }

        return view('inventarisDesas.show', compact('inventarisDesa'));
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

        $inventarisDesa = $this->repository->find($id);

        return view('inventarisDesas.edit', compact('inventarisDesa'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  InventarisDesaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(InventarisDesaUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $inventarisDesa = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'InventarisDesa updated.',
                'data'    => $inventarisDesa->toArray(),
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
    }
}
