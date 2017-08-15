<?php

use Illuminate\Database\Seeder;

class RT_RW_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<3;$i++){
            \App\Entities\RW::firstOrCreate([
                'nama' => '0'.$i,
                'petugas' => 'Petugas RW '.$i,
            ]);
        }

        for($i=1; $i<15; $i++){
            $rw = \App\Entities\RW::inRandomOrder()->first()['id'];
            \App\Entities\RT::firstOrCreate([
                'nama' => '0'.$i,
                'petugas' => 'Petugas RT '.$i,
                'rw_id' => $rw,
            ]);
        }
    }
}
