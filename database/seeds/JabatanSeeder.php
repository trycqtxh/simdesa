<?php

use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan = [
            ['kode' => 'kades', 'nama' => 'Kepala Desa', ],
            ['kode' => 'sekdes', 'nama' => 'Sekertaris Desa', ],
            ['kode' => 'sekdes', 'nama' => 'Sekertaris Desa', ],
            ['kode' => 'bendahara', 'nama' => 'Bendahara Desa', ],
            ['kode' => 'staff', 'nama' => 'Staff Desa', ],
        ];
        foreach($jabatan as $j){
            App\Entities\Jabatan::firstOrCreate($j);
        }
    }
}
