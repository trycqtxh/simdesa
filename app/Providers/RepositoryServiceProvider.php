<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\RTRepository::class, \App\Repositories\RTRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RWRepository::class, \App\Repositories\RWRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PekerjaanRepository::class, \App\Repositories\PekerjaanRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StatusKeluargaRepository::class, \App\Repositories\StatusKeluargaRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\AnggotaKeluargaRepository::class, \App\Repositories\AnggotaKeluargaRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\PendudukRepository::class, \App\Repositories\PendudukRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\PendudukIndukRepository::class, \App\Repositories\PendudukIndukRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\PendudukSementaraRepository::class, \App\Repositories\PendudukSementaraRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\PendudukMutasiRepository::class, \App\Repositories\PendudukMutasiRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\RPJMRepository::class, \App\Repositories\RPJMRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\RKPRepository::class, \App\Repositories\RKPRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\KegiatanKerjaRepository::class, \App\Repositories\KegiatanKerjaRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\BidangRepository::class, \App\Repositories\BidangRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\AparatDesaRepository::class, \App\Repositories\AparatDesaRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\AdmSuratRepository::class, \App\Repositories\AdmSuratRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\PeraturanDesaRepository::class, \App\Repositories\PeraturanDesaRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\SumberDanaRepository::class, \App\Repositories\SumberDanaRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\LembarBeritaDesaRepository::class, \App\Repositories\LembarBeritaDesaRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\RKKRepository::class, \App\Repositories\RKKRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\ProfilDesaRepository::class, \App\Repositories\ProfilDesaRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\KTPRepository::class, \App\Repositories\KTPRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\SuratMenyuratRepository::class, \App\Repositories\SuratMenyuratRepositoryEloquent::class);

		$this->app->bind(\App\Repositories\InventarisDesaRepository::class, \App\Repositories\InventarisDesaRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\JabatanRepository::class, \App\Repositories\JabatanRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\TanahDesaRepository::class, \App\Repositories\TanahDesaRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\TanahKasDesaRepository::class, \App\Repositories\TanahKasDesaRepositoryEloquent::class);


		$this->app->bind(\App\Repositories\PendapatanRepository::class, \App\Repositories\PendapatanRepositoryEloquent::class);
		$this->app->bind(\App\Repositories\PembiayaanRepository::class, \App\Repositories\PembiayaanRepositoryEloquent::class);

    }
}
