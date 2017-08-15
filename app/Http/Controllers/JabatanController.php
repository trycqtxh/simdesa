<?php

namespace App\Http\Controllers;

use App\Entities\Jabatan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\JabatanCreateRequest;
use App\Http\Requests\JabatanUpdateRequest;
use App\Repositories\JabatanRepository;
use App\Validators\JabatanValidator;


class JabatanController extends Controller
{

    /**
     * @var JabatanRepository
     */
    protected $repository;

    /**
     * @var JabatanValidator
     */
    protected $validator;

    public function __construct(JabatanRepository $repository, JabatanValidator $validator)
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
            $jabatans = $this->repository->all();

            return response()->json([
                'data' => $jabatans,
            ]);
        }

        return view('content.master.jabatan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  JabatanCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $jabatan = [
                'kode' => $request->kode,
                'nama' => $request->jabatan
            ];

            Jabatan::firstOrCreate($jabatan);


            $response = [
                'message' => 'Jabatan Berhasil Ditambahkan',
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
        $jabatan = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $jabatan,
            ]);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  JabatanUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

//            $jabatan = $this->repository->update($request->all(), $id);
            $jabatan = [
                'kode' => $request->kode,
                'nama' => $request->jabatan
            ];
            Jabatan::find($id)->update($jabatan);

            $response = [
                'message' => 'Jabatan Berhasil Diubah',
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
                    'message' => 'Jabatan Berhasil Dihapus',
                    'deleted' => $deleted,
                ]);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }
    }
}
