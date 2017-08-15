<?php

namespace App\Http\Controllers;

use App\Entities\Bidang;
use App\Entities\Pendapatan;
use App\Validators\PendapatanLevel1Validator;
use App\Validators\PendapatanLevel2Validator;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Repositories\PendapatanRepository;
use App\Validators\PendapatanValidator;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


class PerencanaanPendapatanController extends Controller
{

    /**
     * @var PendapatanRepository
     */
    protected $repository;

    /**
     * @var PendapatanValidator
     */
    protected $validator;
    protected $validL1;
    protected $validL2;

    public function __construct(PendapatanRepository $repository, PendapatanValidator $validator, PendapatanLevel1Validator $validL1, PendapatanLevel2Validator $valid2)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->validL1 = $validL1;
        $this->validL2 = $valid2;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $current_year = Carbon::now()->year;
        $bidang = Bidang::where('jenis', 'pendapatan')->get();

        if (request()->wantsJson()) {
            $table = [];

            $jumlah_anggaran = 0;
            $kode_pendapatan = 1;
            $pen['act'] = '';
            $pen['kode_1'] = $kode_pendapatan;
            $pen['kode_2'] = '';
            $pen['kode_3'] = '';
            $pen['kode_4'] = '';

            $pen['uraian'] = "<b>PENDAPATAN</b>";
            $pen['anggaran'] = '';
            $pen['keterangan'] = '';
            $table[] = $pen;

            $kode_1 = 1;
            foreach($bidang as $b){
                $row_bidang = [];
//                $row_bidang['act'] = '
//                <div class="btn-group">
//                    <button class="btn btn-default btn-xs dropdown-toggle btn-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
//                    <ul class="dropdown-menu">
//                        <li><a href="#" onClick="return tambah_subpendapatan(\''.$b->id.'\', \''.$b->nama.'\', \'sub-bidang\')"><i class="fa fa-plus"></i> Tambah</a></li>
//                    </ul>
//                </div>
//                ';
                $row_bidang['act'] = '
                '.( (Auth::user()->can('add-pendapatan-perencanaan')) ? '<a class="btn btn-default btn-xs" onClick="return tambah_subpendapatan(\''.$b->id.'\', \''.$b->nama.'\', \'sub-bidang\')"><i class="fa fa-plus"></i></a>' : '' ).'
                ';
                $row_bidang['kode_1'] = $kode_pendapatan;
                $row_bidang['kode_2'] = $kode_1;
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = '<b><i>'.$b->nama.'</i></b>';
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;

                //------------------------------------------------------------------------------------------------------
                $kode_2 = 1;
                $pendapatan = Pendapatan::where('bidang_id', $b->id)->where('level', 'level_1')->where('tahun', $current_year)->get();
                foreach($pendapatan As $p){
//                    $row_pendapatan['act'] = '
//                    <div class="btn-group">
//                        <button class="btn btn-default btn-xs dropdown-toggle btn-danger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
//                        <ul class="dropdown-menu">
//                            <li><a href="#" onClick="return tambah_pendapatan(\''.$p->id.'\', \''.$p->uraian.'\', \'pendapatan\')"><i class="fa fa-plus"></i> Tambah</a></li>
//                            <li><a href="#" onClick="return ubah_pendapatan(\''.$p->id.'\', \''.$p->uraian.'\', \'pendapatan\')"><i class="fa fa-edit"></i> Ubah</a></li>
//                            <li><a href="#" onClick="return hapus(\''.$p->id.'\', \''.$p->uraian.'\', \'pendapatan\')"><i class="fa fa-trash"></i> Hapus</a></li>
//                        </ul>
//                    </div>
//                    ';
                    $row_pendapatan['act'] = '
                    <div class="btn-group">
                    '.( (Auth::user()->can('add-pendapatan-perencanaan')) ? '<a class="btn btn-default btn-xs" onClick="return tambah_pendapatan(\''.$p->id.'\', \''.$p->uraian.'\', \'pendapatan\')"><i class="fa fa-plus"></i> </a>' : '' ).'
                    '.( (Auth::user()->can('edit-pendapatan-perencanaan')) ? '<a class="btn btn-default btn-xs" onClick="return ubah_pendapatan(\''.$p->id.'\', \''.$p->uraian.'\', \'pendapatan\')"><i class="fa fa-edit"></i> </a>' : '' ).'
                    '.( (Auth::user()->can('remove-pendapatan-perencanaan')) ? '<a class="btn btn-default btn-xs" onClick="return hapus(\''.$p->id.'\', \''.$p->uraian.'\', \'pendapatan\')"><i class="fa fa-trash"></i> </a>' : '' ).'
                    </div>
                    ';
                    $row_pendapatan['kode_1'] = $kode_pendapatan;
                    $row_pendapatan['kode_2'] = $kode_1;
                    $row_pendapatan['kode_3'] = $kode_2;
                    $row_pendapatan['kode_4'] = '';

                    $row_pendapatan['uraian'] = $p->uraian;
                    $row_pendapatan['anggaran'] = '';
                    $row_pendapatan['keterangan'] = '';
                    $table[] = $row_pendapatan;

                    $kode_3 = 1;
                    $subpendapatan = Pendapatan::where('level', 'level_2')->where('tahun', $current_year)->where('pendapatan_id', $p->id)->get();
                    foreach($subpendapatan as $sp){
//                        $row_subpendapatan['act'] = '
//                        <div class="btn-group">
//                            <button class="btn btn-default btn-xs dropdown-toggle btn-warning" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
//                            <ul class="dropdown-menu">
//                                <li><a href="#" onClick="return ubah_subpendapatan(\''.$sp->id.'\', \''.$sp->uraian.'\', \'sub-pendapatan\')"><i class="fa fa-edit"></i> Ubah</a></li>
//                                <li><a href="#" onClick="return hapus(\''.$sp->id.'\', \''.$sp->uraian.'\', \'sub-pendapatan\')"><i class="fa fa-trash"></i> Hapus</a></li>
//                            </ul>
//                        </div>
//                        ';
                        $row_subpendapatan['act'] = '
                        <div class="btn-group">
                            '.( (Auth::user()->can('edit-pendapatan-perencanaan')) ? '<a class="btn btn-default btn-xs" onClick="return ubah_subpendapatan(\''.$sp->id.'\', \''.$sp->uraian.'\', \'sub-pendapatan\')"><i class="fa fa-edit"></i> </a>' : '' ).'
                            '.( (Auth::user()->can('remove-pendapatan-perencanaan')) ? '<a class="btn btn-default btn-xs" onClick="return hapus(\''.$sp->id.'\', \''.$sp->uraian.'\', \'sub-pendapatan\')"><i class="fa fa-trash"></i> </a>' : '' ).'
                        </div>
                        ';
                        $row_subpendapatan['kode_1'] = $kode_pendapatan;
                        $row_subpendapatan['kode_2'] = $kode_1;
                        $row_subpendapatan['kode_3'] = $kode_2;
                        $row_subpendapatan['kode_4'] = $kode_3;

                        $row_subpendapatan['uraian'] = $sp->uraian;
                        $row_subpendapatan['anggaran'] = number_format($sp->jumlah_dana, 2, ',', '.');
                        $row_subpendapatan['keterangan'] = $sp->keterangan;
                        $table[] = $row_subpendapatan;
                        $jumlah_anggaran += (int) $sp->jumlah_dana;

                        $kode_3++;
                    }
                    $kode_2++;
                }
                //------------------------------------------------------------------------------------------------------
                $row_bidang['act'] = '';
                $row_bidang['kode_1'] = '';
                $row_bidang['kode_2'] = '';
                $row_bidang['kode_3'] = '';
                $row_bidang['kode_4'] = '';

                $row_bidang['uraian'] = '';
                $row_bidang['anggaran'] = '';
                $row_bidang['keterangan'] = '';
                $table[] = $row_bidang;

                $kode_1++;
            }
            $row_jumlah['act'] = '';
            $row_jumlah['kode_1'] = '';
            $row_jumlah['kode_2'] = '';
            $row_jumlah['kode_3'] = '';
            $row_jumlah['kode_4'] = '';

            $row_jumlah['uraian'] = '<b>JUMLAH PENDAPATAN</b>';
            $row_jumlah['anggaran'] = number_format($jumlah_anggaran, 2, ',', '.');
            $row_jumlah['keterangan'] = '';

            $table[] = $row_jumlah;

            return response()->json([
                'data' => $table,
            ]);
        }

        return view('content.perencanaan.pendapatan', compact('current_year'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PendapatanCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $jenis)
    {

        try {
            $current_year = (string) Carbon::now()->year;

            if($jenis == "sub-bidang"){
                $this->validL1->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

                $sb = [
                    'uraian'   => $request->uraian,
                    'level'    => 'level_1',
                    'tahun'    => $current_year,
                    'bidang_id'=> $request->bidang,
                ];
                Pendapatan::firstOrCreate($sb);


            }elseif($jenis == "pendapatan"){
                $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

                $sb = [
                    'uraian'       => $request->uraian,
                    'level'        => 'level_2',
                    'tahun'        => $current_year,
                    'pendapatan_id'=> $request->sub_pendapatan,
                    'jumlah_dana'  => $request->anggaran,
                    'keterangan'   => $request->keterangan,
                ];
                Pendapatan::firstOrCreate($sb);

            }

            $response = [
                'message' => 'Pendapatan Berhasil Ditambahkan',
            ];

            if ($request->wantsJson()) {

                return response()->json($response, 201);
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pendapatan = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pendapatan,
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PendapatanUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $jenis, $id)
    {

        try {

            if($jenis == "sub-bidang"){
                $this->validL1->with($request->all())->passesOrFail((ValidatorInterface::RULE_UPDATE));

                $update = [
                    'uraian' => $request->uraian,
                ];

                Pendapatan::find($id)->update($update);

            }elseif($jenis == "pendapatan"){
                $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

                $update = [
                    'uraian'       => $request->uraian,
                    'jumlah_dana'  => $request->anggaran,
                    'keterangan'   => $request->keterangan,
                ];

                Pendapatan::find($id)->update($update);

            }


            $response = [
                'message' => 'Pendapatan Berhasil Diubah',
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
            try{
                $deleted = $this->repository->delete($id);
                return response()->json([
                    'message' => 'Pendapatan Berhasil Dihapus',
                    'deleted' => $deleted,
                ]);
            }catch (QueryException $e){
                return response()->json([
                    'error'   => true,
                    'message' => 'Data Tidak Bisa Dihapus',
                    'exeption' => $e->errorInfo,
                ], 500);
            }
        }
    }
}
