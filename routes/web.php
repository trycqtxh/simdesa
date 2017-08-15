<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'penduduk', 'middleware'=>['auth', 'web']], function(){
    Route::get('rekapitulasi', [
        'as'=>'penduduk.rekapitulasi',
        'uses'=>'PendudukController@rekapitulasi'
    ]);
    Route::get('rekap-excel', [
        'as' => 'rekap.excel',
        'uses' => 'PendudukController@excelRekap'
    ]);
    Route::group(['prefix'=>'kartu-keluarga'], function(){
        Route::get('', [
            'as'=>'penduduk.anggota-keluarga',
            'uses'=>'AnggotaKeluargaController@index'
        ]);
        Route::post('tambah', [
            'as'=>'penduduk.anggota-keluarga.tambah',
            'uses'=>'AnggotaKeluargaController@store'
        ])->middleware(['permission:add-kk-penduduk']);
        Route::get('cari/{id}', [
            'as'=>'penduduk.anggota-keluarga.cari',
            'uses'=>'AnggotaKeluargaController@show'
        ]);
        Route::put('ubah/{id}', [
            'as'=>'penduduk.anggota-keluarga.ubah',
            'uses'=>'AnggotaKeluargaController@update'
        ])->middleware(['permission:edit-kk-penduduk']);
        Route::post('hapus/{id}', [
            'as'=>'penduduk.anggota-keluarga.hapus',
            'uses'=>'AnggotaKeluargaController@destroy'
        ])->middleware(['permission:remove-kk-penduduk']);
        Route::get('excel', [
            'as' => 'penduduk.anggota-keluarga.excel',
            'uses' => 'AnggotaKeluargaController@excel'
        ]);
    });
    Route::group(['prefix'=>'kartu-tanda-penduduk'], function(){
        Route::get('', [
            'as'=>'penduduk.ktp',
            'uses'=>'KTPController@index'
        ]);
        Route::post('tambah', [
            'as'=>'penduduk.ktp.tambah',
            'uses'=>'KTPController@store'
        ]);
        Route::get('cari/{id}', [
            'as'=>'penduduk.ktp.cari',
            'uses'=>'KTPController@show'
        ]);
        Route::get('select-ktp', [
            'as'=>'penduduk.ktp.select-ktp',
            'uses'=>'KTPController@SelectKtp'
        ]);
        Route::get('load-html', function(){
            return view('modal.penduduk.form.select-ktp')->render();
        })->name('penduduk.ktp.html-ktp');
        Route::put('ubah/{id}', [
            'as'=>'penduduk.ktp.ubah',
            'uses'=>'KTPController@update'
        ]);
        Route::post('hapus/{id}', [
            'as'=>'penduduk.ktp.hapus',
            'uses'=>'KTPController@destroy'
        ]);
        Route::get('excel', [
            'as' => 'penduduk.ktp.excel',
            'uses' => 'KTPController@excel'
        ]);
    });
    Route::group(['prefix'=>'induk'], function(){
        Route::get('', [
            'as' => 'induk.index',
            'uses' => 'PendudukIndukController@index'
        ]);
        Route::post('tambah', [
            'as' => 'induk.tambah',
            'uses' => 'PendudukIndukController@store'
        ]);
        Route::get('tambah', function(){
            return view('modal.penduduk.form.tambah-penduduk-induk')->render();
        })->name('induk.tambah.form');
        Route::get('cari/{id}', [
            'as' => 'induk.cari',
            'uses' => 'PendudukIndukController@show'
        ]);
        Route::get('ubah/{id}', function($id){
            return view('modal.penduduk.form.ubah-penduduk-induk', compact('id'))->render();
        })->name('induk.ubah.form');
        Route::put('ubah/{id}', [
            'as' => 'induk.ubah',
            'uses' => 'PendudukIndukController@update'
        ]);
        Route::post('hapus/{id}', [
            'as' => 'induk.hapus',
            'uses' => 'PendudukIndukController@destroy'
        ]);
        Route::get('cari-select/{id}', [
            'as' => 'induk.cari.select',
            'uses' => 'PendudukIndukController@showSelect'
        ]);
        Route::get('excel', [
            'as' => 'induk.excel',
            'uses' => 'PendudukIndukController@excel'
        ]);
        Route::get('select-kk', function(){
            return view('modal.penduduk.form.select-kk')->render();
        })->name('penduduk.induk.select-kk');
        Route::get('select-data-kk', [
            'as' => 'induk.cari.select.kk',
            'uses' => 'PendudukIndukController@SelectKK'
        ]);
        Route::put('ortu-ayah/{id}', [
            'as' => 'induk.ubah.ortu.ayah',
            'uses' => 'PendudukIndukController@ortuAyah'
        ]);
        Route::put('ortu-ibu/{id}', [
            'as' => 'induk.ubah.ortu.ibu',
            'uses' => 'PendudukIndukController@ortuIbu'
        ]);
    });
    Route::group(['prefix'=>'mutasi'], function(){
        Route::get('', [
            'as' => 'mutasi.index',
            'uses' => 'PendudukMutasiController@index'
        ]);
        Route::post('tambah', [
            'as' => 'mutasi.tambah',
            'uses' => 'PendudukMutasiController@store'
        ]);
        Route::put('pindah/{id}', [
            'as' => 'mutasi.pindah',
            'uses' => 'PendudukMutasiController@pindah'
        ]);
        Route::put('mati/{id}', [
            'as' => 'mutasi.mati',
            'uses' => 'PendudukMutasiController@mati'
        ]);
        Route::get('cari/{id}', [
            'as' => 'mutasi.cari',
            'uses' => 'PendudukMutasiController@show'
        ]);
        Route::put('ubah/{id}', [
            'as' => 'mutasi.ubah',
            'uses' => 'PendudukMutasiController@update'
        ]);
        Route::post('hapus/{id}', [
            'as' => 'mutasi.hapus',
            'uses' => 'PendudukMutasiController@destroy'
        ]);
        Route::get('cari-select/{id}', [
            'as' => 'mutasi.cari.select',
            'uses' => 'PendudukMutasiController@showSelect'
        ]);
        Route::get('excel', [
            'as' => 'mutasi.excel',
            'uses' => 'PendudukMutasiController@excel'
        ]);
    });
    Route::group(['prefix'=>'sementara'], function(){
        Route::get('', [
            'as' => 'sementara.index',
            'uses' => 'PendudukSementaraController@index'
        ]);
        Route::post('tambah', [
            'as' => 'sementara.tambah',
            'uses' => 'PendudukSementaraController@store'
        ]);
        Route::get('cari/{id}', [
            'as' => 'sementara.cari',
            'uses' => 'PendudukSementaraController@show'
        ]);
        Route::put('ubah/{id}', [
            'as' => 'sementara.ubah',
            'uses' => 'PendudukSementaraController@update'
        ]);
        Route::post('hapus/{id}', [
            'as' => 'sementara.hapus',
            'uses' => 'PendudukSementaraController@destroy'
        ]);
        Route::get('cari-select/{id}', [
            'as' => 'sementara.cari.select',
            'uses' => 'PendudukSementaraController@showSelect'
        ]);
        Route::get('excel', [
            'as' => 'sementara.excel',
            'uses' => 'PendudukSementaraController@excel'
        ]);
    });

    Route::group(['prefix'=>'grafik'], function(){
        Route::get('pendidikan', [
            'as' => 'grafik.pendidikan',
            'uses' => 'PendudukController@grafikPendidikan'
        ]);
        Route::get('agama', [
            'as' => 'grafik.agama',
            'uses' => 'PendudukController@grafikAgama'
        ]);
        Route::get('pekerjaan', [
            'as' => 'grafik.pekerjaan',
            'uses' => 'PendudukController@grafikPekerjaan'
        ]);
        Route::get('kelompok-umur', [
            'as' => 'grafik.kelompok-umur',
            'uses' => 'PendudukController@grafikKelompokUmur'
        ]);
        Route::get('dusun', [
            'as' => 'grafik.dusun',
            'uses' => 'PendudukController@grafikDusun'
        ]);
        Route::get('status-perkawinan', [
            'as' => 'grafik.status-perkawinan',
            'uses' => 'PendudukController@grafikStatusPerkawinan'
        ]);
        Route::get('kewarganegaraan', [
            'as' => 'grafik.kewarganegaraan',
            'uses' => 'PendudukController@grafikKewarganegaraan'
        ]);
        Route::get('status-keluarga', [
            'as' => 'grafik.status-keluarga',
            'uses' => 'PendudukController@grafikStatusKeluarga'
        ]);
    });

    Route::group(['prefix'=>''], function(){
        Route::get('usia-balita', [
            'as' => 'kelompok.balita',
            'uses' => 'PendudukController@balita',
        ]);
        Route::get('wajib-belajar', [
            'as' => 'kelompok.belajar',
            'uses' => 'PendudukController@belajar',
        ]);
        Route::get('pemilih-pemilu', [
            'as' => 'kelompok.pemilu',
            'uses' => 'PendudukController@pemilu',
        ]);
    });
});

Route::group(['prefix'=>'master', 'middleware'=>['auth', 'web']], function(){
    Route::group(['prefix'=>'rt'], function(){
        Route::get('', [
            'as' => 'rt.index',
            'uses' => 'RTController@index'
        ]);
        Route::post('tambah', [
            'as' => 'rt.tambah',
            'uses' => 'RTController@store'
        ])->middleware(['permission:add-rt-master']);
        Route::get('cari/{id}', [
            'as' => 'rt.cari',
            'uses' => 'RTController@show'
        ]);
        Route::put('ubah/{id}', [
            'as' => 'rt.ubah',
            'uses' => 'RTController@update'
        ])->middleware(['permission:edit-rt-master']);
        Route::post('hapus/{id}', [
            'as' => 'rt.hapus',
            'uses' => 'RTController@destroy'
        ])->middleware(['permission:remove-rt-master']);
        Route::get('cari-select/{id}', [
            'as' => 'rt.cari.select',
            'uses' => 'RTController@showSelect'
        ]);
    });
    Route::group(['prefix'=>'rw'], function(){
        Route::get('', [
            'as' => 'rw.index',
            'uses' => 'RWController@index'
        ]);
        Route::post('tambah', [
            'as' => 'rw.tambah',
            'uses' => 'RWController@store'
        ])->middleware(['permission:add-rw-master']);
        Route::get('cari/{id}', [
            'as' => 'rw.cari',
            'uses' => 'RWController@show'
        ]);
        Route::put('ubah/{id}', [
            'as' => 'rw.ubah',
            'uses' => 'RWController@update'
        ])->middleware(['permission:edit-rw-master']);
        Route::post('hapus/{id}', [
            'as' => 'rw.hapus',
            'uses' => 'RWController@destroy'
        ])->middleware(['permission:remove-rw-master']);
        Route::get('cari-select/{id}', [
            'as' => 'rw.cari.select',
            'uses' => 'RWController@showSelect'
        ]);
    });
    Route::group(['prefix'=>'status-keluarga'], function(){
        Route::get('', [
            'as' => 'keluarga.index',
            'uses' => 'StatusKeluargaController@index'
        ]);
        Route::post('tambah', [
            'as' => 'keluarga.tambah',
            'uses' => 'StatusKeluargaController@store'
        ]);
        Route::get('cari/{id}', [
            'as' => 'keluarga.cari',
            'uses' => 'StatusKeluargaController@show'
        ]);
        Route::put('ubah/{id}', [
            'as' => 'keluarga.ubah',
            'uses' => 'StatusKeluargaController@update'
        ]);
        Route::post('hapus/{id}', [
            'as' => 'keluarga.hapus',
            'uses' => 'StatusKeluargaController@destroy'
        ]);
        Route::get('cari-select/{id}', [
            'as' => 'keluarga.cari.select',
            'uses' => 'StatusKeluargaController@showSelect'
        ]);
    });
    Route::group(['prefix'=>'jabatan'], function(){
        Route::get('', [
            'as' => 'jabatan.index',
            'uses' => 'JabatanController@index'
        ]);
        Route::post('tambah', [
            'as' => 'jabatan.tambah',
            'uses' => 'JabatanController@store'
        ])->middleware(['permission:add-jabatan-master']);
        Route::get('cari/{id}', [
            'as' => 'jabatan.cari',
            'uses' => 'JabatanController@show'
        ]);
        Route::put('ubah/{id}', [
            'as' => 'jabatan.ubah',
            'uses' => 'JabatanController@update'
        ])->middleware(['permission:edit-jabatan-master']);
        Route::post('hapus/{id}', [
            'as' => 'jabatan.hapus',
            'uses' => 'JabatanController@destroy'
        ])->middleware(['permission:remove-jabatan-master']);
        Route::get('cari-select/{id}', [
            'as' => 'jabatan.cari.select',
            'uses' => 'JabatanController@showSelect'
        ]);
    });
    Route::group(['prefix'=>'pekerjaan'], function(){
        Route::get('', [
            'as' => 'pekerjaan.index',
            'uses' => 'PekerjaanController@index'
        ]);
        Route::post('tambah', [
            'as' => 'pekerjaan.tambah',
            'uses' => 'PekerjaanController@store'
        ])->middleware(['permission:add-pekerjaan-master']);
        Route::get('cari/{id}', [
            'as' => 'pekerjaan.cari',
            'uses' => 'PekerjaanController@show'
        ]);
        Route::put('ubah/{id}', [
            'as' => 'pekerjaan.ubah',
            'uses' => 'PekerjaanController@update'
        ])->middleware(['permission:edit-pekerjaan-master']);
        Route::post('hapus/{id}', [
            'as' => 'pekerjaan.hapus',
            'uses' => 'PekerjaanController@destroy'
        ])->middleware(['permission:remove-pekerjaan-master']);
        Route::get('cari-select/{id}', [
            'as' => 'pekerjaan.cari.select',
            'uses' => 'PekerjaanController@showSelect'
        ]);
    });
});

Route::group(['prefix'=>'perencanaan', 'middleware'=>['auth', 'web']], function(){
    Route::group(['prefix'=>'rpjm'], function(){
        Route::post('', [
            'as' => 'rpjm.tambahRpjm',
            'uses' => 'RPJMController@tambahRpjm'
        ]);
        Route::get('', [
            'as' => 'rpjm.index',
            'uses' => 'RPJMController@index',
        ]);
        Route::post('tambah', [
            'as' => 'rpjm.tambah',
            'uses' => 'RPJMController@store'
        ]);
        Route::put('ubah/{id}', [
            'as' => 'rpjm.ubah',
            'uses' => 'RPJMController@update'
        ]);
        Route::post('hapus/{id}', [
            'as' => 'rpjm.hapus',
            'uses' => 'RPJMController@delete'
        ]);
        Route::get('cari/{id}', [
            'as' => 'rpjm.cari',
            'uses' => 'RPJMController@show'
        ]);
        Route::get('cari-select/{id}', [
            'as' => 'rpjm.cari',
            'uses' => 'RPJMController@showSelect'
        ]);
        Route::get('excel', [
            'as' => 'rpjm.excel',
            'uses' => 'RPJMController@excel'
        ]);
    });
    Route::group(['prefix'=>'kegiatan', ], function(){
        Route::get('', [
            'as' => 'kegiatan.index',
            'uses' => 'KegiatanKerjaController@index'
        ]);
        Route::post('tambah/{jenis}', [
            'as' => 'kegiatan.tambah',
            'uses' => 'KegiatanKerjaController@store'
        ]);
        Route::put('ubah/{jenis}/{id}', [
            'as' => 'kegiatan.ubah',
            'uses' => 'KegiatanKerjaController@update'
        ]);
        Route::post('hapus/{id}', [
            'as' => 'kegiatan.hapus',
            'uses' => 'KegiatanKerjaController@destroy'
        ]);
        Route::get('cari/{jenis}/{id}', [
            'as' => 'kegiatan.cari',
            'uses' => 'KegiatanKerjaController@show'
        ]);
        Route::get('cari-select/{id}', [
            'as' => 'kegiatan.cari.select',
            'uses' => 'KegiatanKerjaController@showSelect'
        ]);
    });
    Route::group(['prefix'=>'rkp'], function(){
        Route::get('/{id}', [
            'as' => 'rkp.index',
            'uses' => 'RKPController@index'
        ]);
        Route::post('tambah', [
            'as' => 'rkp.tambah',
            'uses' => 'RKPController@store'
        ]);
        Route::put('ubah/{id}', [
            'as' => 'rkp.ubah',
            'uses' => 'RKPController@update'
        ]);
        Route::post('hapus/{id}', [
            'as' => 'rkp.hapus',
            'uses' => 'RKPController@destroy'
        ]);
        Route::get('cari/{id}', [
            'as' => 'rkp.cari',
            'uses' => 'RKPController@show'
        ]);
        Route::get('cari-select/{id}', [
            'as' => 'rkp.cari.select',
            'uses' => 'RKPController@showSelect'
        ]);
        Route::get('excel/{id}', [
            'as' => 'rkp.excel',
            'uses' => 'RKPController@excel'
        ]);
    });
    Route::group(['prefix'=>'rkk'], function(){
        Route::get('/{id}', [
            'as' => 'rkk.index',
            'uses' => 'RKKController@index'
        ]);
        Route::post('tambah', [
            'as' => 'rkk.tambah',
            'uses' => 'RKKController@store'
        ]);
        Route::put('ubah/{id}', [
            'as' => 'rkk.ubah',
            'uses' => 'RKKController@update'
        ]);
        Route::post('hapus/{id}', [
            'as' => 'rkk.hapus',
            'uses' => 'RKKController@destroy'
        ]);
        Route::get('cari/{id}', [
            'as' => 'rkk.cari',
            'uses' => 'RKKController@show'
        ]);
        Route::get('cari-select/{id}', [
            'as' => 'rkk.cari.select',
            'uses' => 'RKKController@showSelect'
        ]);
        Route::get('excel/{id}', [
            'as' => 'rkk.excel',
            'uses' => 'RKKController@excel'
        ]);
    });

    Route::group(['prefix'=>'pendapatan'], function(){
        Route::get('', [
            'as' => 'pendapatan.index',
            'uses' => 'PerencanaanPendapatanController@index',
        ]);
        Route::post('tambah/{jenis}', [
            'as' => 'pendapatan.tambah',
            'uses' => 'PerencanaanPendapatanController@store'
        ])->middleware(['permission:add-pendapatan-perencanaan']);
        Route::put('ubah/{jenis}/{id}', [
            'as' => 'pendapatan.ubah',
            'uses' => 'PerencanaanPendapatanController@update'
        ])->middleware(['permission:edit-pendapatan-perencanaan']);
        Route::post('hapus/{id}', [
            'as' => 'pendapatan.hapus',
            'uses' => 'PerencanaanPendapatanController@destroy'
        ])->middleware(['permission:remove-pendapatan-perencanaan']);
        Route::get('cari/{id}', [
            'as' => 'pendapatan.cari',
            'uses' => 'PerencanaanPendapatanController@show'
        ]);
    });

    Route::group(['prefix'=>'belanja'], function(){
        Route::get('', [
            'as' => 'belanja.index',
            'uses' => 'RKPController@belanja',
        ]);
        Route::get('anggaran', [
            'as' => 'belanja.anggaran',
            'uses' => 'RKPController@anggaran',
        ]);
        Route::get('load-html/{id}', function($id){
            return view('content.perencanaan.html_anggaran', compact('id'))->render();
        })->name('anggaran-table');
    });

    Route::group(['prefix'=>'pembiayaan'], function(){
        Route::get('', [
            'as' => 'pembiayaan.index',
            'uses' => 'PerencanaanPembiayaanController@index',
        ]);
        Route::post('tambah/{jenis}', [
            'as' => 'pembiayaan.tambah',
            'uses' => 'PerencanaanPembiayaanController@store'
        ])->middleware(['permission:add-pembiayaan-perencanaan']);
        Route::put('ubah/{jenis}/{id}', [
            'as' => 'pembiayaan.ubah',
            'uses' => 'PerencanaanPembiayaanController@update'
        ])->middleware(['permission:edit-pembiayaan-perencanaan']);
        Route::post('hapus/{id}', [
            'as' => 'pembiayaan.hapus',
            'uses' => 'PerencanaanPembiayaanController@destroy'
        ])->middleware(['permission:remove-pembiayaan-perencanaan']);
        Route::get('cari/{id}', [
            'as' => 'pembiayaan.cari',
            'uses' => 'PerencanaanPembiayaanController@show'
        ]);
    });

    Route::get('apbd', [
        'as' => 'apbd.perencanaan',
        'uses' => 'APBDController@perencanaan'
    ]);
    Route::get('apbd-excel', [
        'as' => 'apbd.perencanaan.excel',
        'uses' => 'APBDController@perencanaanExcel'
    ]);
});

Route::group(['prefix'=>'pelaksanaan', 'as'=>'pelaksanaan.', 'middleware'=>['auth', 'web']], function(){
    Route::group(['prefix'=>'apbd', 'as'=>'apbd.'], function(){
        Route::get('', [
            'as'   => 'index',
            'uses' => 'APBDController@pelaksanaan'
        ]);
        Route::get('apbd-excel', [
            'as' => 'excel',
            'uses' => 'APBDController@pelaksanaanExcel'
        ]);
        Route::group(['prefix'=>'pendapatan', 'as'=>'pendapatan.'], function(){
            Route::get('', [
                'as' => 'index',
                'uses' => 'RealisasiPendapatanController@index'
            ]);
            Route::get('bidang/{id}', [
                'as' => 'bidang',
                'uses' => 'RealisasiPendapatanController@bidang'
            ]);
            Route::get('sub-bidang/{id}', [
                'as' => 'subbidang',
                'uses' => 'RealisasiPendapatanController@subbidang'
            ]);
            Route::get('kegiatan/{id}', [
                'as' => 'kegiatan',
                'uses' => 'RealisasiPendapatanController@kegiatan'
            ]);
            Route::post('tambah', [
                'as' => 'tambah',
                'uses' => 'RealisasiPendapatanController@store'
            ])->middleware(['permission:add-pendapatan-pelaksanaan']);
            Route::get('cari/{id}', [
                'as' => 'cari',
                'uses' => 'RealisasiPendapatanController@show'
            ]);
            Route::put('ubah/{id}', [
                'as' => 'ubah',
                'uses' => 'RealisasiPendapatanController@update'
            ])->middleware(['permission:edit-pendapatan-pelaksanaan']);
            Route::post('hapus/{id}', [
                'as' => 'hapus',
                'uses' => 'RealisasiPendapatanController@destroy'
            ])->middleware(['permission:remove-pendapatan-pelaksanaan']);
        });
        Route::group(['prefix'=>'belanja', 'as'=>'belanja.'], function(){
            Route::get('', [
                'as' => 'index',
                'uses' => 'RealisasiBelanjaController@index'
            ]);
            Route::get('subkegiatan/{id}', [
                'as' => 'subkegiatan',
                'uses' => 'RealisasiBelanjaController@subkegiatan'
            ]);
            Route::get('kegiatan/{id}', [
                'as' => 'kegiatan',
                'uses' => 'RealisasiBelanjaController@kegiatan'
            ]);
            Route::get('subbidang/{id}', [
                'as' => 'subbidang',
                'uses' => 'RealisasiBelanjaController@subbidang'
            ]);
            Route::get('bidang/{id}', [
                'as' => 'bidang',
                'uses' => 'RealisasiBelanjaController@bidang'
            ]);
            Route::post('tambah', [
                'as' => 'tambah',
                'uses' => 'RealisasiBelanjaController@store'
            ])->middleware(['permission:add-belanja-pelaksanaan']);
            Route::get('cari/{id}', [
                'as' => 'cari',
                'uses' => 'RealisasiBelanjaController@show'
            ]);
            Route::put('ubah/{id}', [
                'as' => 'ubah',
                'uses' => 'RealisasiBelanjaController@update'
            ])->middleware(['permission:edit-belanja-pelaksanaan']);
            Route::post('hapus/{id}', [
                'as' => 'hapus',
                'uses' => 'RealisasiBelanjaController@destroy'
            ])->middleware(['permission:remove-belanja-pelaksanaan']);
        });
        Route::group(['prefix'=>'pembiayaan', 'as'=>'pembiayaan.'], function(){
            Route::get('', [
                'as' => 'index',
                'uses' => 'RealisasiPembiayaanController@index'
            ]);
            Route::get('bidang/{id}', [
                'as' => 'bidang',
                'uses' => 'RealisasiPembiayaanController@bidang'
            ]);
            Route::get('kegiatan/{id}', [
                'as' => 'kegiatan',
                'uses' => 'RealisasiPembiayaanController@kegiatan'
            ]);
            Route::post('tambah', [
                'as' => 'tambah',
                'uses' => 'RealisasiPembiayaanController@store'
            ])->middleware(['permission:add-pembiayaan-pelaksanaan']);
            Route::get('cari/{id}', [
                'as' => 'cari',
                'uses' => 'RealisasiPembiayaanController@show'
            ]);
            Route::put('ubah/{id}', [
                'as' => 'ubah',
                'uses' => 'RealisasiPembiayaanController@update'
            ])->middleware(['permission:edit-pembiayaan-pelaksanaan']);
            Route::post('hapus/{id}', [
                'as' => 'hapus',
                'uses' => 'RealisasiPembiayaanController@destroy'
            ])->middleware(['permission:remove-pembiayaan-pelaksanaan']);
        });
    });
});

Route::group(['prefix'=>'umum', 'middleware'=>['auth', 'web']], function(){
    Route::group(['prefix'=>'adm-surat'],function(){
        Route::get('agenda', [
            'as' => 'adm-surat.index.agenda',
            'uses' => 'AdmSuratController@index_agenda'
        ]);
        Route::get('ekspedisi', [
            'as' => 'adm-surat.index.ekspedisi',
            'uses' => 'AdmSuratController@index_ekpedisi'
        ]);
        Route::post('tambah/{jenis}', [
            'as' => 'adm-surat.tambah',
            'uses' => 'AdmSuratController@store'
        ]);
        Route::put('ubah/{jenis}/{id}', [
            'as' => 'adm-surat.ubah',
            'uses' => 'AdmSuratController@update'
        ]);
        Route::post('hapus/{id}', [
            'as' => 'adm-surat.hapus',
            'uses' => 'AdmSuratController@destroy'
        ]);
        Route::get('cari/{id}', [
            'as' => 'adm-surat.cari',
            'uses' => 'AdmSuratController@show'
        ]);
        Route::get('agenda-excel', [
            'as' => 'agenda.excel',
            'uses' => 'AdmSuratController@AgendaExcel'
        ]);
        Route::get('ekspedisi-excel', [
            'as' => 'ekspedisi.excel',
            'uses' => 'AdmSuratController@ExpedisiExcel'
        ]);
    });

    Route::group(['prefix'=>'peraturan-desa'],function(){
        Route::get('', [
            'as' => 'peraturan-desa.index',
            'uses' => 'PeraturanDesaController@index'
        ]);
        Route::post('tambah', [
            'as' => 'peraturan-desa.tambah',
            'uses' => 'PeraturanDesaController@store'
        ])->middleware(['permission:add-peraturan-umum']);
        Route::put('ubah/{id}', [
            'as' => 'peraturan-desa.ubah',
            'uses' => 'PeraturanDesaController@update'
        ])->middleware(['permission:edit-peraturan-umum']);
        Route::post('hapus/{id}', [
            'as' => 'peraturan-desa.hapus',
            'uses' => 'PeraturanDesaController@destroy'
        ])->middleware(['permission:remove-peraturan-umum']);
        Route::get('cari/{id}', [
            'as' => 'peraturan-desa.cari',
            'uses' => 'PeraturanDesaController@show'
        ]);
        Route::get('peraturan-excel', [
            'as' => 'peraturan.excel',
            'uses' => 'PeraturanDesaController@PeraturanExcel'
        ]);
    });
    Route::group(['prefix'=>'keputusan-kades'],function(){
        Route::get('', [
            'as' => 'keputusan-kades.index',
            'uses' => 'KeputusanKepalaDesaController@index'
        ]);
        Route::post('tambah', [
            'as' => 'keputusan-kades.tambah',
            'uses' => 'KeputusanKepalaDesaController@store'
        ])->middleware(['permission:add-peraturan-umum']);
        Route::put('ubah/{id}', [
            'as' => 'keputusan-kades.ubah',
            'uses' => 'KeputusanKepalaDesaController@update'
        ])->middleware(['permission:edit-peraturan-umum']);
        Route::post('hapus/{id}', [
            'as' => 'keputusan-kades.hapus',
            'uses' => 'KeputusanKepalaDesaController@destroy'
        ])->middleware(['permission:remove-peraturan-umum']);
        Route::get('cari/{id}', [
            'as' => 'keputusan-kades.cari',
            'uses' => 'KeputusanKepalaDesaController@show'
        ]);
        Route::get('keputusan-excel', [
            'as' => 'keputusan.excel',
            'uses' => 'KeputusanKepalaDesaController@KeputusanExcel'
        ]);
    });
    Route::group(['prefix'=>'lembar-berita', 'as'=>'lembar-berita.'],function(){
        Route::get('', [
            'as' => 'index',
            'uses' => 'LembarBeritaDesaController@index'
        ]);
        Route::post('tambah', [
            'as' => 'tambah',
            'uses' => 'LembarBeritaDesaController@store'
        ])->middleware(['permission:add-lembar-berita-umum']);
        Route::put('ubah/{id}', [
            'as' => 'ubah',
            'uses' => 'LembarBeritaDesaController@update'
        ])->middleware(['permission:edit-lembar-berita-umum']);
        Route::post('hapus/{id}', [
            'as' => 'hapus',
            'uses' => 'LembarBeritaDesaController@destroy'
        ])->middleware(['permission:remove-lembar-berita-umum']);
        Route::get('cari/{id}', [
            'as' => 'cari',
            'uses' => 'LembarBeritaDesaController@show'
        ]);
        Route::get('lembar-excel', [
            'as' => 'lembar.excel',
            'uses' => 'LembarBeritaDesaController@LembarExcel'
        ]);
    });

    Route::group(['prefix'=>'aparat-pemerintah'],function(){
        Route::get('', [
            'as' => 'aparat-pemerintah.index',
            'uses' => 'AparatDesaController@index'
        ]);
        Route::post('tambah', [
            'as' => 'aparat-pemerintah.tambah',
            'uses' => 'AparatDesaController@store'
        ])->middleware(['permission:add-aparat-umum']);
        Route::put('ubah/{id}', [
            'as' => 'aparat-pemerintah.ubah',
            'uses' => 'AparatDesaController@update'
        ])->middleware(['permission:edit-aparat-umum']);
        Route::post('hapus/{id}', [
            'as' => 'aparat-pemerintah.hapus',
            'uses' => 'AparatDesaController@destroy'
        ])->middleware(['permission:remove-aparat-umum']);
        Route::get('cari/{id}', [
            'as' => 'aparat-pemerintah.cari',
            'uses' => 'AparatDesaController@show'
        ]);
        Route::get('excel', [
            'as' => 'aparat-pemerintah.excel',
            'uses' => 'AparatDesaController@excel'
        ]);
    });

    Route::group(['prefix'=>'inventaris-kekayaan'],function(){
        Route::get('', [
            'as' => 'inventaris-kekayaan.index',
            'uses' => 'InventarisDesaController@index'
        ]);
        Route::post('tambah', [
            'as' => 'inventaris-kekayaan.tambah',
            'uses' => 'InventarisDesaController@store'
        ])->middleware(['permission:add-inventaris-umum']);
        Route::put('ubah/{id}', [
            'as' => 'inventaris-kekayaan.hapus',
            'uses' => 'InventarisDesaController@update'
        ])->middleware(['permission:edit-inventaris-umum']);
        Route::post('hapus/{id}', [
            'as' => 'inventaris-kekayaan.hapus',
            'uses' => 'InventarisDesaController@destroy'
        ])->middleware(['permission:remove-inventaris-umum']);
        Route::get('cari/{id}', [
            'as' => 'inventaris-kekayaan.cari',
            'uses' => 'InventarisDesaController@show'
        ]);
    });

    Route::group(['prefix'=>'tanah-desa'],function(){
        Route::get('', [
            'as' => 'tanah-desa.index',
            'uses' => 'TanahDesaController@index'
        ]);
        Route::post('tambah', [
            'as' => 'tanah-desa.tambah',
            'uses' => 'TanahDesaController@store'
        ])->middleware(['permission:add-tanah-desa-umum']);
        Route::put('ubah/{id}', [
            'as' => 'tanah-desa.ubah',
            'uses' => 'TanahDesaController@update'
        ])->middleware(['permission:edit-tanah-desa-umum']);
        Route::post('hapus/{id}', [
            'as' => 'tanah-desa.hapus',
            'uses' => 'TanahDesaController@destroy'
        ])->middleware(['permission:remove-tanah-desa-umum']);
        Route::get('cari/{id}', [
            'as' => 'tanah-desa.cari',
            'uses' => 'TanahDesaController@show'
        ]);
        Route::get('excel', [
            'as' => 'tanah-desa.excel',
            'uses' => 'TanahDesaController@excel'
        ]);
    });
    Route::group(['prefix'=>'tanah-kas'],function(){
        Route::get('', [
            'as' => 'tanah-kas.index',
            'uses' => 'TanahKasDesaController@index'
        ]);
        Route::post('tambah', [
            'as' => 'tanah-kas.tambah',
            'uses' => 'TanahKasDesaController@store'
        ])->middleware(['permission:add-tanah-kas-umum']);
        Route::put('ubah/{id}', [
            'as' => 'tanah-kas.ubah',
            'uses' => 'TanahKasDesaController@update'
        ])->middleware(['permission:edit-tanah-kas-umum']);
        Route::post('hapus/{id}', [
            'as' => 'tanah-kas.hapus',
            'uses' => 'TanahKasDesaController@destroy'
        ])->middleware(['permission:remove-tanah-kas-umum']);
        Route::get('cari/{id}', [
            'as' => 'tanah-kas.cari',
            'uses' => 'TanahKasDesaController@show'
        ]);
        Route::get('excel', [
            'as' => 'tanah-kas-desa.excel',
            'uses' => 'TanahKasDesaController@excel'
        ]);
    });
    
});

Route::group(['prefix'=>'pembangunan'], function(){
    Route::get('inventaris',function(){
        return view('content.pembangunan.inventaris');
    })->name('pembangunan.inventaris');
    Route::get('kegiatan-pembangunan',function(){
        return view('content.pembangunan.kegiatan_pembangunan');
    })->name('pembangunan.kegiatan-pembangunan');
    Route::get('pemberdayaan-masyarakat',function(){
        return view('content.pembangunan.pemberdayaan_masyarakat');
    })->name('pembangunan.pemberdayaan-masyarakat');
    Route::get('rencana-kerja',function(){
        return view('content.pembangunan.rencana_kerja');
    })->name('pembangunan.rencana-kerja');
});

Route::group(['prefix'=>'profil-desa', 'middleware'=>['auth', 'web']], function(){
    Route::get('', [
        'as' => 'profil.desa',
        'uses' => 'ProfilDesaController@index',
        'middleware' => 'permission:edit-profil-desa'
    ]);
    Route::get('wilayah', [
        'as' => 'profil.desa.wilayah',
        'uses' => 'ProfilDesaController@wilayah'
    ]);
    Route::get('lokasi', [
        'as' => 'profil.desa.lokasi',
        'uses' => 'ProfilDesaController@lokasi'
    ]);
    Route::get('statistik', [
        'as' => 'profil.desa.statistik',
        'uses' => 'ProfilDesaController@statistik'
    ]);
    Route::put('ubah/{kode}', [
        'as' => 'profil.desa.ubah',
        'uses' => 'ProfilDesaController@update'
    ])->middleware(['permission:edit-profil-desa']);

    Route::post('logo', [
        'as' => 'profil.desa.logo',
        'uses' => 'ProfilDesaController@logoUpdate'
    ])->middleware(['permission:edit-profil-desa']);

    Route::get('slider', [
        'as' => 'profil.slider',
        'uses' => 'ProfilDesaController@slider'
    ]);
    Route::post('slider-store', [
        'as' => 'profil.slider.store',
        'uses' => 'ProfilDesaController@sliderStore'
    ])->middleware(['permission:edit-profil-desa']);
    Route::post('slider-update/{id}', [
        'as' => 'profil.slider.update',
        'uses' => 'ProfilDesaController@sliderUpdate'
    ])->middleware(['permission:edit-profil-desa']);
    Route::post('slider-destroy/{id}', [
        'as' => 'profil.slider.destroy',
        'uses' => 'ProfilDesaController@sliderDestroy'
    ])->middleware(['permission:edit-profil-desa']);

    Route::get('regulasi-desa', function(){
        return view('content.regulasi_desa');
    })->name('regulasi.desa');
});

Route::group(['prefix'=>'hak-akses', 'middleware'=>['web', 'auth']], function(){
    Route::get('', [
        'as' => 'hak-akses',
        'uses' => 'HakAksesController@index'
    ])->middleware(['permission:select-akses-master']);
    Route::get('aparat', [
        'as' => 'hak-akses.aparat',
        'uses' => 'HakAksesController@users'
    ])->middleware(['permission:select-akses-master']);
    Route::get('roles', [
        'as' => 'hak-akses.roles',
        'uses' => 'HakAksesController@roles'
    ])->middleware(['permission:select-akses-master']);
    Route::get('permision', [
        'as' => 'hak-akses.permision',
        'uses' => 'HakAksesController@permision'
    ])->middleware(['permission:select-akses-master']);
    Route::post('permision-tambah', [
        'as' => 'hak-akses.tambah',
        'uses' => 'HakAksesController@store'
    ])->middleware(['permission:add-akses-master']);
    Route::post('permision-ubah/{id}', [
        'as' => 'hak-akses.ubah',
        'uses' => 'HakAksesController@update'
    ])->middleware(['permission:edit-akses-master']);
    Route::post('permision-hapus/{id}', [
        'as' => 'hak-akses.hapus',
        'uses' => 'HakAksesController@destroy'
    ])->middleware(['permission:remove-akses-master']);
    Route::post('users-tambah', [
        'as' => 'hak-akses.users.tambah',
        'uses' => 'HakAksesController@storeUsers'
    ])->middleware(['permission:add-akses-master']);
    Route::post('users-ubah/{id}', [
        'as' => 'hak-akses.users.ubah',
        'uses' => 'HakAksesController@updateUsers'
    ])->middleware(['permission:edit-akses-master']);
    Route::post('users-hapus/{id}', [
        'as' => 'hak-akses.users.hapus',
        'uses' => 'HakAksesController@destroyUsers'
    ])->middleware(['permission:remove-akses-master']);
    Route::get('load-html-tambah-users', function(){
        return view('form.users')->render();
    })->name('hak-akses.load.tambah-users');
    Route::get('load-html-ubah-users/{id}', function($id){
        return view('form.ubah-users', compact('id'))->render();
    })->name('hak-akses.load.ubah-users');
    Route::get('load-html-tambah', function(){
        return view('form.hak-akses')->render();
    })->name('hak-akses.load.tambah');
    Route::get('load-html-ubah/{id}', function($id){
        return view('form.ubah-hak-akses', compact('id'))->render();
    })->name('hak-akses.load.ubah');
    Route::get('select-role', [
        'as' => 'select.role',
        'uses' => 'HakAksesController@selectRole'
    ]);
});

Route::group(['middleware'=>['web']], function(){
    Route::get('', [
        'as' => 'login',
        'uses' => 'AuthController@index'
    ]);
    Route::post('login', [
        'as' => 'login.post',
        'uses' => 'AuthController@prosesLogin'
    ]);
    Route::get('logout', [
        'as' => 'logout',
        'uses' => 'AuthController@logout'
    ]);
});

Route::group(['prefix'=>'surat-menyurat', 'as'=>'surat.'], function(){
    Route::get('', [
        'as' => 'index',
        'uses' => 'SuratMenyuratController@index'
    ]);
    Route::get('load/{jenis}', [
        'as' => 'load',
        'uses' => 'SuratMenyuratController@loadSurat'
    ]);
    Route::get('surat-kehilangan', [
        'as' => 'kehilangan',
        'uses' => 'SuratMenyuratController@surat_kehilangan'
    ]);
    Route::get('penduduk', [
        'as' => 'penduduk',
        'uses' => 'SuratMenyuratController@penduduk'
    ]);
    Route::get('penduduk-meninggal', [
        'as' => 'penduduk-meninggal',
        'uses' => 'SuratMenyuratController@pendudukMeninggal'
    ]);
    Route::post('save-surat/{jenis}', [
        'as' => 'save',
        'uses' => 'SuratMenyuratController@save_surat'
    ]);
    Route::get('download/{path}', [
        'as' => 'download',
        'uses' => 'SuratMenyuratController@download_surat'
    ]);
});

Route::get('print', [
    'uses' => 'PendudukIndukController@print_data'
]);