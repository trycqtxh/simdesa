<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SumberDanaCreateRequest;
use App\Http\Requests\SumberDanaUpdateRequest;
use App\Repositories\SumberDanaRepository;
use App\Validators\SumberDanaValidator;


class SumberDanaController extends Controller
{

    /**
     * @var SumberDanaRepository
     */
    protected $repository;

    /**
     * @var SumberDanaValidator
     */
    protected $validator;

    public function __construct(SumberDanaRepository $repository, SumberDanaValidator $validator)
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
        $sumberDanas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sumberDanas,
            ]);
        }

        return view('sumberDanas.index', compact('sumberDanas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SumberDanaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SumberDanaCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $sumberDana = $this->repository->create($request->all());

            $response = [
                'message' => 'SumberDana created.',
                'data'    => $sumberDana->toArray(),
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
        $sumberDana = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sumberDana,
            ]);
        }

        return view('sumberDanas.show', compact('sumberDana'));
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

        $sumberDana = $this->repository->find($id);

        return view('sumberDanas.edit', compact('sumberDana'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  SumberDanaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(SumberDanaUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $sumberDana = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'SumberDana updated.',
                'data'    => $sumberDana->toArray(),
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'SumberDana deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'SumberDana deleted.');
    }
}
