<?php

namespace App\Http\Controllers;

use App\Entities\ProfilDesa;
use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\File;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProfilDesaCreateRequest;
use App\Http\Requests\ProfilDesaUpdateRequest;
use App\Repositories\ProfilDesaRepository;
use App\Validators\ProfilDesaValidator;


class ProfilDesaController extends Controller
{

    /**
     * @var ProfilDesaRepository
     */
    protected $repository;

    /**
     * @var ProfilDesaValidator
     */
    protected $validator;

    public function __construct(ProfilDesaRepository $repository, ProfilDesaValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProfilDesa $profil)
    {

        if (request()->wantsJson()) {
            $tabel = [];

            $row['index'] = $profil->find('nama_desa')['index'];
            $row['value'] = (Auth::user()->admin) ? '<a href="#" onclick="return ubah(\''.$profil->find('nama_desa')['kode'].'\', \''.$profil->find('nama_desa')['index'].'\', \''.$profil->find('nama_desa')['value'].'\')" >'.(($profil->find('nama_desa')['value']) ? $profil->find('nama_desa')['value'] : '....').'</a>' : $profil->find('nama_desa')['value'];
            $tabel['profil'][] = $row;
            $row['index'] = $profil->find('kepala_desa')['index'];
            $row['value'] = (Auth::user()->admin) ? '<a href="#" onclick="return ubah(\''.$profil->find('kepala_desa')['kode'].'\', \''.$profil->find('kepala_desa')['index'].'\', \''.$profil->find('kepala_desa')['value'].'\')" >'.(($profil->find('kepala_desa')['value']) ? $profil->find('kepala_desa')['value'] : '....').'</a>' : $profil->find('kepala_desa')['value'];
            $tabel['profil'][] = $row;
            $row['index'] = $profil->find('sekretaris')['index'];
            $row['value'] = (Auth::user()->admin) ? '<a href="#" onclick="return ubah(\''.$profil->find('sekretaris')['kode'].'\', \''.$profil->find('sekretaris')['index'].'\', \''.$profil->find('sekretaris')['value'].'\')" >'.(($profil->find('sekretaris')['value']) ? $profil->find('sekretaris')['value'] : '....').'</a>' : $profil->find('sekretaris')['value'];
            $tabel['profil'][] = $row;

            $row['index'] = $profil->find('provinsi')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('provinsi')['kode'].'\', \''.$profil->find('provinsi')['index'].'\', \''.$profil->find('provinsi')['value'].'\')" >'.(($profil->find('provinsi')['value']) ? $profil->find('provinsi')['value'] : '....').'</a>';
            $tabel['profil'][] = $row;
            $row['index'] = $profil->find('kode_provinsi')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('kode_provinsi')['kode'].'\', \''.$profil->find('kode_provinsi')['index'].'\', \''.$profil->find('kode_provinsi')['value'].'\')" >'.(($profil->find('kode_provinsi')['value']) ? $profil->find('kode_provinsi')['value'] : '....').'</a>';
            $tabel['profil'][] = $row;
            $row['index'] = $profil->find('kota')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('kota')['kode'].'\', \''.$profil->find('kota')['index'].'\', \''.$profil->find('kota')['value'].'\')" >'.(($profil->find('kota')['value']) ? $profil->find('kota')['value'] : '....').'</a>';
            $tabel['profil'][] = $row;
            $row['index'] = $profil->find('kode_kota')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('kode_kota')['kode'].'\', \''.$profil->find('kode_kota')['index'].'\', \''.$profil->find('kode_kota')['value'].'\')" >'.(($profil->find('kode_kota')['value']) ? $profil->find('kode_kota')['value'] : '....').'</a>';
            $tabel['profil'][] = $row;
            $row['index'] = $profil->find('kecamatan')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('kecamatan')['kode'].'\', \''.$profil->find('kecamatan')['index'].'\', \''.$profil->find('kecamatan')['value'].'\')" >'.(($profil->find('kecamatan')['value']) ? $profil->find('kecamatan')['value'] : '....').'</a>';
            $tabel['profil'][] = $row;
            $row['index'] = $profil->find('kode_kecamatan')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('kode_kecamatan')['kode'].'\', \''.$profil->find('kode_kecamatan')['index'].'\', \''.$profil->find('kode_kecamatan')['value'].'\')" >'.(($profil->find('kode_kecamatan')['value']) ? $profil->find('kode_kecamatan')['value'] : '....').'</a>';
            $tabel['profil'][] = $row;

            $row['index'] = $profil->find('alamat_desa')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('alamat_desa')['kode'].'\', \''.$profil->find('alamat_desa')['index'].'\', \''.$profil->find('alamat_desa')['value'].'\')" >'.(($profil->find('alamat_desa')['value']) ? $profil->find('alamat_desa')['value'] : '....').'</a>';
            $tabel['profil'][] = $row;
            $row['index'] = $profil->find('telepon')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('telepon')['kode'].'\', \''.$profil->find('telepon')['index'].'\', \''.$profil->find('telepon')['value'].'\')" >'.(($profil->find('telepon')['value']) ? $profil->find('telepon')['value'] : '....').'</a>';
            $tabel['profil'][] = $row;
            $row['index'] = $profil->find('email')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('email')['kode'].'\', \''.$profil->find('email')['index'].'\', \''.$profil->find('email')['value'].'\')" >'.(($profil->find('email')['value']) ? $profil->find('email')['value'] : '....').'</a>';
            $tabel['profil'][] = $row;
            $row['index'] = $profil->find('nama_bank_cabang')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('nama_bank_cabang')['kode'].'\', \''.$profil->find('nama_bank_cabang')['index'].'\', \''.$profil->find('nama_bank_cabang')['value'].'\')" >'.(($profil->find('nama_bank_cabang')['value']) ? $profil->find('nama_bank_cabang')['value'] : '....').'</a>';
            $tabel['profil'][] = $row;
            $row['index'] = $profil->find('nomor_bank_cabang')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('nomor_bank_cabang')['kode'].'\', \''.$profil->find('nomor_bank_cabang')['index'].'\', \''.$profil->find('nomor_bank_cabang')['value'].'\')" >'.(($profil->find('nomor_bank_cabang')['value']) ? $profil->find('nomor_bank_cabang')['value'] : '....').'</a>';
            $tabel['profil'][] = $row;
            $row['index'] = $profil->find('logo_desa')['index'];
            $row['value'] = '<a href="#" onclick="return ubah_logo(\''.$profil->find('logo_desa')['kode'].'\', \''.$profil->find('logo_desa')['index'].'\', \''.$profil->find('logo_desa')['value'].'\')" >'.(($profil->find('logo_desa')['value']) ? $profil->find('logo_desa')['value'] : '....').'</a>';
            $tabel['profil'][] = $row;
            $row['index'] = $profil->find('kode_pos')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('kode_pos')['kode'].'\', \''.$profil->find('kode_pos')['index'].'\', \''.$profil->find('kode_pos')['value'].'\')" >'.(($profil->find('kode_pos')['value']) ? $profil->find('kode_pos')['value'] : '....').'</a>';
            $tabel['profil'][] = $row;

            if(Auth::user()->admin):
                $row['index'] = '';
                $row['value'] = '<b>Tambahan</b>';
                $tabel['profil'][] = $row;
                $row['index'] = $profil->find('des')['index'];
                $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('des')['kode'].'\', \''.$profil->find('des')['index'].'\', \''.$profil->find('des')['value'].'\')" >'.(($profil->find('des')['value']) ? $profil->find('des')['value'] : '....').'</a>';
                $tabel['profil'][] = $row;
                $row['index'] = $profil->find('kab')['index'];
                $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('kab')['kode'].'\', \''.$profil->find('kab')['index'].'\', \''.$profil->find('kab')['value'].'\')" >'.(($profil->find('kab')['value']) ? $profil->find('kab')['value'] : '....').'</a>';
                $tabel['profil'][] = $row;
                $row['index'] = $profil->find('kec')['index'];
                $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('kec')['kode'].'\', \''.$profil->find('kec')['index'].'\', \''.$profil->find('kec')['value'].'\')" >'.(($profil->find('kec')['value']) ? $profil->find('kec')['value'] : '....').'</a>';
                $tabel['profil'][] = $row;
                $row['index'] = $profil->find('prov')['index'];
                $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('prov')['kode'].'\', \''.$profil->find('prov')['index'].'\', \''.$profil->find('prov')['value'].'\')" >'.(($profil->find('prov')['value']) ? $profil->find('prov')['value'] : '....').'</a>';
                $tabel['profil'][] = $row;
            endif;

            $tabel['penduduk'][] = $row;
            $tabel['umur'][] = $row;
            $tabel['pendidikan'][] = $row;
            $tabel['kerja'][] = $row;




            return response()->json([
                'data' => $tabel,
            ], 200);
        }

        return view('content.profil_desa');
    }
    public function wilayah(ProfilDesa $profil)
    {

        if (request()->wantsJson()) {
            $tabel = [];
            $row['index'] = $profil->find('sebelah_utara')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('sebelah_utara')['kode'].'\', \''.$profil->find('sebelah_utara')['index'].'\', \''.$profil->find('sebelah_utara')['value'].'\')" >'.(($profil->find('sebelah_utara')['value']) ? $profil->find('sebelah_utara')['value'] : '....').'</a>';
            $tabel['wilayah'][] = $row;
            $row['index'] = $profil->find('sebelah_timur')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('sebelah_timur')['kode'].'\', \''.$profil->find('sebelah_timur')['index'].'\', \''.$profil->find('sebelah_timur')['value'].'\')" >'.(($profil->find('sebelah_timur')['value']) ? $profil->find('sebelah_timur')['value'] : '....').'</a>';
            $tabel['wilayah'][] = $row;
            $row['index'] = $profil->find('sebelah_selatan')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('sebelah_selatan')['kode'].'\', \''.$profil->find('sebelah_selatan')['index'].'\', \''.$profil->find('sebelah_selatan')['value'].'\')" >'.(($profil->find('sebelah_selatan')['value']) ? $profil->find('sebelah_selatan')['value'] : '....').'</a>';
            $tabel['wilayah'][] = $row;
            $row['index'] = $profil->find('sebelah_barat')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('sebelah_barat')['kode'].'\', \''.$profil->find('sebelah_barat')['index'].'\', \''.$profil->find('sebelah_barat')['value'].'\')" >'.(($profil->find('sebelah_barat')['value']) ? $profil->find('sebelah_barat')['value'] : '....').'</a>';
            $tabel['wilayah'][] = $row;

            $tabel['penduduk'][] = $row;
            $tabel['umur'][] = $row;
            $tabel['pendidikan'][] = $row;
            $tabel['kerja'][] = $row;

            return response()->json([
                'data' => $tabel,
            ], 200);
        }
    }
    public function lokasi(ProfilDesa $profil)
    {

        if (request()->wantsJson()) {
            $tabel = [];

            $row['index'] = $profil->find('jarak_tempuh_kota')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('jarak_tempuh_kota')['kode'].'\', \''.$profil->find('jarak_tempuh_kota')['index'].'\', \''.$profil->find('jarak_tempuh_kota')['value'].'\')" >'.(($profil->find('jarak_tempuh_kota')['value']) ? $profil->find('jarak_tempuh_kota')['value'] : '....').'</a>';
            $tabel['lokasi'][] = $row;
            $row['index'] = $profil->find('waktu_tempuh_kota')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('waktu_tempuh_kota')['kode'].'\', \''.$profil->find('waktu_tempuh_kota')['index'].'\', \''.$profil->find('waktu_tempuh_kota')['value'].'\')" >'.(($profil->find('waktu_tempuh_kota')['value']) ? $profil->find('waktu_tempuh_kota')['value'] : '....').'</a>';
            $tabel['lokasi'][] = $row;
            $row['index'] = $profil->find('jarak_tempuh_kecamatan')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('jarak_tempuh_kecamatan')['kode'].'\', \''.$profil->find('jarak_tempuh_kecamatan')['index'].'\', \''.$profil->find('jarak_tempuh_kecamatan')['value'].'\')" >'.(($profil->find('jarak_tempuh_kecamatan')['value']) ? $profil->find('jarak_tempuh_kecamatan')['value'] : '....').'</a>';
            $tabel['lokasi'][] = $row;
            $row['index'] = $profil->find('waktu_tempuh_kecamatan')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('waktu_tempuh_kecamatan')['kode'].'\', \''.$profil->find('waktu_tempuh_kecamatan')['index'].'\', \''.$profil->find('waktu_tempuh_kecamatan')['value'].'\')" >'.(($profil->find('waktu_tempuh_kecamatan')['value']) ? $profil->find('waktu_tempuh_kecamatan')['value'] : '....').'</a>';
            $tabel['lokasi'][] = $row;
            $row['index'] = $profil->find('angkutan_umum')['index'];
            $row['value'] = '<a href="#" onclick="return ubah(\''.$profil->find('angkutan_umum')['kode'].'\', \''.$profil->find('angkutan_umum')['index'].'\', \''.$profil->find('angkutan_umum')['value'].'\')" >'.(($profil->find('angkutan_umum')['value']) ? $profil->find('angkutan_umum')['value'] : '....').'</a>';
            $tabel['lokasi'][] = $row;

            return response()->json([
                'data' => $tabel,
            ], 200);
        }
    }

    public function statistik()
    {
        if (request()->wantsJson()) {
            $tabel = [];
            $jlmPendduduk = DB::table('penduduk_induk AS i')
                ->select(DB::RAW('count(*) as value, pen.jenis_kelamin as label'))
                ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
                ->leftJoin('penduduk as pen', 'i.penduduk_id', '=', 'pen.id')
                ->whereNull('m.penduduk_id')
                ->groupBy('label')
                ->get();
            foreach($jlmPendduduk as $p){
                $row['index'] = ($p->label == "L") ? 'Laki-laki' : "Perempuan";
                $row['value'] = $p->value;
                $tabel['penduduk'][] = $row;
            }

            $today = Carbon::today()->toDateString();
            $balita_akhir= Carbon::today()->subYear(5)->toDateString();
            $anak_akhir = Carbon::today()->subYear(11)->toDateString();
            $remaja_awal_akhir = Carbon::today()->subYear(16)->toDateString();
            $remaja_akhir_akhir = Carbon::today()->subYear(25)->toDateString();
            $dewasa_awal_akhir = Carbon::today()->subYear(35)->toDateString();
            $dewasa_akhir_akhir = Carbon::today()->subYear(45)->toDateString();
            $lansia_awal_akhir = Carbon::today()->subYear(55)->toDateString();
            $lansia_akhir_akhir = Carbon::today()->subYear(65)->toDateString();
            $manula = Carbon::today()->subYear(120)->toDateString();
            $grafikumur = DB::raw("
                CASE
                    WHEN p.tanggal_lahir BETWEEN '$balita_akhir' AND '$today' THEN '0-5 Balita'
                    WHEN p.tanggal_lahir BETWEEN '$anak_akhir' AND '$balita_akhir' THEN '06-11 Kanak-kanak'
                    WHEN p.tanggal_lahir BETWEEN '$remaja_awal_akhir' AND '$anak_akhir' THEN '12-16 Remaja Awal'
                    WHEN p.tanggal_lahir BETWEEN '$remaja_akhir_akhir' AND '$remaja_awal_akhir' THEN '17-25 Remaja Akhir'
                    WHEN p.tanggal_lahir BETWEEN '$dewasa_awal_akhir' AND '$remaja_akhir_akhir' THEN '26-35 Dewasa Awal'
                    WHEN p.tanggal_lahir BETWEEN '$dewasa_akhir_akhir' AND '$dewasa_awal_akhir' THEN '36-45 Dewasa Akhir'
                    WHEN p.tanggal_lahir BETWEEN '$lansia_awal_akhir' AND '$dewasa_akhir_akhir' THEN '46-55 Lansia Awal'
                    WHEN p.tanggal_lahir BETWEEN '$lansia_akhir_akhir' AND '$lansia_awal_akhir' THEN '56-65 Lansia Akhir'
                    WHEN p.tanggal_lahir <= '$lansia_akhir_akhir' THEN '>= 65 Manula'
                    WHEN p.tanggal_lahir IS NULL THEN '(NULL)'
                END AS label,
                COUNT(*) as value
            ");

            $jlmUmur = DB::table('penduduk_induk AS i')
                ->select($grafikumur)
                ->join('penduduk as p', 'p.id', '=', 'i.penduduk_id')
                ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
                ->whereNull('m.penduduk_id')
                ->groupBy('label')
                ->get();
            foreach($jlmUmur as $p){
                $row['index'] = $p->label;
                $row['value'] = $p->value;
                $tabel['umur'][] = $row;
            }

            $jlmPendidikan = DB::table('penduduk_induk AS i')
                ->select(DB::RAW('count(*) as value, i.pendidikan as label'))
                ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
                ->whereNull('m.penduduk_id')
                ->groupBy('label')
                ->get();

            foreach($jlmPendidikan as $p){
                $row['index'] = $p->label;
                $row['value'] = $p->value;
                $tabel['pendidikan'][] = $row;
            }

            $jlmPekerjaan = DB::table('penduduk_induk AS i')
                ->select(DB::RAW('count(*) as value, pek.nama as label'))
                ->leftJoin('penduduk_mutasi as m', 'i.penduduk_id', '=', 'm.penduduk_id')
                ->leftJoin('pekerjaan as pek', 'i.pekerjaan_id', '=', 'pek.id')
                ->whereNull('m.penduduk_id')
                ->groupBy('label')
                ->get();
            foreach($jlmPekerjaan as $p){
                $row['index'] = $p->label;
                $row['value'] = $p->value;
                $tabel['kerja'][] = $row;
            }

            $grafik['chart'] = [
                "startingAngle"=> "120",
                "showLabels"=> "0",
                "showLegend"=> "1",
                "enableMultiSlicing"=> "0",
                "slicingDistance"=> "15",
                "showPercentValues"=> "1",
                "showPercentInTooltip"=> "0",
                "plotTooltext"=> "Kategori : \$label<br>Banyak : \$datavalue",
                "caption"=> "Grafik Penduduk Berdasarkan ",
            ];
            $grafik['data'] = $jlmPendduduk;
            $tabel['grafik_penduduk'] = $grafik;
            $grafik['data'] = $jlmUmur;
            $tabel['grafik_umur'] = $grafik;
            $grafik['data'] = $jlmPendidikan;
            $tabel['grafik_pendidikan'] = $grafik;
            $grafik['data'] = $jlmPekerjaan;
            $tabel['grafik_pekerjaan'] = $grafik;

            return response()->json([
                'data' => $tabel,
            ], 200);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  ProfilDesaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logoUpdate(Request $request)
    {
        $this->validate($request, [
            'logo'  => 'required|mimes:png'
        ]);

        $imageName =  'logo.' .
            $request->file('logo')->getClientOriginalExtension();

        $request->file('logo')->move(
            public_path() . '/img/logo/', $imageName
        );
//        $value = [
//            'value' => $imageName
//        ];
//        ProfilDesa::find($request->kode)->update($value);
    }

    public function slider()
    {
        if(request()->wantsJson()){
            $data = [];
            $gambar = Slider::all();
            $i=1;
            foreach($gambar as $g):
                $row = [];
                $row['no'] = $i++;
                $row['judul'] = $g->title;
                $row['gambar'] = '<img src="'.url('img/slider/'.$g->gambar).'" class="img-thumbnail" style="width: 200px; height: auto">';
                $row['act'] = '
                <div class="btn-group">
                    <button class="btn btn-default btn-flat" onclick="return update_gambar(\''.$g->id.'\', \''.$g->title.'\')"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-default btn-flat" onclick="return delete_gambar(\''.$g->id.'\')"><i class="fa fa-trash"></i></button>
                </div>
                ';
                $data[] = $row;
            endforeach;
            return response()->json([
                'data' => $data
            ]);
        }

        return view('content.slider');
    }

    public function sliderStore(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'gambar'  => 'required|mimes:png,jpg,jpeg'
        ]);

        $extension = $request->file('gambar')->getClientOriginalExtension();
        $fileName = rand(11111,99999).'.'.$extension; // renameing image$gambar = microtime();

        $slider = new Slider();
        $slider->gambar = $fileName;
        $slider->title = $request->judul;
        $slider->save();

        $request->file('gambar')->move(
            public_path() . '/img/slider/', $fileName
        );
    }

    public function sliderUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'required',
            'judul' => 'required',
            'gambar'  => 'mimes:png,jpg,jpeg'
        ]);

        $slider = Slider::find($id);

        if($request->gambar){
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $fileName = rand(11111,99999).'.'.$extension; // renameing image$gambar = microtime();

//            File::delete(public_path() . '/img/slider/', $slider->gambar);
            unlink(public_path() . '/img/slider/'.$slider->gambar);
            $request->file('gambar')->move(
                public_path() . '/img/slider/', $fileName
            );

            $slider->gambar = $fileName;
        }


        $slider->title = $request->judul;
        $slider->save();

//        return response()->json([]);

    }

    public function sliderDestroy($id)
    {
        $slider = Slider::find($id);
        unlink(public_path() . '/img/slider/'.$slider->gambar);
        $slider->delete();

        return response()->json([
            'message' => 'Gambar Berhasil Dihapus',
        ], 201);
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
        $profilDesa = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $profilDesa,
            ]);
        }

        return view('profilDesas.show', compact('profilDesa'));
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

        $profilDesa = $this->repository->find($id);

        return view('profilDesas.edit', compact('profilDesa'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ProfilDesaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update($kode, Request $request, ProfilDesa $profil)
    {

        try {

            $update = [
                'value' => $request->label
            ];

            $profil->find($kode)->update($update);

            $response = [
                'message' => 'Profil Desa Berhasil Diubah',
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
                    'message' => 'Profil Desa Berhasil Dihapus',
                ], 201);
            }catch (QueryException $e){
                return response()->json([
                    'message' => 'Data Tidak Bisa Dihapus'
                ], 500);
            }
        }

        return redirect()->back()->with('message', 'ProfilDesa deleted.');
    }
}
