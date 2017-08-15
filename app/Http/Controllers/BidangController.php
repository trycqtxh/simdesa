<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BidangCreateRequest;
use App\Http\Requests\BidangUpdateRequest;
use App\Repositories\BidangRepository;
use App\Validators\BidangValidator;


class BidangController extends Controller
{

    /**
     * @var BidangRepository
     */
    protected $repository;

    /**
     * @var BidangValidator
     */
    protected $validator;

    public function __construct(BidangRepository $repository, BidangValidator $validator)
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
        $bidangs = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bidangs,
            ]);
        }

        return view('bidangs.index', compact('bidangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BidangCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BidangCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $bidang = $this->repository->create($request->all());

            $response = [
                'message' => 'Bidang created.',
                'data'    => $bidang->toArray(),
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
        $bidang = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bidang,
            ]);
        }

        return view('bidangs.show', compact('bidang'));
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

        $bidang = $this->repository->find($id);

        return view('bidangs.edit', compact('bidang'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  BidangUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $bidang = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Bidang updated.',
                'data'    => $bidang->toArray(),
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

        return redirect()->back()->with('message', 'Bidang deleted.');
    }
}
