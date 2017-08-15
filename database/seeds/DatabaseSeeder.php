<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(PermisionSeeder::class);

        $this->call(Status_Keluarga_Seeder::class);
        $this->call(JabatanSeeder::class);
        $this->call(ProfilSeeder::class);
        $this->call(PekerjaanSeeder::class);
        $this->call(BidangSeeder::class);
        $this->call(SumberDanaSeeder::class);

        $this->call(AdminSeeder::class);

//        $this->call(RT_RW_Seeder::class);
//        factory(\App\Entities\Penduduk::class, 50)->create();
//        factory(\App\Entities\PendudukInduk::class, 30)->create();
//
//

//        $this->call(RPJMSeeder::class);
//
//        $this->call(KerjaSeeder::class);
//
//        factory(\App\Entities\AparatDesa::class, 5)->create();

//        $this->call(AparatSeeder::class);

//        factory(\App\Entities\AgendaDesa::class, 40)->create();
//        factory(\App\Entities\EkspedisiDesa::class, 40)->create();
//        factory(\App\Entities\InventarisDesa::class, 40)->create();
//        factory(\App\Entities\KeputusanKepalaDesa::class, 40)->create();
//        factory(\App\Entities\LembarBeritaDesa::class, 40)->create();
//        factory(\App\Entities\PeraturanDesa::class, 40)->create();
//        factory(\App\Entities\TanahDesa::class, 40)->create();
//        factory(\App\Entities\TanahKasDesa::class, 40)->create();
    }
}
