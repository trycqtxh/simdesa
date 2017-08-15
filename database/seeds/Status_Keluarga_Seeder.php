<?php

use Illuminate\Database\Seeder;

class Status_Keluarga_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            ['kode'=>'KK', 'nama' => 'Kepala Keluarga'],
            ['kode'=>'Ist', 'nama' => 'Istri'],
            ['kode'=>'AK', 'nama' => 'Anak Kandung'],
            ['kode'=>'AA', 'nama' => 'Anak Angkat'],
            ['kode'=>'Pemb', 'nama' => 'Pembantu'],
        ];
        foreach($status as $s){
            \App\Entities\StatusKeluarga::firstOrCreate($s);
        }
    }
}
