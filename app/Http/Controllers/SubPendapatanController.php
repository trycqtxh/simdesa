<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SubPendapatanCreateRequest;
use App\Http\Requests\SubPendapatanUpdateRequest;
use App\Repositories\SubPendapatanRepository;
use App\Validators\SubPendapatanValidator;


class SubPendapatanController extends Controller
{

    /**
     * @var SubPendapatanRepository
     */
    protected $repository;

    /**
     * @var SubPendapatanValidator
     */
    protected $validator;

    public function __construct(SubPendapatanRepository $repository, SubPendapatanValidator $validator)
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
        $subPendapatans = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $subPendapatans,
            ]);
        }

        return view('subPendapatans.index', compact('subPendapatans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SubPendapatanCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SubPendapatanCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $subPendapatan = $this->repository->create($request->all());

            $response = [
                'message' => 'SubPendapatan created.',
                'data'    => $subPendapatan->toArray(),
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
        $subPendapatan = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $subPendapatan,
            ]);
        }

        return view('subPendapatans.show', compact('subPendapatan'));
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

        $subPendapatan = $this->repository->find($id);

        return view('subPendapatans.edit', compact('subPendapatan'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  SubPendapatanUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(SubPendapatanUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $subPendapatan = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'SubPendapatan updated.',
                'data'    => $subPendapatan->toArray(),
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
                    'message' => 'Sub Pendapatan Berhasil Dihapus',
                ], 201);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }
}
