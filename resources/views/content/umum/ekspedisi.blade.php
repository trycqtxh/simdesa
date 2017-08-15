@extends('layouts.template')

@section('title', 'Buku Ekspedisi')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
	<div class="box box-default" id="ekspedisi">
        <div class="box-body">
            <div class="btn-group btn-group-sm">
                {{--<button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>--}}
                {{--<button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>--}}
                {{--<button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>--}}
                {{--<button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>--}}
                @permission('add-ekspedisi-umum')
                <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                @endpermission
                @permission('edit-ekspedisi-umum')
                <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
                @endpermission
                @permission('remove-ekspedisi-umum')
                <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
                @endpermission
                @permission('export-ekspedisi-umum')
                <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
                @endpermission
            </div>
        </div>
    </div>
	<div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered" id="tabel-ekspedisi">
                <thead>
                    <tr>
                        <th>NOMOR URUT</th>
                        <th>TANGGAL PENGIRIMAN</th>
                        <th>TANGGAL DAN NOMOR SURAT</th>
                        <th>ISI SINGKAT SURAT YANG DIKIRIM</th>
                        <th>DITUJUKAN KEPADA</th>
                        <th>KETERANGAN</th>
                    </tr>
                    <tr>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
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
                     </tr>
                </tbody>
            </table>
        </div>
    </div>        

@include('modal.umum.ekspedisi')
@endsection
@push('js')
<script type="text/javascript">
    var tabEkspedisi = $('div#ekspedisi');
    var btnT = tabEkspedisi.find('#btn-tambah');
    var btnU = tabEkspedisi.find('#btn-ubah');
    var btnH = tabEkspedisi.find('#btn-hapus');

    var tabelEkspedisi = $('table#tabel-ekspedisi').DataTable({
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
            url     : "{{ route('adm-surat.index.ekspedisi') }}",
            dataSrc : "data.data"
        },
        columnDefs :[
            { 'targets' : [0], 'visible' : false, 'searchable' : false }
        ],
         columns : [
            { data : 'id'},
            { data : 'tanggal_pengirim_penerima'},
            { data : 'tanggal_nomor_surat'},
            { data : 'isi_surat'},
             { data : 'pengirim_penerima'},
            { data : 'keterangan'},
        ]
    });

    $(function(){
        $('#btn-tambah').on('click',function(e){
            $('#modal-tambah').modal('show');
        })

        $('#modal-tambah').find('form').submit(function(event){
            $.ajax({
                context : {
                    context : "form"
                },
                type     : "POST",
                dataType : "json",
                url      : "{{ route('adm-surat.tambah', ['jenis'=>'ekspedisi']) }}",
                data     : $('#modal-tambah').find('form').serialize()
            }).done(function(){
                tabelEkspedisi.ajax.reload();
            });
            event.preventDefault();
        });

        $('#modal-tambah').on("shown.bs.modal", function(){
            $('#modal-tambah').find('input[name=tanggal_pengiriman]').datepicker({
                format : 'yyyy-mm-dd'
            });
            $('#modal-tambah').find('input[name=tanggal_surat]').datepicker({
                format : 'yyyy-mm-dd'
            });
        });

        tabelEkspedisi.on("select", function(){
            btnH.attr('disabled', false);
            btnU.attr('disabled', false);
        }).on('deselect', function(){
            btnH.prop('disabled', true);
            btnU.prop('disabled', true);
        });

        btnU.click(function(){
            var row = tabelEkspedisi.rows('.selected').indexes();
            var id = tabelEkspedisi.rows(row).data().toArray()[0]['id'];

            $.ajax({
                context : {
                    context : "form"
                },
                url : "{{ route('adm-surat.cari', '') }}/"+id,
                dataType : "json",
                type : "GET",
                global : false
            }).done(function(data){
                $("#modal-ubah").find('input[name=tanggal_pengiriman]').val(data.data.tanggal_pengirim_penerima);
                $("#modal-ubah").find('input[name=nomor_surat]').val(data.data.nomor_surat);
                $("#modal-ubah").find('input[name=tanggal_surat]').val(data.data.tanggal_surat);
                $("#modal-ubah").find('input[name=ditujukan_kepada]').val(data.data.pengirim_penerima);
                $("#modal-ubah").find('textarea[name=isi_surat]').val(data.data.isi_surat);
                $("#modal-ubah").find('textarea[name=keterangan]').val(data.data.keterangan);
                $("#modal-ubah").find('input[name=id]').val(data.data.id);
                $("#modal-ubah").modal("show");
            });
        });

        $("#modal-ubah").submit(function(e){
            var id = $("#modal-ubah").find('input[name=id]').val();
            console.log(id);
            $.ajax({
                context :{
                    context : "form"
                },
                url : "{{ route('adm-surat.ubah', ['jenis'=>'ekspedisi', 'id'=>'']) }}/"+id,
                type : "PUT",
                dataType : "json",
                data : $("#modal-ubah").find('form').serialize()
            }).done(function(data){
                tabelEkspedisi.ajax.reload();
            });
            e.preventDefault();
        });

        btnH.click(function(){
            if(confirm("Apakah yakin akan Dihapus ?")){
                var row = tabelEkspedisi.rows('.selected').indexes();
                var id = tabelEkspedisi.rows(row).data().toArray()[0]['id'];
                $.ajax({
                    context : {
                        context : "form"
                    },
                    url : "{{ route('adm-surat.hapus', '') }}/"+id,
                    dataType : "json",
                    type : "POST"
                }).done(function(){
                    tabelEkspedisi.ajax.reload();
                });
            }
        });

        $('#btn-export').click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('ekspedisi.excel') }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('ekspedisi.excel') }}";
            });
        });

    })


</script>
@endpush