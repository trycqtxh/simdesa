@extends('layouts.template')

@section('title', 'Rekapitulasi Penduduk')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
    <div class="box">
        <div class="box-body">
            <button class="btn btn-default btn-sm" id="btn-export"><i class="fa fa-download"></i> Export </button>
        </div>
    </div>
    <div class="box box-default" style="min-height: 400px">
        <div class="box-body">
            <table class="table table-bordered" id="tabel">
                <thead>
                <tr>
                    <th rowspan="4">NOMOR URUT</th>
                    <th rowspan="4">NAMA DUSUN / LINGKUNGAN</th>
                    <th colspan="7">JUMLAH PENDUDUK AWAL BULAN</th>
                    <th colspan="8">TAMBAHAN BULAN INI</th>
                    <th colspan="8">PENGURANGAN BULAN INI</th>
                    <th colspan="7" rowspan="2">JUMLAH PENDUDUK AKHIR BULAN</th>
                    <th rowspan="4">KET</th>
                </tr>
                <tr>
                    <th colspan="2">WNA</th>
                    <th colspan="2">WNI</th>
                    <th rowspan="3">JLH KK</th>
                    <th rowspan="3">JML ANGGOTA KELUARGA</th>
                    <th rowspan="3">JML JIWA (7+8)</th>
                    <th colspan="4">LAHIR</th>
                    <th colspan="4">DATANG</th>
                    <th colspan="4">MENINGGAL</th>
                    <th colspan="4">PINDAH</th>
                </tr>
                <tr>
                    <th rowspan="2">L</th>
                    <th rowspan="2">P</th>
                    <th rowspan="2">L</th>
                    <th rowspan="2">P</th>
                    <th colspan="2">WNA</th>
                    <th colspan="2">WNI</th>
                    <th colspan="2">WNA</th>
                    <th colspan="2">WNI</th>
                    <th colspan="2">WNA</th>
                    <th colspan="2">WNI</th>
                    <th colspan="2">WNA</th>
                    <th colspan="2">WNI</th>
                    <th colspan="2">WNA<br></th>
                    <th colspan="2">WNI</th>
                    <th rowspan="2">JML KK<br></th>
                    <th rowspan="2">JML ANGGOTA KELUARGA</th>
                    <th rowspan="2">JLM JIWA (30+31)</th>
                </tr>
                <tr>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                    <th>10</th>
                    <th>11</th>
                    <th>12</th>
                    <th>13</th>
                    <th>14</th>
                    <th>15</th>
                    <th>16</th>
                    <th>17</th>
                    <th>18</th>
                    <th>19</th>
                    <th>20</th>
                    <th>21</th>
                    <th>22</th>
                    <th>23</th>
                    <th>24</th>
                    <th>25</th>
                    <th>26</th>
                    <th>27</th>
                    <th>28</th>
                    <th>29</th>
                    <th>30</th>
                    <th>31</th>
                    <th>32</th>
                    <th>33</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                    <td>11</td>
                    <td>12</td>
                    <td>13</td>
                    <td>14</td>
                    <td>15</td>
                    <td>16</td>
                    <td>17</td>
                    <td>18</td>
                    <td>19</td>
                    <td>20</td>
                    <td>21</td>
                    <td>22</td>
                    <td>23</td>
                    <td>24</td>
                    <td>25</td>
                    <td>26</td>
                    <td>27</td>
                    <td>28</td>
                    <td>29</td>
                    <td>30</td>
                    <td>31</td>
                    <td>32</td>
                    <td>33</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
<script type="text/javascript">
    var tabel = $('#tabel').DataTable({
        ordering     : false,
        paging       : false,
        searching    : false,
        lengthChange : false,
        info         : false,
        scrollX      : true,
        scrollY      : "400px",
        fixedHeader  : true,
        language  : {
            url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
        },
        ajax      : {
            url     : "{{ route('penduduk.rekapitulasi') }}",
            dataSrc : "data"
        },
        columns : [
            { data : 'no'},
            { data : 'nama_rw'},
            { data : 'awal_bulan_wna_l'},
            { data : 'awal_bulan_wna_p'},
            { data : 'awal_bulan_wni_l'},
            { data : 'awal_bulan_wni_p'},
            { data : 'awal_bulan_jml_kk'},
            { data : 'awal_bulan_jml_anggota_kk'},
            { data : 'awal_bulan_jml_jiwa'},
            { data : 'tambah_bulan_wna_lahir_l'},
            { data : 'tambah_bulan_wna_lahir_p'},
            { data : 'tambah_bulan_wni_lahir_l'},
            { data : 'tambah_bulan_wni_lahir_p'},
            { data : 'tambah_bulan_wna_datang_l'},
            { data : 'tambah_bulan_wna_datang_p'},
            { data : 'tambah_bulan_wni_datang_l'},
            { data : 'tambah_bulan_wni_datang_p'},
            { data : 'kurang_bulan_wna_meninggal_l'},
            { data : 'kurang_bulan_wna_meninggal_p'},
            { data : 'kurang_bulan_wni_meninggal_l'},
            { data : 'kurang_bulan_wni_meninggal_p'},
            { data : 'kurang_bulan_wna_pindah_l'},
            { data : 'kurang_bulan_wna_pindah_p'},
            { data : 'kurang_bulan_wni_pindah_l'},
            { data : 'kurang_bulan_wni_pindah_p'},
            { data : 'akhir_bulan_wna_l'},
            { data : 'akhir_bulan_wna_p'},
            { data : 'akhir_bulan_wni_l'},
            { data : 'akhir_bulan_wni_p'},
            { data : 'akhir_bulan_jml_kk'},
            { data : 'akhir_bulan_jml_anggota_kk'},
            { data : 'akhir_bulan_jml_jiwa'},
            { data : 'keterangan'},
        ]
    });

    $(function(){
        $('#btn-export').click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('rekap.excel') }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('rekap.excel') }}";
            });
        })
    })
</script>
@endpush