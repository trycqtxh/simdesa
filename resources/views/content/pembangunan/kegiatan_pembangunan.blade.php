@extends('layouts.template')

@section('title', 'Buku Kegiatan Pembangunan')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
 <div class="box box-default" id="pembangunan">
    <div class="box-body">
        <div class="btn-group btn-group-sm">
            {{--<button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>--}}
            {{--<button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>--}}
            {{--<button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>--}}
            {{--<button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>--}}
            @permission('add-kegitan-kerja-pembangunan')
            <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
            @endpermission
            @permission('edit-kegitan-kerja-pembangunan')
            <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
            @endpermission
            @permission('remove-kegitan-kerja-pembangunan')
            <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
            @endpermission
            @permission('export-kegitan-kerja-pembangunan')
            <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
            @endpermission
        </div>
	   <table class="table table-bordered" id="tabel-pembangunan">
            <thead>
              <tr>
                <th rowspan="2">NOMOR URUT</th>
                <th rowspan="2">NAMA PROYEK / KEGIATAN</th>
                <th rowspan="2">VOLUME</th>
                <th colspan="4">SUMBER DANA / BESARAN BIAYA</th>
                <th rowspan="2">JIJI</th>
                <th rowspan="2">WAKTU</th>
                <th colspan="2">SIFAT PROYEK</th>
                <th rowspan="2">PELAKSANA</th>
                <th rowspan="2">KET</th>
              </tr>
              <tr>
                <th>PEMERINTAH</th>
                <th>PROV</th>
                <th>KAB / KOTA</th>
                <th>SWADAYA</th>
                <th>BARU</th>
                <th>LANJUTAN</th>
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
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
              </tr>
            </tbody>
        </table>
    </div>
 </div>

@include('modal.pembangunan.kegiatan_pembangunan')
@endsection

@push('js')
<script type="text/javascript">
    var tabPembangunan = $('div#pembangunan');
    var tabelPembangunan = tabPembangunan.find('table#tabel-pembangunan').DataTable({
        ordering     : false,
        paging       : true,
        searching    : true,
        lengthChange: false,
        scrollX      : true,
        scrollY      : "400px",
        fixedHeader  : true,
        scrollCollapse: true,
        scroller:       true,
        stateSave:      true,
        fixedColumns  : {
            leftColumns : 2,
        },
        select    : {
            style: 'single'
        },
        language  : {
            url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
        },
        ajax      : {
            url     : "{{ route('induk.index') }}",
            dataSrc : "data.data"
        },
        columnDefs :[
            { 'targets' : [0], 'visible' : false, 'searchable' : false }
        ]
    }); 
     $(function(){
        $('#btn-tambah').on('click',function(e){
            $('#modal-tambah').modal('show');
        })
    })
</script>
@endpush