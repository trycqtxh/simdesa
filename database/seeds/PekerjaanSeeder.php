<?php

use Illuminate\Database\Seeder;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'nama' => 'Buruh'],
            [ 'nama' => 'PNS' ],
            [ 'nama' => 'TNI / POLRI' ],
            [ 'nama' => 'Mahasiswa / Pelajar' ],
            [ 'nama' => 'Wiraswasta' ],
            [ 'nama' => 'Pegawai Swasta' ],
            [ 'nama' => 'Guru / Dosen' ],
            [ 'nama' => 'Lain-Lain' ],
        ];

        foreach($data as $d){
            \App\Entities\Pekerjaan::firstOrCreate($d);
        }

//        $pekerjaan = ['Buruh', 'PNS', 'TNI/POLRI', 'Mahasiswa/Pelajar', 'Wirausaha', 'Lain-Lain'];
//        \App\Entities\Pekerjaan::firstOrCreate($pekerjaan);
    }
}
