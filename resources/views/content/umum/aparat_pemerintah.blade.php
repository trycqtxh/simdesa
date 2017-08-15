@extends('layouts.template')

@section('title', 'Buku Aparat Pemerintahan Desa')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
    <div class="box" id="aparat">
        <div class="box-body">
            <div class="btn-group btn-group-sm">
                {{--<button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>--}}
                {{--<button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>--}}
                {{--<button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>--}}
                {{--<button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>--}}
                @permission('add-aparat-umum')
                <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                @endpermission
                @permission('edit-aparat-umum')
                <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
                @endpermission
                @permission('remove-aparat-umum')
                <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
                @endpermission
                @permission('export-aparat-umum')
                <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
                @endpermission
            </div>
        </div>
    </div>
<div class="box box-default">
    <div class="box-body">
    	<table class="table table-bordered" id="tabel-aparat">
            <thead>
                <tr>
                    <th>NOMOR URUT</th>
                    <th>NAMA</th>
                    <th>NIAP</th>
                    <th>NIP</th>
                    <th>JENIS KELAMIN</th>
                    <th>TEMPAT DAN TGL LAHIR</th>
                    <th>AGAMA</th>
                    <th>PANGKAT GOLANGAN</th>
                    <th>JABATAN</th>
                    <th>PENDIDIKAN TERAKHIR</th>
                    <th>NOMOR DAN TANGGAL KEPUTUSAN PENGANGKATAN</th>
                    <th>NOMOR DAN TANGGAL KEPUTUSAN PEMBERHENTIAN</th>
                    <th>KET</th>
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

@include('modal.umum.aparat_pemerintah')
@endsection
@push('js')
<script type="text/javascript">
    var tabaparat = $('div#aparat');
    var tabelaparat = $('table#tabel-aparat').DataTable({
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
            url     : "{{ route('aparat-pemerintah.index') }}",
            dataSrc : "data.data"
        },
        columnDefs :[
            { 'targets' : [0], 'visible' : false, 'searchable' : false }
        ],
        columns : [
            { data : 'id'},
            { data : 'nama'},
            { data : 'niap'},
            { data : 'nip'},
            { data : 'jenis_kelamin'},
            { data : 'tempat_tanggal_lahir'},
            { data : 'agama'},
            { data : 'golongan'},
            { data : 'jabatan'},
            { data : 'pendidikan'},
            { data : 'nomor_tanggal_pengangkatan'},
            { data : 'nomor_tanggal_pemberhentian'},
            { data : 'keterangan'},
        ]
    }); 
    $(function(){
        $('#btn-tambah').on('click',function(e){
            $('#modal-tambah').modal('show');
        });
        $('#modal-tambah').on('shown.bs.modal', function(){
            $(this).find('button#cari').click(function(){
                var nik = $('#modal-tambah').find('input[name=nik]').val();
                $.ajax({
                    context : {
                        context : "form"
                    },
                    url      : "{{ route('induk.cari.select', '') }}/"+nik,
                    dataType : "json",
                    type     : "GET",
                    global   : false,
                    beforeSend  : function(){
                        $('.loading').show();
                    },
                    complete : function(){
                        $('.loading').hide();
                    }
                }).done(function(data){
                    $('#modal-tambah').find('input[name=nama]').val(data[0].data.nik);
                    $('#modal-tambah').find('input[name=jenis_kelamin]').val(data[0].data.jenis_kelamin);
                    $('#modal-tambah').find('input[name=tempat_lahir]').val(data[0].data.tempat_lahir);
                    $('#modal-tambah').find('input[name=tanggal_lahir]').val(data[0].data.tanggal_lahir);
                    $('#modal-tambah').find('input[name=agama]').val(data[0].data.agama);
                    $('#modal-tambah').find('input[name=pendidikan]').val(data[0].data.pendidikan);
                }).error(function(event, xhr, settings){
                    $('#modal-tambah').find('input[name=nama]').val("");
                    $('#modal-tambah').find('input[name=jenis_kelamin]').val("");
                    $('#modal-tambah').find('input[name=tempat_lahir]').val("");
                    $('#modal-tambah').find('input[name=tanggal_lahir]').val("");
                    $('#modal-tambah').find('input[name=agama]').val("");
                    $('#modal-tambah').find('input[name=pendidikan]').val("");
                    NOTIF.show({
                        type    : "error",
                        title   : "NIK Error",
                        message : "NIK Tidak Ditemukan"
                    });

                });
            });
            $(this).find('input[name=tanggal_pengangkatan]').datepicker({
                format : 'yyyy-mm-dd'
            });
        });
        $('#modal-tambah').find('form').submit(function(e){
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('aparat-pemerintah.tambah') }}",
                dataType : "json",
                type     : "POST",
                data     : $(this).serialize()
            }).done(function(){
                tabelaparat.ajax.reload();
            });
            e.preventDefault();
        });

        $('#btn-export').click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('aparat-pemerintah.excel') }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('aparat-pemerintah.excel') }}";
            });
        });
    })


</script>
@endpush