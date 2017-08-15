<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permision = new Permission();
        $akses = [
            ['name'=>'edit-profil-desa', 'tampilan'=> 'Ubah','display_name'=>'master_profil', 'description'=>'master'],
            ['name'=>'select-profil-desa', 'tampilan'=> 'Lihat','display_name'=>'master_profil', 'description'=>'master'],

            ['name'=>'select-rw-master', 'tampilan'=> 'Lihat', 'display_name'=>'master_rw', 'description'=>'master'],
            ['name'=>'add-rw-master', 'tampilan'=> 'Tambah', 'display_name'=>'master_rw', 'description'=>'master'],
            ['name'=>'edit-rw-master', 'tampilan'=> 'Ubah', 'display_name'=>'master_rw', 'description'=>'master'],
            ['name'=>'remove-rw-master', 'tampilan'=> 'Hapus', 'display_name'=>'master_rw', 'description'=>'master'],

            ['name'=>'select-rt-master', 'tampilan'=> 'Lihat', 'display_name'=>'master_rt', 'description'=>'master'],
            ['name'=>'add-rt-master', 'tampilan'=> 'Tambah', 'display_name'=>'master_rt', 'description'=>'master'],
            ['name'=>'edit-rt-master', 'tampilan'=> 'Ubah', 'display_name'=>'master_rt', 'description'=>'master'],
            ['name'=>'remove-rt-master', 'tampilan'=> 'Hapus', 'display_name'=>'master_rt', 'description'=>'master'],

            ['name'=>'select-keluarga-master', 'tampilan'=> 'Lihat', 'display_name'=>'master_keluarga', 'description'=>'master'],
            ['name'=>'add-keluarga-master', 'tampilan'=> 'Tambah', 'display_name'=>'master_keluarga', 'description'=>'master'],
            ['name'=>'edit-keluarga-master', 'tampilan'=> 'Ubah', 'display_name'=>'master_keluarga', 'description'=>'master'],
            ['name'=>'remove-keluarga-master', 'tampilan'=> 'Hapus', 'display_name'=>'master_keluarga', 'description'=>'master'],

            ['name'=>'select-jabatan-master', 'tampilan'=> 'Lihat', 'display_name'=>'master_jabatan', 'description'=>'master'],
            ['name'=>'add-jabatan-master', 'tampilan'=> 'Tambah', 'display_name'=>'master_jabatan', 'description'=>'master'],
            ['name'=>'edit-jabatan-master', 'tampilan'=> 'Ubah', 'display_name'=>'master_jabatan', 'description'=>'master'],
            ['name'=>'remove-jabatan-master', 'tampilan'=> 'Hapus', 'display_name'=>'master_jabatan', 'description'=>'master'],

            ['name'=>'select-pekerjaan-master', 'tampilan'=> 'Lihat', 'display_name'=>'master_pekerjaan', 'description'=>'master'],
            ['name'=>'add-pekerjaan-master', 'tampilan'=> 'Tambah', 'display_name'=>'master_pekerjaan', 'description'=>'master'],
            ['name'=>'edit-pekerjaan-master', 'tampilan'=> 'Ubah', 'display_name'=>'master_pekerjaan', 'description'=>'master'],
            ['name'=>'remove-pekerjaan-master', 'tampilan'=> 'Hapus', 'display_name'=>'master_pekerjaan', 'description'=>'master'],

            ['name'=>'buat-surat-master', 'tampilan'=> 'Surat', 'display_name'=>'master_surat', 'description'=>'master'],

            ['name'=>'select-akses-master', 'tampilan'=> 'Lihat', 'display_name'=>'master_akses', 'description'=>'master'],
            ['name'=>'add-akses-master', 'tampilan'=> 'Tambah', 'display_name'=>'master_akses', 'description'=>'master'],
            ['name'=>'edit-akses-master', 'tampilan'=> 'Ubah', 'display_name'=>'master_akses', 'description'=>'master'],
            ['name'=>'remove-akses-master', 'tampilan'=> 'Hapus', 'display_name'=>'master_akses', 'description'=>'master'],

            ['name'=>'select-induk-penduduk', 'tampilan'=> 'Lihat', 'display_name'=>'penduduk_induk', 'description'=>'penduduk'],
            ['name'=>'add-induk-penduduk', 'tampilan'=> 'Tambah', 'display_name'=>'penduduk_induk', 'description'=>'penduduk'],
            ['name'=>'edit-induk-penduduk', 'tampilan'=> 'Ubah', 'display_name'=>'penduduk_induk', 'description'=>'penduduk'],
            ['name'=>'export-induk-penduduk', 'tampilan'=> 'Eksport', 'display_name'=>'penduduk_induk', 'description'=>'penduduk'],
            ['name'=>'remove-induk-penduduk', 'tampilan'=> 'Hapus', 'display_name'=>'penduduk_induk', 'description'=>'penduduk'],

            ['name'=>'add-pindah-mutasi-penduduk', 'tampilan'=> 'Tambah Mutasi Pindah', 'display_name'=>'penduduk_mutasi', 'description'=>'penduduk'],
            ['name'=>'add-meninggal-mutasi-penduduk', 'tampilan'=> 'Tambah Mutasi Meninggal', 'display_name'=>'penduduk_mutasi', 'description'=>'penduduk'],
            ['name'=>'add-datang-mutasi-penduduk', 'tampilan'=> 'Tambah Mutasi Datang', 'display_name'=>'penduduk_mutasi', 'description'=>'penduduk'],
            ['name'=>'select-mutasi-penduduk', 'tampilan'=> 'Lihat Mutasi', 'display_name'=>'penduduk_mutasi', 'description'=>'penduduk'],
            ['name'=>'export-mutasi-penduduk', 'tampilan'=> 'Eksport Mutasi', 'display_name'=>'penduduk_mutasi', 'description'=>'penduduk'],

            ['name'=>'select-sementara-penduduk', 'tampilan'=> 'Lihat', 'display_name'=>'penduduk_sementara', 'description'=>'penduduk'],
            ['name'=>'add-sementara-penduduk', 'tampilan'=> 'Tambah', 'display_name'=>'penduduk_sementara', 'description'=>'penduduk'],
            ['name'=>'export-sementara-penduduk', 'tampilan'=> 'Eksport', 'display_name'=>'penduduk_sementara', 'description'=>'penduduk'],


            ['name'=>'select-kk-penduduk', 'tampilan'=> 'Lihat', 'display_name'=>'penduduk_kk', 'description'=>'penduduk'],
            ['name'=>'add-kk-penduduk', 'tampilan'=> 'Tambah', 'display_name'=>'penduduk_kk', 'description'=>'penduduk'],
            ['name'=>'edit-kk-penduduk', 'tampilan'=> 'Ubah', 'display_name'=>'penduduk_kk', 'description'=>'penduduk'],
            ['name'=>'remove-kk-penduduk',  'tampilan'=> 'Hapus','display_name'=>'penduduk_kk', 'description'=>'penduduk'],
            ['name'=>'export-kk-penduduk', 'tampilan'=> 'Eksport', 'display_name'=>'penduduk_kk', 'description'=>'penduduk'],

            ['name'=>'select-ktp-penduduk', 'tampilan'=> 'Lihat', 'display_name'=>'penduduk_ktp', 'description'=>'penduduk'],
            ['name'=>'add-ktp-penduduk', 'tampilan'=> 'Tambah', 'display_name'=>'penduduk_ktp', 'description'=>'penduduk'],
            ['name'=>'edit-ktp-penduduk', 'tampilan'=> 'Ubah', 'display_name'=>'penduduk_ktp', 'description'=>'penduduk'],
            ['name'=>'remove-ktp-penduduk', 'tampilan'=> 'Hapus', 'display_name'=>'penduduk_ktp', 'description'=>'penduduk'],
            ['name'=>'export-ktp-penduduk', 'tampilan'=> 'Eksport', 'display_name'=>'penduduk_ktp', 'description'=>'penduduk'],

            ['name'=>'select-rekapitulasi-penduduk', 'tampilan'=> 'Lihat', 'display_name'=>'penduduk_rekapitulasi', 'description'=>'penduduk'],

            ['name'=>'select-rpjm-perencanaan', 'tampilan'=> 'Lihat', 'display_name'=>'perencanaan_rpjm', 'description'=>'perencanaan'],
            ['name'=>'add-rpjm-perencanaan', 'tampilan'=> 'Tambah', 'display_name'=>'perencanaan_rpjm', 'description'=>'perencanaan'],
            ['name'=>'edit-rpjm-perencanaan', 'tampilan'=> 'Ubah', 'display_name'=>'perencanaan_rpjm', 'description'=>'perencanaan'],
            ['name'=>'remove-rpjm-perencanaan', 'tampilan'=> 'Hapus', 'display_name'=>'perencanaan_rpjm', 'description'=>'perencanaan'],
            ['name'=>'export-rpjm-perencanaan', 'tampilan'=> 'Eksport', 'display_name'=>'perencanaan_rpjm', 'description'=>'perencanaan'],

//            ['name'=>'add-rkp-perencanaan', 'display_name'=>'perencanaan_rkp', 'description'=>'perencanaan'],
            ['name'=>'edit-rkp-perencanaan', 'tampilan'=> 'Ubah', 'display_name'=>'perencanaan_rkp', 'description'=>'perencanaan'],
            ['name'=>'export-rkp-perencanaan', 'tampilan'=> 'Eksport', 'display_name'=>'perencanaan_rkp', 'description'=>'perencanaan'],
//            ['name'=>'remove-rkp-perencanaan', 'display_name'=>'perencanaan_rkp', 'description'=>'perencanaan'],

            ['name'=>'add-rkk-perencanaan', 'tampilan'=> 'Tambah', 'display_name'=>'perencanaan_rkk', 'description'=>'perencanaan'],
            ['name'=>'edit-rkk-perencanaan', 'tampilan'=> 'Ubah', 'display_name'=>'perencanaan_rkk', 'description'=>'perencanaan'],
            ['name'=>'export-rkk-perencanaan', 'tampilan'=> 'Eksport', 'display_name'=>'perencanaan_rkk', 'description'=>'perencanaan'],
//            ['name'=>'remove-rkk-perencanaan', 'display_name'=>'perencanaan_rkk', 'description'=>'perencanaan'],

            ['name'=>'select-apbd-perencanaan', 'tampilan'=> 'Lihat', 'display_name'=>'perencanaan_apbd', 'description'=>'perencanaan'],

            ['name'=>'select-pendapatan-perencanaan', 'tampilan'=> 'Lihat', 'display_name'=>'perencanaan_pendapatan', 'description'=>'perencanaan'],
            ['name'=>'add-pendapatan-perencanaan', 'tampilan'=> 'Tambah', 'display_name'=>'perencanaan_pendapatan', 'description'=>'perencanaan'],
            ['name'=>'edit-pendapatan-perencanaan', 'tampilan'=> 'Ubah', 'display_name'=>'perencanaan_pendapatan', 'description'=>'perencanaan'],
            ['name'=>'remove-pendapatan-perencanaan', 'tampilan'=> 'Hapus', 'display_name'=>'perencanaan_pendapatan', 'description'=>'perencanaan'],

            ['name'=>'select-belanja-perencanaan', 'tampilan'=> 'Lihat', 'display_name'=>'perencanaan_belanja', 'description'=>'perencanaan'],

            ['name'=>'select-pembiayaan-perencanaan', 'tampilan'=> 'Lihat', 'display_name'=>'perencanaan_pembiayaan', 'description'=>'perencanaan'],
            ['name'=>'add-pembiayaan-perencanaan', 'tampilan'=> 'Tambah', 'display_name'=>'perencanaan_pembiayaan', 'description'=>'perencanaan'],
            ['name'=>'edit-pembiayaan-perencanaan', 'tampilan'=> 'Ubah', 'display_name'=>'perencanaan_pembiayaan', 'description'=>'perencanaan'],
            ['name'=>'remove-pembiayaan-perencanaan', 'tampilan'=> 'Hapus', 'display_name'=>'perencanaan_pembiayaan', 'description'=>'perencanaan'],

            ['name'=>'select-apbd-pelaksanaan', 'tampilan'=> 'Lihat', 'display_name'=>'pelaksanaan_apbd', 'description'=>'pelaksanaan'],

            ['name'=>'select-pendapatan-pelaksanaan', 'tampilan'=> 'Lihat', 'display_name'=>'pelaksanaan_pendapatan', 'description'=>'pelaksanaan'],
            ['name'=>'add-pendapatan-pelaksanaan', 'tampilan'=> 'Tambah', 'display_name'=>'pelaksanaan_pendapatan', 'description'=>'pelaksanaan'],
            ['name'=>'edit-pendapatan-pelaksanaan', 'tampilan'=> 'Ubah', 'display_name'=>'pelaksanaan_pendapatan', 'description'=>'pelaksanaan'],
            ['name'=>'remove-pendapatan-pelaksanaan', 'tampilan'=> 'Hapus', 'display_name'=>'pelaksanaan_pendapatan', 'description'=>'pelaksanaan'],

            ['name'=>'select-belanja-pelaksanaan', 'tampilan'=> 'Lihat', 'display_name'=>'pelaksanaan_belanja', 'description'=>'pelaksanaan'],
            ['name'=>'add-belanja-pelaksanaan', 'tampilan'=> 'Tambah', 'display_name'=>'pelaksanaan_belanja', 'description'=>'pelaksanaan'],
            ['name'=>'edit-belanja-pelaksanaan', 'tampilan'=> 'Ubah', 'display_name'=>'pelaksanaan_belanja', 'description'=>'pelaksanaan'],
            ['name'=>'remove-belanja-pelaksanaan', 'tampilan'=> 'Hapus', 'display_name'=>'pelaksanaan_belanja', 'description'=>'pelaksanaan'],

            ['name'=>'select-pembiayaan-pelaksanaan', 'tampilan'=> 'Lihat', 'display_name'=>'pelaksanaan_pembiayaan', 'description'=>'pelaksanaan'],
            ['name'=>'add-pembiayaan-pelaksanaan', 'tampilan'=> 'Tambah', 'display_name'=>'pelaksanaan_pembiayaan', 'description'=>'pelaksanaan'],
            ['name'=>'edit-pembiayaan-pelaksanaan', 'tampilan'=> 'Ubah', 'display_name'=>'pelaksanaan_pembiayaan', 'description'=>'pelaksanaan'],
            ['name'=>'remove-pembiayaan-pelaksanaan', 'tampilan'=> 'Hapus', 'display_name'=>'pelaksanaan_pembiayaan', 'description'=>'pelaksanaan'],

            ['name'=>'select-peraturan-umum', 'tampilan'=> 'Lihat', 'display_name'=>'umum_peraturan', 'description'=>'umum'],
            ['name'=>'add-peraturan-umum', 'tampilan'=> 'Tambah', 'display_name'=>'umum_peraturan', 'description'=>'umum'],
            ['name'=>'edit-peraturan-umum', 'tampilan'=> 'Ubah', 'display_name'=>'umum_peraturan', 'description'=>'umum'],
            ['name'=>'remove-peraturan-umum', 'tampilan'=> 'Hapus', 'display_name'=>'umum_peraturan', 'description'=>'umum'],
            ['name'=>'export-peraturan-umum', 'tampilan'=> 'Export', 'display_name'=>'umum_peraturan', 'description'=>'umum'],

            ['name'=>'select-keputusan-umum', 'tampilan'=> 'Lihat', 'display_name'=>'umum_keputusan', 'description'=>'umum'],
            ['name'=>'add-keputusan-umum', 'tampilan'=> 'Tambah', 'display_name'=>'umum_keputusan', 'description'=>'umum'],
            ['name'=>'edit-keputusan-umum', 'tampilan'=> 'Ubah', 'display_name'=>'umum_keputusan', 'description'=>'umum'],
            ['name'=>'remove-keputusan-umum', 'tampilan'=> 'Hapus', 'display_name'=>'umum_keputusan', 'description'=>'umum'],
            ['name'=>'export-keputusan-umum',  'tampilan'=> 'Export','display_name'=>'umum_keputusan', 'description'=>'umum'],

            ['name'=>'select-inventaris-umum', 'tampilan'=> 'Lihat', 'display_name'=>'umum_inventaris', 'description'=>'umum'],
            ['name'=>'add-inventaris-umum', 'tampilan'=> 'Tambah', 'display_name'=>'umum_inventaris', 'description'=>'umum'],
            ['name'=>'edit-inventaris-umum', 'tampilan'=> 'Ubah', 'display_name'=>'umum_inventaris', 'description'=>'umum'],
            ['name'=>'remove-inventaris-umum', 'tampilan'=> 'Hapus', 'display_name'=>'umum_inventaris', 'description'=>'umum'],
            ['name'=>'export-inventaris-umum', 'tampilan'=> 'Export', 'display_name'=>'umum_inventaris', 'description'=>'umum'],

            ['name'=>'select-aparat-umum', 'tampilan'=> 'Lihat', 'display_name'=>'umum_aparat', 'description'=>'umum'],
            ['name'=>'add-aparat-umum', 'tampilan'=> 'Tambah', 'display_name'=>'umum_aparat', 'description'=>'umum'],
            ['name'=>'edit-aparat-umum', 'tampilan'=> 'Ubah', 'display_name'=>'umum_aparat', 'description'=>'umum'],
            ['name'=>'remove-aparat-umum', 'tampilan'=> 'Hapus', 'display_name'=>'umum_aparat', 'description'=>'umum'],
            ['name'=>'export-aparat-umum', 'tampilan'=> 'Export', 'display_name'=>'umum_aparat', 'description'=>'umum'],

            ['name'=>'select-tanah-kas-umum', 'tampilan'=> 'Lihat', 'display_name'=>'umum_tanah-kas', 'description'=>'umum'],
            ['name'=>'add-tanah-kas-umum', 'tampilan'=> 'Tambah', 'display_name'=>'umum_tanah-kas', 'description'=>'umum'],
            ['name'=>'edit-tanah-kas-umum', 'tampilan'=> 'Ubah', 'display_name'=>'umum_tanah-kas', 'description'=>'umum'],
            ['name'=>'remove-tanah-kas-umum', 'tampilan'=> 'Hapus', 'display_name'=>'umum_tanah-kas', 'description'=>'umum'],
            ['name'=>'export-tanah-kas-umum', 'tampilan'=> 'Export', 'display_name'=>'umum_tanah-kas', 'description'=>'umum'],

            ['name'=>'select-tanah-desa-umum', 'tampilan'=> 'Lihat', 'display_name'=>'umum_tanah-desa', 'description'=>'umum'],
            ['name'=>'add-tanah-desa-umum', 'tampilan'=> 'Tambah', 'display_name'=>'umum_tanah-desa', 'description'=>'umum'],
            ['name'=>'edit-tanah-desa-umum',  'tampilan'=> 'Ubah','display_name'=>'umum_tanah-desa', 'description'=>'umum'],
            ['name'=>'remove-tanah-desa-umum',  'tampilan'=> 'Hapus','display_name'=>'umum_tanah-desa', 'description'=>'umum'],
            ['name'=>'export-tanah-desa-umum',  'tampilan'=> 'Export','display_name'=>'umum_tanah-desa', 'description'=>'umum'],

            ['name'=>'select-agenda-umum', 'tampilan'=> 'Lihat', 'display_name'=>'umum_agenda', 'description'=>'umum'],
            ['name'=>'add-agenda-umum', 'tampilan'=> 'Tambah', 'display_name'=>'umum_agenda', 'description'=>'umum'],
            ['name'=>'edit-agenda-umum', 'tampilan'=> 'Ubah', 'display_name'=>'umum_agenda', 'description'=>'umum'],
            ['name'=>'remove-agenda-umum', 'tampilan'=> 'Hapus', 'display_name'=>'umum_agenda', 'description'=>'umum'],
            ['name'=>'export-agenda-umum', 'tampilan'=> 'Export', 'display_name'=>'umum_agenda', 'description'=>'umum'],

            ['name'=>'select-ekspedisi-umum', 'tampilan'=> 'Lihat', 'display_name'=>'umum_ekspedisi', 'description'=>'umum'],
            ['name'=>'add-ekspedisi-umum', 'tampilan'=> 'Tambah', 'display_name'=>'umum_ekspedisi', 'description'=>'umum'],
            ['name'=>'edit-ekspedisi-umum', 'tampilan'=> 'Ubah', 'display_name'=>'umum_ekspedisi', 'description'=>'umum'],
            ['name'=>'remove-ekspedisi-umum', 'tampilan'=> 'Hapus', 'display_name'=>'umum_ekspedisi', 'description'=>'umum'],
            ['name'=>'export-ekspedisi-umum',  'tampilan'=> 'Export','display_name'=>'umum_ekspedisi', 'description'=>'umum'],

            ['name'=>'select-lembar-berita-umum',  'tampilan'=> 'Lihat','display_name'=>'umum_lembar-berita', 'description'=>'umum'],
            ['name'=>'add-lembar-berita-umum',  'tampilan'=> 'Tambah','display_name'=>'umum_lembar-berita', 'description'=>'umum'],
            ['name'=>'edit-lembar-berita-umum', 'tampilan'=> 'Ubah', 'display_name'=>'umum_lembar-berita', 'description'=>'umum'],
            ['name'=>'remove-lembar-berita-umum', 'tampilan'=> 'Hapus', 'display_name'=>'umum_lembar-berita', 'description'=>'umum'],
            ['name'=>'export-lembar-berita-umum',  'tampilan'=> 'Export','display_name'=>'umum_lembar-berita', 'description'=>'umum'],

            ['name'=>'select-rencana-kerja-pembangunan',  'tampilan'=> 'Lihat','display_name'=>'pembangunan_rencana-kerja', 'description'=>'pembangunan'],
            ['name'=>'add-rencana-kerja-pembangunan',  'tampilan'=> 'Tambah','display_name'=>'pembangunan_rencana-kerja', 'description'=>'pembangunan'],
            ['name'=>'edit-rencana-kerja-pembangunan', 'tampilan'=> 'Ubah','display_name'=>'pembangunan_rencana-kerja', 'description'=>'pembangunan'],
            ['name'=>'remove-rencana-kerja-pembangunan', 'tampilan'=> 'Hapus', 'display_name'=>'pembangunan_rencana-kerja', 'description'=>'pembangunan'],
            ['name'=>'export-rencana-kerja-pembangunan',  'tampilan'=> 'Export','display_name'=>'pembangunan_rencana-kerja', 'description'=>'pembangunan'],

            ['name'=>'select-kegiatan-kerja-pembangunan', 'tampilan'=> 'Lihat', 'display_name'=>'pembangunan_kegiatan-kerja', 'description'=>'pembangunan'],
            ['name'=>'add-kegiatan-kerja-pembangunan', 'tampilan'=> 'Tambah', 'display_name'=>'pembangunan_kegiatan-kerja', 'description'=>'pembangunan'],
            ['name'=>'edit-kegiatan-kerja-pembangunan',  'tampilan'=> 'Ubah','display_name'=>'pembangunan_kegiatan-kerja', 'description'=>'pembangunan'],
            ['name'=>'remove-kegiatan-kerja-pembangunan', 'tampilan'=> 'Hapus', 'display_name'=>'pembangunan_kegiatan-kerja', 'description'=>'pembangunan'],
            ['name'=>'export-kegiatan-kerja-pembangunan', 'tampilan'=> 'Export', 'display_name'=>'pembangunan_kegiatan-kerja', 'description'=>'pembangunan'],

            ['name'=>'select-inventaris-pembangunan', 'tampilan'=> 'Lihat', 'display_name'=>'pembangunan_inventaris', 'description'=>'pembangunan'],
            ['name'=>'add-inventaris-pembangunan', 'tampilan'=> 'Tambah', 'display_name'=>'pembangunan_inventaris', 'description'=>'pembangunan'],
            ['name'=>'edit-inventaris-pembangunan', 'tampilan'=> 'Ubah', 'display_name'=>'pembangunan_inventaris', 'description'=>'pembangunan'],
            ['name'=>'remove-inventaris-pembangunan', 'tampilan'=> 'Hapus', 'display_name'=>'pembangunan_inventaris', 'description'=>'pembangunan'],
            ['name'=>'export-inventaris-pembangunan', 'tampilan'=> 'Export', 'display_name'=>'pembangunan_inventaris', 'description'=>'pembangunan'],

            ['name'=>'select-pemberdayaan-masyarakat-pembangunan',  'tampilan'=> 'Lihat','display_name'=>'pembangunan_pemberdayaan-masyarakat', 'description'=>'pembangunan'],
            ['name'=>'add-pemberdayaan-masyarakat-pembangunan',  'tampilan'=> 'Tambah','display_name'=>'pembangunan_pemberdayaan-masyarakat', 'description'=>'pembangunan'],
            ['name'=>'edit-pemberdayaan-masyarakat-pembangunan', 'tampilan'=> 'Ubah', 'display_name'=>'pembangunan_pemberdayaan-masyarakat', 'description'=>'pembangunan'],
            ['name'=>'remove-pemberdayaan-masyarakat-pembangunan',  'tampilan'=> 'Hapus','display_name'=>'pembangunan_pemberdayaan-masyarakat', 'description'=>'pembangunan'],
            ['name'=>'export-pemberdayaan-masyarakat-pembangunan', 'tampilan'=> 'Export', 'display_name'=>'pembangunan_pemberdayaan-masyarakat', 'description'=>'pembangunan'],

        ];

        foreach($akses as $k){
            $permision->firstOrCreate($k);
        }
    }
}
