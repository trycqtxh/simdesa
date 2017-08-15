@extends('layouts.template')

@section('title', 'Buku Rencana Kerja dan Pembangunan')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
 <div class="box box-default" id="rencana-kerja">
    <div class="box-body">
        <div class="btn-group btn-group-sm">
            {{--<button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>--}}
            {{--<button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>--}}
            {{--<button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>--}}
            {{--<button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>--}}
            @permission('add-rencana-kerja-pembangunan')
            <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
            @endpermission
            @permission('edit-rencana-kerja-pembangunan')
            <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
            @endpermission
            @permission('remove-rencana-kerja-pembangunan')
            <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
            @endpermission
            @permission('export-rencana-kerja-pembangunan')
            <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
            @endpermission
        </div>
	   <table class="table table-bordered" id="tabel-RencanaKerja">
            <thead>
              <tr>
                <th rowspan="2">Nomor Urut</th>
                <th rowspan="2">NAMA PROYEK / KEGIATAN</th>
                <th rowspan="2">LOKASI</th>
                <th colspan="4">SUMBER DAYA</th>
                <th rowspan="2">JUMLAH</th>
                <th rowspan="2">PELAKSANA</th>
                <th rowspan="2">MANFAAT</th>
                <th rowspan="2">KET</th>
              </tr>
              <tr>
                <th>PEMERINTAH</th>
                <th>PROVINSI</th>
                <th>KAB / KOTA</th>
                <th>SWADAYA</th>
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
              </tr>
            </tbody>
        </table>
    </div>
 </div>
@include('modal.pembangunan.rencana_kerja')
@endsection

@push('js')
<script type="text/javascript">
    var tabRencanaKerja = $('div#rencana-kerja');
    var tabelRencanaKerja = tabRencanaKerja.find('table#tabel-RencanaKerja').DataTable({
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
</script>
@endpush