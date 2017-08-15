<?php

namespace App\Http\Controllers;

use App\Criteria\NotPendudukKeluarCriteria;
use App\Criteria\PendudukIndukCriteria;
use App\Criteria\PendudukMatiCriteria;
use App\Entities\ProfilDesa;
use App\Entities\SuratMenyurat;
use App\Presenters\SuratPendudukMeninggalPresenter;
use App\Presenters\SuratPendudukPresenter;
use App\Repositories\PendudukIndukRepository;
use App\Repositories\PendudukRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\TemplateProcessor;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SuratMenyuratCreateRequest;
use App\Http\Requests\SuratMenyuratUpdateRequest;
use App\Repositories\SuratMenyuratRepository;
use App\Validators\SuratMenyuratValidator;
use PhpOffice\PhpWord\Settings;

class SuratMenyuratController extends Controller
{

    /**
     * @var SuratMenyuratRepository
     */
    protected $repository;

    /**
     * @var SuratMenyuratValidator
     */
    protected $validator;

    public function __construct(SuratMenyuratRepository $repository, SuratMenyuratValidator $validator)
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
        $suratMenyurats = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $suratMenyurats,
            ]);
        }

        return view('surat_menyurat.index', compact('suratMenyurats'));
    }

    public function surat_kehilangan()
    {
        error_reporting(E_ALL);
        define('CLI', (PHP_SAPI == 'cli') ? true : false);
        define('EOL', CLI ? PHP_EOL : '<br />');
        define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
        define('IS_INDEX', SCRIPT_FILENAME == 'index');
        Settings::loadConfig();

// Set writers
        $writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');

// Set PDF renderer
        if (null === Settings::getPdfRendererPath()) {
            $writers['PDF'] = null;
        }
        echo date('H:i:s'), ' Creating new TemplateProcessor instance...', EOL;
        echo $replace = asset('img/logo/logo1.png');

        $template = resource_path().'\assets\template-surat\surat_kehilangan.docx';

        $templateProcessor = new TemplateProcessor($template);

        $templateProcessor->setValue('Kabupaten', 'KOTA TASIKMALAYA');
        $templateProcessor->setValue('kabupaten', 'TASIKMALAYA');
        $templateProcessor->setValue('kecamatan', 'COBLONG');
        $templateProcessor->setValue('desa', 'SUKASARI');
        $templateProcessor->setValue('Desa', 'sukasari');
        $templateProcessor->setValue('alamat', 'JL. RE Martadinata');
        $templateProcessor->setValue('kodePos', '46196');
        $templateProcessor->setValue('nomorSurat', 'XI/HK/20/890');
        //Pemohon
        $templateProcessor->setValue('nama', 'Hilman Pratama');
        $templateProcessor->setValue('tempatLahir', 'Tasikmalaya');
        $templateProcessor->setValue('tanggalLahir', '30 Februari 1970');
        $templateProcessor->setValue('jenisKelamin', 'Laki-laki');
        $templateProcessor->setValue('pekerjaan', 'Dokter');
        $templateProcessor->setValue('alamat', 'JL. Rumah Sakit Umum');

        $templateProcessor->setValue('tanggalSurat', '12 Januari 2017');
        $templateProcessor->setValue('kepalaDesa', 'Faisal Abdul Hamid');
        $templateProcessor->saveAs('surat_kehilangan.docx');

    }

    function write($phpWord, $filename, $writers)
    {
        $result = '';

        // Write documents
        foreach ($writers as $format => $extension) {
            $result .= date('H:i:s') . " Write to {$format} format";
            if (null !== $extension) {
                $targetFile =  "{$filename}.{$extension}";
                $phpWord->save($targetFile, $format);
            } else {
                $result .= ' ... NOT DONE!';
            }
            $result .= EOL;
        }

        $result .= $this->getEndingNotes($writers);

        return $result;
    }

    function getEndingNotes($writers)
    {
        $result = '';

        // Do not show execution time for index
        if (!IS_INDEX) {
            $result .= date('H:i:s') . " Done writing file(s)" . EOL;
            $result .= date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB" . EOL;
        }

        // Return
        if (CLI) {
            $result .= 'The results are stored in the "results" subdirectory.' . EOL;
        } else {
            if (!IS_INDEX) {
                $types = array_values($writers);
                $result .= '<p>&nbsp;</p>';
                $result .= '<p>Results: ';
                foreach ($types as $type) {
                    if (!is_null($type)) {
                        $resultFile = 'results/' . SCRIPT_FILENAME . '.' . $type;
                        if (file_exists($resultFile)) {
                            $result .= "<a href='{$resultFile}' class='btn btn-primary'>{$type}</a> ";
                        }
                    }
                }
                $result .= '</p>';
            }
        }

        return $result;
    }

    public function loadSurat($jenis){
        return view('surat_menyurat.template-surat.'.$jenis, compact('jenis'))->render();
    }

    public function save_surat($jenis, Request $request)
    {
        if($request->wantsJson()) {
            //$jenis = 'surat-keterangan-belum-pernah-kawin';
            $this->validate($request, [
                'nomor_surat' => 'required'
            ]);

            $prov = ProfilDesa::find('prov')['value'];
            $provinsi = ProfilDesa::find('provinsi')['value'];
            $kab = ProfilDesa::find('kab')['value'];
            $kabupaten = ProfilDesa::find('kota')['value'];
            $kec = ProfilDesa::find('kec')['value'];
            $kecamatan = ProfilDesa::find('kecamatan')['value'];
            $des = ProfilDesa::find('des')['value'];
            $desa = ProfilDesa::find('nama_desa')['value'];
            $alamat_desa = ProfilDesa::find('alamat_desa')['value'];
            $kode_pos = ProfilDesa::find('kode_pos')['value'];
            $nomor_telepon = ProfilDesa::find('telepon')['value'];
            $kepala_desa = ProfilDesa::find('kepala_desa')['value'];
            $tanggal_surat = Carbon::now()->format('d F Y');
            $logo = ProfilDesa::find('logo_desa')['value'];

            $template = resource_path() . '\assets\template-surat\\' . $jenis . '.docx';
            $logo_replace = public_path() . '\img\logo\\' . $logo;

            $templateProcessor = new TemplateProcessor($template);
            $templateProcessor->setImageValue($templateProcessor->getImgFileName($templateProcessor->seachImagerId("logo")), $logo_replace);
            //--------------------------------------------------------------------------------------------------------------
            $templateProcessor->setValue('KAB', strtoupper($kab));
            $templateProcessor->setValue('KABUPATEN', strtoupper($kabupaten));
            $templateProcessor->setValue('Kab', ucwords($kab));
            $templateProcessor->setValue('Kabupaten', ucwords($kabupaten));
            $templateProcessor->setValue('KECAMATAN', strtoupper($kecamatan));
            $templateProcessor->setValue('Kecamatan', ucwords($kecamatan));
            $templateProcessor->setValue('DES', strtoupper($des));
            $templateProcessor->setValue('Des', ucwords($des));
            $templateProcessor->setValue('DESA', strtoupper($desa));
            $templateProcessor->setValue('Desa', ucwords($desa));
            $templateProcessor->setValue('AlamatDesa', ucwords($desa));

            $templateProcessor->setValue('alamat', ucwords($alamat_desa));
            $templateProcessor->setValue('kodePos', $kode_pos);
            $templateProcessor->setValue('Des', ucwords($des));
            $templateProcessor->setValue('Desa', ucwords($desa));
            $templateProcessor->setValue('Provinsi', ucwords($provinsi));
            $templateProcessor->setValue('NomorTeleponDesa', $nomor_telepon);

            $templateProcessor->setValue('tanggalSurat', $tanggal_surat);
            $templateProcessor->setValue('KEPALADESA', strtoupper($kepala_desa));
            $templateProcessor->setValue('KepalaDesa', ucwords($kepala_desa));

            $nomor_surat = $request->nomor_surat;
            $templateProcessor->setValue('NomorSurat', strtoupper($nomor_surat));

            //-------------------------------------------------------------------------------------------------------------
            //SURAT KETERANGAN BELUM KAWIN
            if($jenis == 'surat-keterangan-belum-pernah-kawin') {
                $nama = $request->nama;

                $tempat_tanggal_lahir = $request->tempat_tanggal_lahir;
                $bin_binti = $request->bin_binti;
                $jenis_kelamin = $request->jenis_kelamin;
                $pekerjaan = $request->pekerjaan;
                $alamat = $request->alamat;

                $templateProcessor->setValue('NomorSurat', strtoupper($nomor_surat));

                $templateProcessor->setValue('Nama', ucwords($nama));
                $templateProcessor->setValue('TempatTanggalLahir', ucwords($tempat_tanggal_lahir));
                $templateProcessor->setValue('BinBinti', ucwords($bin_binti));
                $templateProcessor->setValue('JenisKelamin', ucwords($jenis_kelamin));
                $templateProcessor->setValue('Pekerjaan', ucwords($pekerjaan));
                $templateProcessor->setValue('Alamat', ucwords($alamat));
            }
            //-------------------------------------------------------------------------------------------------------------
            //SURAT KETERANGAN KELAHIRAN
            if($jenis == 'surat-keterangan-kelahiran') {
                $hari_lahir = $request->hari_lahir;
                $tanggal_lahir = $request->tanggal_lahir;
                $jam_lahir = $request->jam_lahir;
                $tempat_lahir = $request->tempat_lahir;
                $jenis_kelamin = $request->jenis_kelamin_anak;

                $nama = $request->nama_anak;

                $nama_ibu = $request->nama_ibu;
                $nik_ibu = $request->nik_ibu;
                $umur_ibu = $request->umur_ibu;
                $pekerjaan_ibu = $request->pekerjaan_ibu;
                $alamat_ibu = $request->alamat_ibu;

                $nama_ayah = $request->nama_ayah;
                $nik_ayah = $request->nik_ayah;
                $umur_ayah = $request->umur_ayah;
                $pekerjaan_ayah = $request->pekerjaan_ayah;
                $alamat_ayah = $request->alamat_ayah;

                $templateProcessor->setValue('Nama', ucwords($nama));
                $templateProcessor->setValue('JenisKelamin', ucwords($jenis_kelamin));
                $templateProcessor->setValue('HariKelahiran', ucwords($hari_lahir));
                $templateProcessor->setValue('TanggalKelahiran', ucwords($tanggal_lahir));
                $templateProcessor->setValue('JamKelahiran', ucwords($jam_lahir));
                $templateProcessor->setValue('TempatKelahiran', ucwords($tempat_lahir));
                $templateProcessor->setValue('NamaIbu', ucwords($nama_ibu));
                $templateProcessor->setValue('NikIbu', ucwords($nik_ibu));
                $templateProcessor->setValue('UmurIbu', ucwords($umur_ibu));
                $templateProcessor->setValue('PekerjaanIbu', ucwords($pekerjaan_ibu));
                $templateProcessor->setValue('AlamatIbu', ucwords($alamat_ibu));
                $templateProcessor->setValue('NamaAyah', ucwords($nama_ayah));
                $templateProcessor->setValue('NikAyah', ucwords($nik_ayah));
                $templateProcessor->setValue('UmurAyah', ucwords($umur_ayah));
                $templateProcessor->setValue('PekerjaanAyah', ucwords($pekerjaan_ayah));
                $templateProcessor->setValue('AlamatAyah', ucwords($alamat_ayah));

            }
            //-------------------------------------------------------------------------------------------------------------
            //SURAT KETERANGAN MENINGGAL
            if($jenis == 'surat-keterangan-kematian') {
                $nama = $request->nama;
                $jenis_kelamin = $request->jenis_kelamin;
                $tempat_tanggal_lahir = $request->tempat_tanggal_lahir;
                $agama = $request->agama;
                $pekerjaan = $request->pekerjaan;
                $alamat = $request->alamat;

                $hari_meninggal = $request->hari_meninggal;
                $tanggal_meninggal = $request->tanggal_meninggal;
                $tempat_meninggal = $request->tempat_meninggal;
                $penyebab_meninggal = $request->penyebab_meninggal;

                $nama_pelapor = $request->nama_pelapor;
                $tempat_tanggal_lahir_pelapor = $request->tempat_tanggal_lahir_pelapor;
                $umur_pelapor = $request->umur_pelapor;
                $pekerjaan_pelapor = $request->pekerjaan_pelapor;
                $hubungan_pelapor = $request->hubungan_pelapor;

                $templateProcessor->setValue('Nama', ucwords($nama));
                $templateProcessor->setValue('JenisKelamin', ucwords($jenis_kelamin));
                $templateProcessor->setValue('TempatTanggalLahir', ucwords($tempat_tanggal_lahir));
                $templateProcessor->setValue('Agama', ucwords($agama));
                $templateProcessor->setValue('Pekerjaan', ucwords($pekerjaan));
                $templateProcessor->setValue('Alamat', ucwords($alamat));
                $templateProcessor->setValue('Hari', ucwords($hari_meninggal));
                $templateProcessor->setValue('Tanggal', ucwords($tanggal_meninggal));
                $templateProcessor->setValue('Tempat', ucwords($tempat_meninggal));
                $templateProcessor->setValue('Penyebab', ucwords($penyebab_meninggal));
                $templateProcessor->setValue('NamaPelapor', ucwords($nama_pelapor));
                $templateProcessor->setValue('TempatTanggalLahirPelapor', ucwords($tempat_tanggal_lahir_pelapor));
                $templateProcessor->setValue('UmurPelapor', ucwords($umur_pelapor));
                $templateProcessor->setValue('PekerjaanPelapor', ucwords($pekerjaan_pelapor));
                $templateProcessor->setValue('Hubungan', ucwords($hubungan_pelapor));

            }
            //-------------------------------------------------------------------------------------------------------------
            //SURAT KETERANGAN CERAI
            if($jenis == 'surat-keterangan-cerai') {
                $nama = $request->nama1.' - '.$request->nama2;
                $nama1 = $request->nama1;
                $jenis_kelamin1 = $request->jenis_kelamin1;
                $tempat_tanggal_lahir1 = $request->tempat_tanggal_lahir1;
                $pekerjaan1 = $request->pekerjaan1;
                $alamat1 = $request->alamat1;
                $warga_negara1 = $request->warga_negara1;

                $nama2 = $request->nama2;
                $jenis_kelamin2 = $request->jenis_kelamin2;
                $tempat_tanggal_lahir2 = $request->tempat_tanggal_lahir2;
                $pekerjaan2 = $request->pekerjaan2;
                $alamat2 = $request->alamat2;
                $warga_negara2 = $request->warga_negara2;

                $templateProcessor->setValue('Nama1', ucwords($nama1));
                $templateProcessor->setValue('TempatTanggalLahir1', ucwords($tempat_tanggal_lahir1));
                $templateProcessor->setValue('WargaNegara1', ucwords($warga_negara1));
                $templateProcessor->setValue('JenisKelamin1', ucwords($jenis_kelamin1));
                $templateProcessor->setValue('Pekerjaan1', ucwords($pekerjaan1));
                $templateProcessor->setValue('Alamat1', ucwords($alamat1));

                $templateProcessor->setValue('Nama2', ucwords($nama2));
                $templateProcessor->setValue('TempatTanggalLahir2', ucwords($tempat_tanggal_lahir2));
                $templateProcessor->setValue('WargaNegara2', ucwords($warga_negara2));
                $templateProcessor->setValue('JenisKelamin2', ucwords($jenis_kelamin2));
                $templateProcessor->setValue('Pekerjaan2', ucwords($pekerjaan2));
                $templateProcessor->setValue('Alamat2', ucwords($alamat2));

            }
            //-------------------------------------------------------------------------------------------------------------
            //SURAT KETERANGAN KELAKUAN BAIK
            if($jenis == 'surat-keterangan-kelakuan-baik') {

                $nama = $request->nama;
                $tempat_tanggal_lahir = $request->tempat_tanggal_lahir;
                $pekerjaan = $request->pekerjaan;
                $alamat = $request->alamat;

                $tujuan = $request->tujuan;

                $templateProcessor->setValue('Nama', ucwords($nama));
                $templateProcessor->setValue('TempatTanggalLahir', ucwords($tempat_tanggal_lahir));
                $templateProcessor->setValue('Pekerjaan', ucwords($pekerjaan));
                $templateProcessor->setValue('Alamat', ucwords($alamat));
                $templateProcessor->setValue('Tujuan', ucwords($tujuan));

            }
            //-------------------------------------------------------------------------------------------------------------
            //SURAT KETERANGAN TIDAK MAMPU
            if($jenis == 'surat-keterangan-tidak-mampu') {

                $nama = $request->nama;
                $tempat_tanggal_lahir = $request->tempat_tanggal_lahir;
                $jenis_kelamin = $request->jenis_kelamin;
                $pekerjaan = $request->pekerjaan;
                $alamat = $request->alamat;
                $bangsa_agama = $request->bangsa_agama;
                $status_perkawinan = $request->status_perkawinan;
                $tujuan = $request->tujuan;

                $templateProcessor->setValue('Nama', ucwords($nama));
                $templateProcessor->setValue('JenisKelamin', ucwords($jenis_kelamin));
                $templateProcessor->setValue('TempatTanggalLahir', ucwords($tempat_tanggal_lahir));
                $templateProcessor->setValue('StatusKawin', ucwords($status_perkawinan));
                $templateProcessor->setValue('Pekerjaan', ucwords($pekerjaan));
                $templateProcessor->setValue('Alamat', ucwords($alamat));
                $templateProcessor->setValue('BangsaAgama', ucwords($bangsa_agama));
                $templateProcessor->setValue('Tujuan', ucwords($tujuan));

            }
            //-------------------------------------------------------------------------------------------------------------
            //SURAT KETERANGAN KEHILANGAN
            if($jenis == 'surat-keterangan-kehilangan') {

                $nama                    = $request->nama;
                $tempat_tanggal_lahir    = $request->tempat_tanggal_lahir;
                $jenis_kelamin           = $request->jenis_kelamin;
                $pekerjaan               = $request->pekerjaan;
                $alamat                  = $request->alamat;
                $bangsa_agama            = $request->bangsa_agama;
                $keterangan              = $request->tujuan;

                $templateProcessor->setValue('Nama', ucwords($nama));
                $templateProcessor->setValue('JenisKelamin', ucwords($jenis_kelamin));
                $templateProcessor->setValue('TempatTanggalLahir', ucwords($tempat_tanggal_lahir));

                $templateProcessor->setValue('Pekerjaan', ucwords($pekerjaan));
                $templateProcessor->setValue('Alamat', ucwords($alamat));
                $templateProcessor->setValue('BangsaAgama', ucwords($bangsa_agama));
                $templateProcessor->setValue('keteranganKehilangan', ucwords($keterangan));

            }
            //-------------------------------------------------------------------------------------------------------------
            //SURAT KETERANGAN USAHA
            if($jenis == 'surat-keterangan-usaha') {
                $nama                    = $request->nama;
                $tempat_tanggal_lahir    = $request->tempat_tanggal_lahir;
                $jenis_kelamin           = $request->jenis_kelamin;
                $pekerjaan               = $request->pekerjaan;
                $alamat                  = $request->alamat;

                $usaha                   = $request->usaha;

                $templateProcessor->setValue('Nama', ucwords($nama));
                $templateProcessor->setValue('JenisKelamin', ucwords($jenis_kelamin));
                $templateProcessor->setValue('TempatTanggalLahir', ucwords($tempat_tanggal_lahir));

                $templateProcessor->setValue('Pekerjaan', ucwords($pekerjaan));
                $templateProcessor->setValue('Alamat', ucwords($alamat));
                $templateProcessor->setValue('USAHA', strtoupper($usaha));

            }
            //-------------------------------------------------------------------------------------------------------------
            //SURAT KETERANGAN DOMISILI
            if($jenis == 'surat-keterangan-domisili') {
                $nama                    = $request->nama;
                $tempat_tanggal_lahir    = $request->tempat_tanggal_lahir;
                $jenis_kelamin           = $request->jenis_kelamin;
                $pekerjaan               = $request->pekerjaan;
                $alamat                  = $request->alamat;
                $bangsa_agama            = $request->bangsa_agama;

                $templateProcessor->setValue('Nama', ucwords($nama));
                $templateProcessor->setValue('JenisKelamin', ucwords($jenis_kelamin));
                $templateProcessor->setValue('TempatTanggalLahir', ucwords($tempat_tanggal_lahir));
                $templateProcessor->setValue('BangsaAgama', ucwords($bangsa_agama));
                $templateProcessor->setValue('Pekerjaan', ucwords($pekerjaan));
                $templateProcessor->setValue('Alamat', ucwords($alamat));

            }
            //-------------------------------------------------------------------------------------------------------------
            //SURAT KETERANGAN ADON NIKAH
            if($jenis == 'surat-keterangan-adon-nikah') {
                $nama                    = $request->nama;
                $tempat_tanggal_lahir    = $request->tempat_tanggal_lahir;
                $jenis_kelamin           = $request->jenis_kelamin;
                $pekerjaan               = $request->pekerjaan;
                $alamat                  = $request->alamat;
                $bangsa_agama            = $request->bangsa_agama;

                $tanggal_nikah = $request->tanggal_nikah;
                $tempat_nikah = $request->tempat_nikah;

                $nama2 = $request->nama2;
                $tempat_tanggal_lahir2 = $request->tempat_tanggal_lahir2;
                $bin2 = $request->bin2;

                $templateProcessor->setValue('Nama', ucwords($nama));
                $templateProcessor->setValue('JenisKelamin', ucwords($jenis_kelamin));
                $templateProcessor->setValue('TempatTanggalLahir', ucwords($tempat_tanggal_lahir));
                $templateProcessor->setValue('BangsaAgama', ucwords($bangsa_agama));
                $templateProcessor->setValue('Pekerjaan', ucwords($pekerjaan));
                $templateProcessor->setValue('Alamat', ucwords($alamat));

                $templateProcessor->setValue('tanggalNikah', ucwords($tanggal_nikah));
                $templateProcessor->setValue('tempatNikah', ucwords($tempat_nikah));

                $templateProcessor->setValue('Nama2', ucwords($nama2));
                $templateProcessor->setValue('TempatTanggalLahir2', ucwords($tempat_tanggal_lahir2));
                $templateProcessor->setValue('Bin2', ucwords($bin2));
            }
            //-------------------------------------------------------------------------------------------------------------
            //SURAT KETERANGAN IZIN RAME-RAME
            if($jenis == 'surat-keterangan-izin-rame-rame') {
                $nama                    = $request->nama;
                $tempat_tanggal_lahir    = $request->tempat_tanggal_lahir;
                $alamat                  = $request->alamat;

                $hari_tanggal           = $request->hari_tanggal;
                $waktu                  = $request->waktu;
                $acara                  = $request->acara;

                $nama_camat = $request->nama_camat;
                $nip_camat = $request->nip_camat;

                $kode_ramil = $request->kode_ramil;
                $nama_ramil = $request->nama_ramil;
                $nrp = $request->nrp;

                $templateProcessor->setValue('Nama', ucwords($nama));
                $templateProcessor->setValue('TempatTanggalLahir', ucwords($tempat_tanggal_lahir));
                $templateProcessor->setValue('Alamat', ucwords($alamat));

                $templateProcessor->setValue('HariTanggal', ucwords($hari_tanggal));
                $templateProcessor->setValue('Waktu', ucwords($waktu));
                $templateProcessor->setValue('Acara', ucwords($acara));

                $templateProcessor->setValue('NAMACAMAT', ucwords($nama_camat));
                $templateProcessor->setValue('nipCamat', ucwords($nip_camat));

                $templateProcessor->setValue('kodeRamil', ucwords($kode_ramil));
                $templateProcessor->setValue('NamaRamil', ucwords($nama_ramil));
                $templateProcessor->setValue('NRP', ucwords($nrp));


                $templateProcessor->setValue('noKap', '......');
                $templateProcessor->setValue('tglKap', ucwords($tanggal_surat));
            }
            //-------------------------------------------------------------------------------------------------------------
            //SURAT KETERANGAN TANAH
            if($jenis == 'surat-keterangan-tanah') {

                $nama                    = $request->nama;
                $tempat_tanggal_lahir    = $request->tempat_tanggal_lahir;
                $alamat                  = $request->alamat;

                $alamat_tanah                  = $request->alamat_tanah;
                $luas_tanah                  = $request->luas_tanah;
                $luas_bangunan                  = $request->luas_bangunan;

                $utara           = $request->utara;
                $timur               = $request->timur;
                $selatan            = $request->selatan;
                $barat              = $request->barat;

                $Noputara           = $request->nop_utara;
                $Noptimur               = $request->nop_timur;
                $Nopselatan            = $request->nop_selatan;
                $Nopbarat              = $request->nop_barat;

                $keterangan               = $request->keterangan;
                $tanggal_tanah            = $request->tanggal_tanah;
                $pemilik_tanah              = $request->pemilik_tanah;

                $templateProcessor->setValue('Nama', ucwords($nama));
                $templateProcessor->setValue('TempatTanggalLahir', ucwords($tempat_tanggal_lahir));
                $templateProcessor->setValue('Alamat', ucwords($alamat));

                $templateProcessor->setValue('AlamatTanah', ucwords($alamat_tanah));
                $templateProcessor->setValue('LuasTanah', ucwords($luas_tanah));
                $templateProcessor->setValue('LuasBangunan', ucwords($luas_bangunan));

                $templateProcessor->setValue('Utara', ucwords($utara));
                $templateProcessor->setValue('Timur', ucwords($timur));
                $templateProcessor->setValue('Selatan', ucwords($selatan));
                $templateProcessor->setValue('Barat', ucwords($barat));

                $templateProcessor->setValue('NopUtara', ucwords($Noputara));
                $templateProcessor->setValue('NopTimur', ucwords($Noptimur));
                $templateProcessor->setValue('NopSelatan', ucwords($Nopselatan));
                $templateProcessor->setValue('NopBarat', ucwords($Nopbarat));

                $templateProcessor->setValue('KeteranganTanah', ucwords($keterangan));
                $templateProcessor->setValue('TanggalTanah', ucwords($tanggal_tanah));
                $templateProcessor->setValue('NamaPemilikTanah', ucwords($pemilik_tanah));

                $templateProcessor->setValue('NAMACAMAT', '.............');
                $templateProcessor->setValue('nipCamat', '......');

            }
            //------------------------------------------------------------------------------------------------------------
            //SURAT KETERANGAN PINDAH
            if($jenis == 'surat-keterangan-pindah') {

                $nik                    = $request->nik;
                $nama                   = $request->nama;
                $nomor_keluarga         = $request->nomor_keluarga;
                $kepala_kelarga         = $request->kepala_kelarga;
                $alamat                 = $request->alamat;
                $RT                     = $request->rt;
                $RW                     = $request->rw;

                $alamat_tujuan          = $request->alamat_tujuan;
                $RT_tujuan              = $request->rt_tujuan;
                $RW_Tujuan              = $request->rw_tujuan;
                $Desa_Tujuan            = $request->desa_tujuan;
                $kev_t                  = $request->kecamatan_tujuan;
                $kab_tuj                = $request->kabupaten_tujuan;

                $jumlah                 = $request->jumlah;

                $templateProcessor->setValue('Nik', ucwords($nik));
                $templateProcessor->setValue('Nama', ucwords($nama));
                $templateProcessor->setValue('NomorKeluarga', ucwords($nomor_keluarga));
                $templateProcessor->setValue('KepalaKeluarga', ucwords($kepala_kelarga));

                $templateProcessor->setValue('Alamat', ucwords($alamat));
                $templateProcessor->setValue('RT', ucwords($RT));
                $templateProcessor->setValue('RW', ucwords($RW));


                $templateProcessor->setValue('AlamatTujuan', ucwords($alamat_tujuan));
                $templateProcessor->setValue('RTTujuan', ucwords($RT_tujuan));
                $templateProcessor->setValue('RWTujuan', ucwords($RW_Tujuan));
                $templateProcessor->setValue('DesaTujuan', ucwords($Desa_Tujuan));
                $templateProcessor->setValue('KecamatanTujuan', ucwords($kev_t));
                $templateProcessor->setValue('KabupatenTujuan', ucwords($kab_tuj));

                $templateProcessor->setValue('Jumlah', ucwords($jumlah));

            }
            //------------------------------------------------------------------------------------------------------------
            $filename = str_slug($jenis.$tanggal_surat.$nama, '-').'.docx';
            $url_file = public_path().'/file-surat-permohonan/'.$filename;
            $templateProcessor->saveAs($url_file);

            $database = [
                'nomor_surat' => strtoupper($nomor_surat),
                'pemohon'     => $nama,
                'tanggal_surat'=> Carbon::now()->format('Y-m-d'),
                'jenis_surat' => str_replace('-', ' ', $jenis),
                'url'         => $filename
            ];
            SuratMenyurat::firstOrCreate($database);

            return response()->json([
                'message' => str_replace('-', ' ', $jenis).' Berhasil Dibuat',
                'path_download' => $filename
            ], 201);
        }
    }

    public function download_surat($file_name)
    {
        return response()->download(public_path().'/file-surat-permohonan/'.$file_name);
    }

    //-------------------------------------------------GET DATA -----------------------------
    public function penduduk(PendudukIndukRepository $repository)
    {
        return response()->json($repository->setPresenter(SuratPendudukPresenter::class)->all());
    }

    public function pendudukMeninggal(PendudukRepository $repository)
    {
        return response()->json($repository
            ->popCriteria(NotPendudukKeluarCriteria::class)
            ->popCriteria(PendudukIndukCriteria::class)
            ->pushCriteria(PendudukMatiCriteria::class)
            ->setPresenter(SuratPendudukMeninggalPresenter::class)->all());
    }

    public function penduduk_pindah()
    {

    }

}
