<?php

use Illuminate\Database\Seeder;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = [
            ['kode'=>'kode_provinsi', 'index'=>'Kode Provinsi', 'value'=>''],
            ['kode'=>'provinsi', 'index'=>'Provinsi', 'value'=>''],
            ['kode'=>'kode_kota', 'index'=>'Kode Kota/Kabupaten', 'value'=>''],
            ['kode'=>'kota', 'index'=>'Kota/Kabupaten', 'value'=>''],
            ['kode'=>'kode_kecamatan', 'index'=>'Kode Kecamatan', 'value'=>''],
            ['kode'=>'kecamatan', 'index'=>'Kecamatan', 'value'=>''],
            ['kode'=>'nama_desa', 'index'=>'Nama Desa', 'value'=>''],
            ['kode'=>'alamat_desa', 'index'=>'Alamat Desa', 'value'=>''],
            ['kode'=>'telepon', 'index'=>'Telepon', 'value'=>''],
            ['kode'=>'email', 'index'=>'Email', 'value'=>''],
            ['kode'=>'nama_bank_cabang', 'index'=>'Nama Bank Cabang', 'value'=>''],
            ['kode'=>'nomor_bank_cabang', 'index'=>'Nomor Bank Cabang', 'value'=>''],
            ['kode'=>'kepala_desa', 'index'=>'Kepala Desa', 'value'=>''],
            ['kode'=>'sekretaris', 'index'=>'Sekretaris', 'value'=>''],
            ['kode'=>'bendahara', 'index'=>'Bendahara', 'value'=>''],
            ['kode'=>'sebelah_utara', 'index'=>'Sebelah Utara', 'value'=>''],
            ['kode'=>'sebelah_selatan', 'index'=>'Sebelah Selatan', 'value'=>''],
            ['kode'=>'sebelah_barat', 'index'=>'Sebelah Barat', 'value'=>''],
            ['kode'=>'sebelah_timur', 'index'=>'Sebelah Timur', 'value'=>''],
            ['kode'=>'jarak_tempuh_kecamatan', 'index'=>'Jarak Desa Ke Kecamatan', 'value'=>''],
            ['kode'=>'waktu_tempuh_kecamatan', 'index'=>'Waktu Tempuh Ke Kecamatan', 'value'=>''],
            ['kode'=>'jarak_tempuh_kota', 'index'=>'Jarak Tempuh Ke Kota/Kabupaten', 'value'=>''],
            ['kode'=>'waktu_tempuh_kota', 'index'=>'Waktu Tempuh Ke Kota/Kabupaten', 'value'=>''],
            ['kode'=>'angkutan_umum', 'index'=>'Ketersedian Anggkutan Umum', 'value'=>''],

            ['kode'=>'kode_pos', 'index'=>'Kode Pos', 'value'=>''],
            ['kode'=>'des', 'index'=>'Desa atau Kelurahan', 'value'=>'Desa'],
            ['kode'=>'kab', 'index'=>'Kabupaten atau Kota', 'value'=>'Kabupaten'],
            ['kode'=>'kec', 'index'=>'Kecamatan', 'value'=>'Kecamatan'],
            ['kode'=>'prov', 'index'=>'Provinsi', 'value'=>'Provinsi'],
            ['kode'=>'logo_desa', 'index'=>'Logo Desa', 'value'=>'logo.png'],
        ];
        foreach($table as $t){
            \App\Entities\ProfilDesa::firstOrCreate($t);
        }

        \App\Slider::firstOrCreate(['gambar'=>'1.jpg', 'title'=>'Susana Desa']);
    }
}
