<?php

use Illuminate\Database\Seeder;

class SumberDanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama'=>'Dana Desa (APBN)'],
            ['nama'=>'Alokasi Dana Desa'],
            ['nama'=>'Dana Bagian dari Hasil Pajak dan Retribusi'],
            ['nama'=>'APBD Provinsi'],
            ['nama'=>'APBD Kab/Kota']
        ];
        foreach($data as $d){
            App\Entities\SumberDana::firstOrCreate($d);
        }
    }
}
