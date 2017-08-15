@extends('layouts.template')

@section('title', 'Buku Kader Pemberdayaan Masyarakat')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
 <div class="box box-default" id="pemberdayaan">
    <div class="box-body">
        <div class="btn-group btn-group-sm">
            {{--<button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>--}}
            {{--<button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>--}}
            {{--<button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>--}}
            {{--<button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>--}}
            @permission('add-pemberdayaan-masyarakat-pembangunan')
            <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
            @endpermission
            @permission('edit-pemberdayaan-masyarakat-pembangunan')
            <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
            @endpermission
            @permission('remove-pemberdayaan-masyarakat-pembangunan')
            <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
            @endpermission
            @permission('export-pemberdayaan-masyarakat-pembangunan')
            <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
            @endpermission
        </div>
	   <table class="table table-bordered" id="tabel-pemberdayaan">
            <thead>
              <tr>
                <th>NOMOR URUT</th>
                <th>NAMA</th>
                <th>UMUR</th>
                <th>JENIS KELAMIN</th>
                <th>PENDIDIKAN / KURSUS</th>
                <th>BIDANG</th>
                <th>ALAMAT</th>
                <th>KETERANGAN</th>
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
              </tr>
            </tbody>
        </table>
    </div>
 </div>
@include('modal.pembangunan.pemberdayaan_masyarakat')
@endsection
@push('js')
<script type="text/javascript">
    var tabPemberdayaan = $('div#pemberdayaan');
    var tabelPemberdayaan = tabPemberdayaan.find('table#tabel-pemberdayaan').DataTable({
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