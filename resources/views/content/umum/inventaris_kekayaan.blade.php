@extends('layouts.template')

@section('title', 'Buku Inventaris dan Kekayaan Desa')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
	<div class="box box-default" id="inventaris_kekayaan">
        <div class="box-body">
            <div class="btn-group btn-group-sm">
                {{--<button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>--}}
                {{--<button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>--}}
                {{--<button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>--}}
                {{--<button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>--}}
                @permission('add-inventaris-umum')
                <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                @endpermission
                @permission('edit-inventaris-umum')
                <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
                @endpermission
                @permission('remove-inventaris-umum')
                <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
                @endpermission
                @permission('export-inventaris-umum')
                <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
                @endpermission
            </div>
        </div>
    </div>
	<div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered" id="tabel-inventaris_kekayaan">
                <thead>
                    <tr>
                        <th rowspan="3">NOMOR URUT</th>
                        <th rowspan="3">JENIS BARANG /  BANGUNAN</th>
                        <th colspan="5">ASAL BARANG / BANGUNAN</th>
                        <th colspan="2">KEADAAN BARANG / BANGUNAN AWAL TAHUN</th>
                        <th colspan="4">PENGHAPUSAN BARANG DAN BANGUNAN</th>
                        <th colspan="2">KEADAAN BARANG / BANGUNAN AKHIR TAHUN </th>
                        <th rowspan="3">KET</th>
                    </tr>
                    <tr>
                        <th rowspan="2">DIBELI SENDIRI</th>
                        <th colspan="3">BANTUAN</th>
                        <th rowspan="2">SUMBANGAN</th>
                        <th rowspan="2">BAIK</th>
                        <th rowspan="2">RUSAK</th>
                        <th rowspan="2">RUSAK</th>    
                        <th rowspan="2">DIJUAL</th>
                        <th rowspan="2">DISUMBANGKAN</th>
                        <th rowspan="2">TGL PENG HAPUSAN</th>
                        <th rowspan="2">BAIK</th>
                        <th rowspan="2">RUSAK</th>
                    </tr>
                    <tr>
                        <th>PEMERINTAH</th>
                        <th>PROVINSI</th>
                        <th>KAB/KOTA</th>
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
                    </tr>
                </tbody>
            </table>
        </div>
    </div>    

@include('modal.umum.inventaris_kekayaan')
@endsection
@push('js')
<script type="text/javascript">
    var tabInventaris_kekayaan = $('div#inventaris_kekayaan');
    var tabelInventaris_kekayaan = $('table#tabel-inventaris_kekayaan').DataTable({
        ordering     : false,
        paging       : true,
        searching    : true,
        lengthChange: false,
        select    : {
            style: 'single'
        },
        language  : {
            url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
        },
        ajax      : {
            url     : "{{ route('inventaris-kekayaan.index') }}",
            dataSrc : "data.data"
        },
        columnDefs :[
            { 'targets' : [0], 'visible' : false, 'searchable' : false }
        ],
        columns : [
            { data : 'id'},
            { data : 'jenis_barang'},
            { data : 'asal_sendiri'},
            { data : 'asal_pemerintah'},
            { data : 'asal_provinsi'},
            { data : 'asal_kota'},
            { data : 'asal_sumbangan'},
            { data : 'awal_tahun_baik'},
            { data : 'awal_tahun_rusak'},
            { data : 'hapus_rusak'},
            { data : 'hapus_dijual'},
            { data : 'hapus_disumbangkan'},
            { data : 'hapus_tanggal'},
            { data : 'akhir_tahun_baik'},
            { data : 'akhir_tahun_rusak'},
            { data : 'keterangan'},
        ]
    }); 
    $(function(){
        $('#btn-tambah').on('click',function(e){
            $('#modal-tambah').modal('show');
        })

        
    })


</script>
@endpush