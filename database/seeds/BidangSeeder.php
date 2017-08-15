<?php

use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama'=>'Pendapatan Asli Desa', 'jenis'=>'pendapatan'],
            ['nama'=>'Pendapatan Transfer', 'jenis'=>'pendapatan'],
            ['nama'=>'Pendapatan Lain-lain', 'jenis'=>'pendapatan'],

            ['nama'=>'Bidang Penyelenggaraan Pemerintahan Desa', 'jenis'=>'belanja'],
            ['nama'=>'Bidang Pelaksanaan Pembangunan Desa', 'jenis'=>'belanja'],
            ['nama'=>'Bidang Pembinaan Kemasyarakatan', 'jenis'=>'belanja'],
            ['nama'=>'Bidang Pemberdayaan Masyarakat', 'jenis'=>'belanja'],
            ['nama'=>'Bidang Tak Terduga', 'jenis'=>'belanja'],

            ['nama'=>'Penerimaan Pembiayaan', 'jenis'=>'pembiayaan'],
            ['nama'=>'Pengeluaran Pembiayaan', 'jenis'=>'pembiayaan'],
        ];

        foreach($data as $d){
            App\Entities\Bidang::firstOrCreate($d);
        }
    }
}
