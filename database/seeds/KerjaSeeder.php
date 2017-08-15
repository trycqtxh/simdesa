<?php

use Illuminate\Database\Seeder;

class KerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //-------------------------------------------------------------------------------------------------------------------
        $rpjm = App\Entities\RPJM::all()->last()['id'];
        $apbd_level_3_belanja = [
            ['jenis'=>'level_1', 'uraian'=>'Penghasilan Tetap dan Tunjangan ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Operasional Pemerintah Desa ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Operasional BPD ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Operasional RT/RW ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Peningkatan Partisipasi Masyarakat dalam Demokrasi ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Penetapan dan penegasan batas Desa ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Pendataan Desa/ Profil Desa ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Penyusunan tata ruang Desa ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Penyelenggaraan musyawarah Desa ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Pengelolaan informasi Desa ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Penyelenggaraan perencanaan Desa ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Penyelenggaraan evaluasi tingkat perkembangan pemerintahan Desa ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Penyelenggaraan kerjasama antar Desa ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Pembangunan sarana dan prasarana kantor Desa ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Penyelenggaraan kegiatan lainnya. ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
        ];
        foreach($apbd_level_3_belanja as $l_3){
            $l_3['bidang_id'] = 4;
            App\Entities\KegiatanKerja::firstOrCreate($l_3);
        }

        $apbd_level_3_belanja = [
            ['jenis'=>'level_1', 'uraian'=>'Pembangunan, Pengembangan dan pengelolaan pos kesehatan Desa dan Polindes ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Pembangunan dan Pengelolaan Posyandu ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Pembangunan dan pengembangan pendidikan anak usia dini. ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Pembangunan dan pemeliharaan sanitasi lingkungan ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Pembangunan air bersih berskala Desa ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Pembangunan dan Pengembangan Taman bacaan masyarakat ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Pembangunan, balai pelatihan / kegiatan belajar masyarakat ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Pengembangan sanggar seni ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Sarana dan prasarana pendidikan dan pelatihan lainnya. ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'pengembangan Usaha Kesehatan Sekolah Dasar ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
        ];
        foreach($apbd_level_3_belanja as $l_3){
            $l_3['bidang_id'] = 5;
            App\Entities\KegiatanKerja::firstOrCreate($l_3);
        }

        $apbd_level_3_belanja = [
            ['jenis'=>'level_1', 'uraian'=>'Kegiatan pembinaan lembaga kemasyarakatan ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Kegiatan penyelenggaraan ketentraman dan ketertiban ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Kegiatan pembinaan kerukunan umat beragama ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Kegiatan pengadaan sarana dan prasarana olah raga', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Kegiatan pembinaan lembaga adat', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
        ];
        foreach($apbd_level_3_belanja as $l_3){
            $l_3['bidang_id'] = 6;
            App\Entities\KegiatanKerja::firstOrCreate($l_3);
        }

        $apbd_level_3_belanja = [
            ['jenis'=>'level_1', 'uraian'=>'Kegiatan peningkatan kualitas proses perencanaan Desa ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Kegiatan pendukung kegiatan ekonomi baik yang dikembangkan oleh BUM Desa maupun oleh kelompok usaha masyarakat Desa lainnya ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Kegiatan pembentukan dan peningkatan kapasitas Kader Pemberdayaan Masyarakat Desa', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
            ['jenis'=>'level_1', 'uraian'=>'Kegiatan pengorganisasian melalui pembentukan dan fasilitasi paralegal untuk memberikan bantuan hukum kepada warga masyarakat Desa ', 'kegiatan_kerja_id'=>null, 'rpjm_id'=>$rpjm],
        ];
        foreach($apbd_level_3_belanja as $l_3){
            $l_3['bidang_id'] = 7;
            App\Entities\KegiatanKerja::firstOrCreate($l_3);
        }

        //------------------------------------------------------------------------------------------------------------------------------------
        $apbd_level_1_pendapatan = [
            ['level' => 'level_1', 'uraian' => 'Hasil Usaha'],
            ['level' => 'level_1', 'uraian' => 'Swadaya, Partisipasi dan Gotong Royong'],
            ['level' => 'level_1', 'uraian' => 'Lain-lain Pendapatan Asli Desa yang sah'],
        ];
        foreach($apbd_level_1_pendapatan as $a){
            $a['bidang_id'] = 1;
            $a['tahun'] = '2017';
            App\Entities\Pendapatan::firstOrCreate($a);
        }

        $apbd_level_1_pendapatan = [
            ['level' => 'level_1', 'uraian' => 'Dana Desa (DD)'],
            ['level' => 'level_1', 'uraian' => 'Bagian dari Hasil Pajak dan Retribusi Daerah Kabupaten (BHP)'],
            ['level' => 'level_1', 'uraian' => 'Alokasi Dana Desa (ADD)'],
            ['level' => 'level_1', 'uraian' => 'Bantuan Keuangan'],
        ];
        foreach($apbd_level_1_pendapatan as $a){
            $a['bidang_id'] = 2;
            $a['tahun'] = '2017';
            App\Entities\Pendapatan::firstOrCreate($a);
        }

        $apbd_level_1_pendapatan = [
            ['level' => 'level_1', 'uraian' => 'Hibah dan Sumbangan dari pihak ke-3 yang tidak mengikat '],
            ['level' => 'level_1', 'uraian' => 'Lain lain pendapatan desa yang sah'],
        ];
        foreach($apbd_level_1_pendapatan as $a){
            $a['bidang_id'] = 3;
            $a['tahun'] = '2017';
            App\Entities\Pendapatan::firstOrCreate($a);
        }

        //-------------------------------------------------------------------------------------------------------------------------------------
        $apbd_level_1_pembiayaan = [
            ['level' => 'level_1', 'uraian' => 'SILPA'],
            ['level' => 'level_1', 'uraian' => 'Pencairan Dana Cadangan'],
            ['level' => 'level_1', 'uraian' => 'Hasil Kekayaan Desa Yang dipisahkan'],
        ];
        foreach($apbd_level_1_pembiayaan as $a){
            $a['bidang_id'] = 9;
            $a['tahun'] = '2017';
            App\Entities\Pembiayaan::firstOrCreate($a);
        }

        $apbd_level_1_pembiayaan = [
            ['level' => 'level_1', 'uraian' => 'Pembentukan Dana Cadangan'],
            ['level' => 'level_1', 'uraian' => 'Penyertaan Modal Desa'],
        ];
        foreach($apbd_level_1_pembiayaan as $a){
            $a['bidang_id'] = 10;
            $a['tahun'] = '2017';
            App\Entities\Pembiayaan::firstOrCreate($a);
        }
    }
}
