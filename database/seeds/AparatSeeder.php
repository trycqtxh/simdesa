<?php

use Illuminate\Database\Seeder;

class AparatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aparat = ['niap' => 'admin', 'no_pengangkatan'=>'12/12/12', 'tanggal_pengangkatan'=>'12/12/12',  'admin'=>1, 'password'=>'123456'];

        App\Entities\AparatDesa::firstOrCreate($aparat);
    }
}
