<?php

use Illuminate\Database\Seeder;

class RPJMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'periode'=>'2016 - 2022',
            'tahun_awal'=>'2016',
            'tahun_akhir'=>'2022',
        ];
        App\Entities\RPJM::firstOrCreate($data);
    }
}
