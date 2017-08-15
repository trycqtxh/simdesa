<?php
use App\Entities\KegiatanKerja;

$current_year = Carbon\Carbon::now()->year;
$bidang = App\Entities\Bidang::where('jenis', 'belanja')->get();

$rpjm = App\Entities\RPJM::all()->last();
//$tahun = Carbon::createFromDate($rpjm['tahun_awal'])->addYears($id-1)->year;
$tahun = $current_year;

//subkegiatan - anak [id_parent] id = 43
$subkegiatan_id = KegiatanKerja::whereHas('rkps', function($q) use($tahun){
    $q->where('tahun', $tahun);
})->get()->pluck('kegiatan_kerja_id');

//kegiatan - anak [id_parent] id =1
$kegiatan_id = KegiatanKerja::whereHas('kerjas', function($query) use($subkegiatan_id){
    $query->where('jenis', 'level_3');
})->whereIn('id', $subkegiatan_id)->get()->pluck('kegiatan_kerja_id');


$current_subbidang_id = KegiatanKerja::whereHas('kerjas', function($query) use($kegiatan_id){
    $query->where('jenis', 'level_2');
})->whereIn('id', $kegiatan_id)->get()->pluck('id');

$current_kegiatan_id = KegiatanKerja::whereHas('kerjas', function($query) use($subkegiatan_id){
    $query->where('jenis', 'level_3');
})->whereIn('id', $subkegiatan_id)->get()->pluck('id');

$current_subkegiatan_id = KegiatanKerja::whereHas('rkps', function($q) use($tahun){
    $q->where('tahun', $tahun);
})->get()->pluck('id');

    $table = [];

    $kode_belanja = 2;

    $jumlah_belanja = 0;
    $kode_1 = 1;
    foreach($bidang as $b){
        $row_bidang = [];
        $row_bidang['kode_1'] = $kode_belanja;
        $row_bidang['kode_2'] = $kode_1;
        $row_bidang['kode_3'] = '';
        $row_bidang['kode_4'] = '';

        $row_bidang['uraian'] = $b->nama;
        $row_bidang['anggaran'] = '';
        $row_bidang['keterangan'] = '';
        //$table[] = $row_bidang;

        //------------------------------------------------------------------------------------------------------
        $subbidang = KegiatanKerja::where('jenis', 'level_1')
                ->where('bidang_id', $b['id'])
                ->whereIn('id', $current_subbidang_id)
                ->where('id', $id)
                ->where('rpjm_id', $rpjm['id'])
                ->get();
        $kode_2 = 1;
        $z = 1;
        foreach($subbidang as $sb){

            //--------------------------------------------------------------------------------------------------
            $kegiatan = KegiatanKerja::where('jenis', 'level_2')
                    ->where('kegiatan_kerja_id', $sb->id)
                    ->whereIn('id', $current_kegiatan_id)
                    //->whereIn('id', $id)
                    ->where('rpjm_id', $rpjm['id'])
                    ->get();
            $kode_3 = 1;
            foreach($kegiatan as $k){
                $row_kegiatan = [];
                $row_kegiatan['nomor_urut'] = '';
                $row_kegiatan['uraian'] = $k->uraian;
                $row_kegiatan['anggaran'] = '';
                $row_kegiatan['volume'] = '';
                $table[] = $row_kegiatan;
                //----------------------------------------------------------------------------------------------
                $sub_kegiatan = KegiatanKerja::where('jenis', 'level_3')
                        ->where('kegiatan_kerja_id', $k->id)
                        ->whereIn('id', $current_subkegiatan_id)
                        ->where('rpjm_id', $rpjm['id'])
                        ->get();
                foreach($sub_kegiatan as $sk){
                    $row_subkegiatan = [];

                    //$row_subkegiatan['sub_bidang'] = $sb->id;
                    //$row_subkegiatan['kegiatan'] = $k->id;
                    //$row_subkegiatan['sub_kegiatan'] = $sk->id;
                    $row_subkegiatan['nomor_urut'] = $z++;

                    $row_subkegiatan['uraian'] = $sk->uraian;
                    $row_subkegiatan['anggaran'] = $sk->detailKegiatanKerjas->first()->jumlah_dana;
                    $row_subkegiatan['volume'] = $sk->detailKegiatanKerjas->first()->volume;
                    $table[] = $row_subkegiatan;
                    $jumlah_belanja += (int) $sk->detailKegiatanKerjas->first()->jumlah_dana;
                }
                //----------------------------------------------------------------------------------------------
                $kode_3++;
            }
            //--------------------------------------------------------------------------------------------------
            $kode_2++;
        }
        //------------------------------------------------------------------------------------------------------
        $kode_1++;
    }

//var_dump($table);
?>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Nomor Urut</th>
        <th>Uraian</th>
        <th>Volume</th>
        <th>Harga Satuan (Rp.)</th>
        <th>Jumlah (Rp.)</th>
    </tr>
    <tr>
        <th>1</th>
        <th>2</th>
        <th>3</th>
        <th>4</th>
        <th>5</th>
    </tr>
    </thead>
    <tbody>
    @php($jumlah = 0)
    @foreach($table as $t)
    <tr>
        <td class="text-center" width="10%">{{ $t['nomor_urut'] }}</td>
        <td>{{ $t['uraian'] }}</td>
        <td>{{ $t['volume'] }}</td>
        <td>{{ $t['anggaran'] }}</td>
        <td>{{ ($t['anggaran']) ? $t['volume'] * $t['anggaran'] : '' }}</td>
        @php( $jumlah += $t['volume'] * $t['anggaran'])
    </tr>
    @endforeach
    <tr>
        <td colspan="4"><b>Jumlah (Rp.)</b></td>
        <td>{{ $jumlah }}</td>
    </tr>
    </tbody>
</table>