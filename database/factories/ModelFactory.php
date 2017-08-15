<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Entities\AparatDesa::class, function (Faker\Generator $faker) {
    static $password = '123456';

    return [
        'nip' => '10112671',
        'admin' => 1,
        'password' => $password
    ];
});

$factory->define(App\Entities\Penduduk::class, function(Faker\Generator $faker){
    return [
        'nama' => $faker->name,
        'tempat_lahir' => $faker->city,
        'tanggal_lahir' => $faker->date('Y-m-d'),
        'jenis_kelamin' => ['L', 'P'][rand(0,1)],
        'kewarga_negaraan' => ['WNI', 'WNA'][rand(0,1)],
    ];
});
//'agama' => ['ISLAM', 'KRISTEN PROTESTAN', 'KRISTEN KATOLIK', 'HINDU', 'BUDDHA', 'KONGHUCU'][rand(0, 5)],
//'status_perkawinan' => ['BELUM KAWIN', 'KAWIN', 'CERAI', 'CERAI MATI'][rand(0,3)],
//'Pekerjaan' => 'Pekerjaan',
//'kelompok_penduduk' => 'Kemlompok Penduduk'

$factory->define(App\Entities\PendudukInduk::class, function(Faker\Generator $faker){
    $status_keluarga = \App\Entities\StatusKeluarga::inRandomOrder()->first()['id'];
    $kk = \App\Entities\AnggotaKeluarga::inRandomOrder()->first()['nomor_kk'];
    $rt = \App\Entities\RT::inRandomOrder()->first()['id'];
    $rw = \App\Entities\RW::inRandomOrder()->first()['id'];
    $penduduk_id = \App\Entities\Penduduk::inRandomOrder()->first()['id'];
    $pekerjaan_id = \App\Entities\Pekerjaan::inRandomOrder()->first()['id'];

    return [
        'nik' => $faker->unique()->ean13,
        'golongan_darah' => ['A', 'B', 'AB', 'O'][rand(0,3)],
        'agama' => ['ISLAM', 'KRISTEN PROTESTAN', 'KRISTEN KATOLIK', 'HINDU', 'BUDDHA', 'KONGHUCU'][rand(0, 5)],
        'status_perkawinan' => ['BK', 'K', 'JD', 'DD'][rand(0,3)],
        'pendidikan' => ['Tidak/Belum Sekolah', 'SD', 'SMP', 'SMA', 'DIPLOMA I (D1)', 'DIPLOMA II (D2)', 'DIPLOMA III (D3)', 'STRATA I (S1)', 'STRATA II (S2)', 'STRATA III (S3)'][rand(0,9)],
        'alamat' => $faker->address,
        'membaca' => ['L', 'D', 'A', 'AL', 'AD', 'ALD'][rand(0, 5)],
        'keterangan' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'nomor_kk' => null,
        'status_keluarga_id' => $status_keluarga,
        'dusun' => $faker->address,
        'rw_id' => $rw,
        'rt_id' => $rt,
        'penduduk_id' => $penduduk_id,
        'pekerjaan_id' => $pekerjaan_id,
    ];
});
//$factory->define(App\Entities\AparatDesa::class, function(Faker\Generator $faker){
//    $jabatan = \App\Entities\Jabatan::inRandomOrder()->first()['id'];
//    $nik = \App\Entities\PendudukInduk::inRandomOrder()->first()['nik'];
//    return [
//        'nip' => $faker->unique()->ean13,
//        'golongan'=>['I/a', 'I/b', 'I/c', 'I/d', 'II/a', 'II/b', 'II/c', 'II/d', 'III/a', 'III/b', 'III/c', 'III/d', 'IV/a', 'IV/b', 'IV/c', 'IV/d', ][rand(0, 15)],
//        'no_pengangkatan'=>$faker->numberBetween(0, 20),
//        'tanggal_pengangkatan'=>$faker->date('Y-m-d'),
//        'jabatan_id'=>$jabatan,
//        'nik_penduduk'=>$nik,
//        'password'=>'123456',
//    ];
//});

$factory->define(App\Entities\AgendaDesa::class, function(Faker\Generator $faker){
   return [
        'tanggal_pengiriman' => $faker->date('Y-m-d'),
        'nomor_masuk' => $faker->unique()->randomNumber($nbDigits = NULL) ,
        'tanggal_masuk' => $faker->date('Y-m-d'),
        'nama_pengirim_masuk' => $faker->name,
        'isi_singkat_masuk' =>  $faker->name,
        'nomor_keluar'=> $faker->unique()->randomNumber($nbDigits = NULL) ,
        'tanggal_keluar' =>  $faker->date('Y-m-d'),
        'ditujukan_kepada'  => $faker->name,
        'isi_singkat_keluar' => $faker->name,
        'keterangan' => $faker->name
   ];
});
$factory->define(App\Entities\EkspedisiDesa::class, function(Faker\Generator $faker){
   return [
        'tanggal_kirim' =>  $faker->date('Y-m-d'),
        'nomor_surat' =>  $faker->unique()->randomNumber($nbDigits = NULL) ,
        'tanggal_surat' =>  $faker->date('Y-m-d'),
        'isi_singkat' => $faker->name,
        'ditujukan_kepada' => $faker->name,
        'keterangan' => $faker->name,
   ];
});
$factory->define(App\Entities\InventarisDesa::class, function(Faker\Generator $faker){
   return [
        'jenis_barang' =>  $faker->paragraph($nbWords = 3, $variableNbWords = true),
        'di_beli_sendiri' =>  $faker->numberBetween(0, 10),
        'di_beli_pemerintah' =>  $faker->numberBetween(0, 10),
        'di_beli_provinsi' => $faker->numberBetween(0, 10),
        'di_beli_kota' =>  $faker->numberBetween(0, 10),
        'sumbangan' =>  $faker->numberBetween(0, 10),
        'keadaan_baik' =>  $faker->numberBetween(0, 10),
        'keadaan_rusak' =>  $faker->numberBetween(0, 10),
        'rusak'=>$faker->numberBetween(0, 10),
        'dijual' =>  $faker->numberBetween(0, 10),
        'disumbangkan' =>  $faker->numberBetween(0, 10),
        'tanggal_penghapusan' => $faker->date('Y-m-d'),
        'akhir_baik' =>  $faker->numberBetween(0, 10),
        'akhir_rusak' =>  $faker->numberBetween(0, 10),
        'keterangan' =>  $faker->name,
   ];
});
$factory->define(App\Entities\KeputusanKepalaDesa::class, function(Faker\Generator $faker){
   return [
        'nomor_keputusan' => $faker->unique()->randomNumber($nbDigits = NULL) ,
        'tanggal_keputusan' => $faker->date('Y-m-d'),
        'judul'=> $faker->name,
        'uraian' =>  $faker->name,
        'nomor_dilaporkan'=> $faker->unique()->randomNumber($nbDigits = NULL) ,
        'tanggal_dilaporkan' => $faker->date('Y-m-d'),
        'keterangan'=> $faker->name,
   ];
});
$factory->define(App\Entities\LembarBeritaDesa::class, function(Faker\Generator $faker){
   return [
        'jenis_peraturan' => ['Peraturan Desa','Peraturan Bersama','Peraturan Kepala Desa'][rand(0,2)],
        'nomor_ditetapkan' => $faker->unique()->randomNumber($nbDigits = NULL) ,
        'tanggal_ditetapkan' =>  $faker->date('Y-m-d'),
        'tentang' => $faker->numberBetween(0, 10),
        'nomor_diundangkan' => $faker->unique()->randomNumber($nbDigits = NULL) ,
        'tanggal_diundangkan' =>  $faker->date('Y-m-d'),
        'keterangan' => $faker->name,
   ];
});
$factory->define(App\Entities\PeraturanDesa::class, function(Faker\Generator $faker){
   return [
        'jenis_peraturan' => ['Peraturan Desa', 'Peraturan Bersama'][rand(0,2)],
        'nomor_ditetapkan' => $faker->unique()->randomNumber($nbDigits = NULL) ,
        'tanggal_ditetapkan' => $faker->date('Y-m-d'),
        'judul'=>  $faker->words($nb = 3, $asText = false),
        'uraian' =>   $faker->name,
        'nomor_kesepakatan' => $faker->unique()->randomNumber($nbDigits = NULL) ,
        'tanggal_kesepakan' => $faker->date('Y-m-d'),
        'nomor_laporan' => $faker->unique()->randomNumber($nbDigits = NULL) ,
        'tanggal_laporan' =>  $faker->date('Y-m-d'),
        'nomor_diundangkan_lembaran' => $faker->unique()->randomNumber($nbDigits = NULL) ,
        'tanggal_diundangkan_lembaran' =>  $faker->date('Y-m-d'),
        'nomor_diundangkan_berita' => $faker->unique()->randomNumber($nbDigits = NULL) ,
        'tanggal_diundangkan_berita' => $faker->date('Y-m-d'),
        'keterangan' => $faker->name,
   ];
});
$factory->define(App\Entities\TanahDesa::class, function(Faker\Generator $faker){
   return [
        'nama' => $faker->name,
        'jumlah' =>  $faker->numberBetween(0, 10),
        'hm' =>  $faker->numberBetween(0, 10),
        'hgb' =>  $faker->numberBetween(0, 10),
        'hp' =>  $faker->numberBetween(0, 10),
        'hgu' =>  $faker->numberBetween(0, 10),
        'hpl' =>  $faker->numberBetween(0, 10),
        'ma' =>  $faker->numberBetween(0, 10),
        'vi' =>  $faker->numberBetween(0, 10),
        'tn' =>  $faker->numberBetween(0, 10),
        'non_perumahan' =>  $faker->numberBetween(0, 10),
        'non_perdagangan' =>  $faker->numberBetween(0, 10),
        'non_perkantoran' =>  $faker->numberBetween(0, 10),
        'non_industri' =>  $faker->numberBetween(0, 10),
        'non_fasilitas' =>  $faker->numberBetween(0, 10),
        'sawah' =>  $faker->numberBetween(0, 10),
        'tegalan' =>  $faker->numberBetween(0, 10),
        'perkebunan' =>  $faker->numberBetween(0, 10),
        'peternakan_perikanan' =>  $faker->numberBetween(0, 10),
        'hutan_belukar' =>  $faker->numberBetween(0, 10),
        'hutan_lebat' =>  $faker->numberBetween(0, 10),
        'mutasi' =>  $faker->numberBetween(0, 10),
        'tanah_kosong' =>  $faker->numberBetween(0, 10),
        'lain_lain' =>  $faker->numberBetween(0, 10),
        'keterangan' => $faker->name,
   ];
});
$factory->define(App\Entities\TanahKasDesa::class, function(Faker\Generator $faker){
   return [
        'asal_tanah' => $faker->address,
        'no_sertifikat' => $faker->numberBetween(0, 10),
        'luas_kas' =>  $faker->numberBetween(0, 10),
        'kelas' => ['S1','D1','DLL'][rand(0,2)],
        'milik_desa' =>  $faker->numberBetween(0, 10),
        'pemerintah' =>  $faker->numberBetween(0, 10),
        'provinsi' =>  $faker->numberBetween(0, 10),
        'kabkota' =>  $faker->numberBetween(0, 10),
        'lain_lain' =>  $faker->numberBetween(0, 10),
        'tgl_perolehan' =>  $faker->numberBetween(0, 10),
        'sawah' =>  $faker->numberBetween(0, 10),
        'tegal' =>  $faker->numberBetween(0, 10),
        'kebun' =>  $faker->numberBetween(0, 10),
        'tambak' =>  $faker->numberBetween(0, 10),
        'tanah_kering' =>  $faker->numberBetween(0, 10),
        'patok_ada' =>  $faker->numberBetween(0, 10),
        'patok_tidak' =>  $faker->numberBetween(0, 10),
        'papan_ada' =>  $faker->numberBetween(0, 10),
        'papan_tidak' =>  $faker->numberBetween(0, 10),
        'lokasi' => $faker->numberBetween(0, 10),
        'peruntukan' => $faker->numberBetween(0, 10),
        'keterangan' => $faker->name,
   ];
});