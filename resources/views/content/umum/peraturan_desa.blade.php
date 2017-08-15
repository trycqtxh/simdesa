@extends('layouts.template')

@section('title', 'Buku Peraturan di Desa')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
	<div class="box box-default" id="peraturan_desa">
        <div class="box-body">
            <div class="btn-group btn-group-sm">
                {{--<button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>--}}
                {{--<button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>--}}
                {{--<button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>--}}
                {{--<button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>--}}
                @permission('add-peraturan-umum')
                <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                @endpermission
                @permission('edit-peraturan-umum')
                <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
                @endpermission
                @permission('remove-peraturan-umum')
                <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
                @endpermission
                @permission('export-peraturan-umum')
                <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
                @endpermission
            </div>
        </div>
    </div>
	<div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered" id="tabel-peraturan_desa">
                <thead>
                    <tr>
                        <th>NOMOR URUT</th>
                        <th>JENIS PERATURAN DI DESA</th>
                        <th>NOMOR DAN TANGGAL DITETAPKAN</th>
                        <th>TENTANG</th>
                        <th>URAIAN SINGKAT</th>
                        <th>Tanggal Kesepakatan Peraturan Desa</th>
                        <th>NOMOR DAN TANGGAL DILAPORKAN</th>
                        <th>NOMOR DAN TANGGAL DIUNDANGKAN DALAM LEMBARAN DESA</th>
                        <th>NOMOR DAN TANGGAL DIUNDANGKAN DALAM BERITA DESA</th>
                        <th>KET.</th>
                    </tr>
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
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@include('modal.umum.peraturan_desa')
@endsection
@push('js')
<script type="text/javascript">
    var tabperaturan_desa = $('div#peraturan_desa');
    var tabelperaturan_desa = $('table#tabel-peraturan_desa').DataTable({
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
            context :{
                context : "table"
            },
            url     : "{{ route('peraturan-desa.index') }}",
            dataSrc : "data.data"
        },
        columnDefs :[
            { 'targets' : [0], 'visible' : false, 'searchable' : false }
        ],
        columns : [
            { data : 'id'},
            { data : 'jenis_peraturan'},
            { data : 'ditetapkan'},
            { data : 'tentang'},
            { data : 'uraian'},
            { data : 'kesepakatan'},
            { data : 'dilaporan'},
            { data : 'diundangkan_lembaran'},
            { data : 'diundangkan_berita'},
            { data : 'keterangan'},
        ]
    }); 
    $(function(){
        $('#btn-tambah').on('click',function(e){
            $('#modal-tambah').modal('show');
        });

        $('#modal-tambah').find('form').submit(function(e){
            $.ajax({
                context :{
                    context: "form"
                },
                url : "{{ route('peraturan-desa.tambah') }}",
                type : "POST",
                dataType : "json",
                data : $('#modal-tambah').find('form').serialize()
            }).done(function(data){
                tabelperaturan_desa.ajax.reload();
            });
            e.preventDefault();
        });

        $('#modal-tambah').on('shown.bs.modal', function(){
            $(this).find('input[name=tanggal_ditetapkan]').datepicker({
                format : 'yyyy-mm-dd'
            });
            $(this).find('input[name=tanggal_peraturan]').datepicker({
                format : 'yyyy-mm-dd'
            });
            $(this).find('input[name=tanggal_dilaporkan]').datepicker({
                format : 'yyyy-mm-dd'
            });
        });

        tabelperaturan_desa.on("select", function(){
            $('#btn-ubah').attr('disabled', false);
            $('#btn-hapus').attr('disabled', false);
        }).on('deselect', function(){
            $('#btn-ubah').prop('disabled', true);
            $('#btn-hapus').prop('disabled', true);
        });

        $('#btn-ubah').on('click', function(){
            var row = tabelperaturan_desa.rows('.selected').indexes();
            var id = tabelperaturan_desa.rows(row).data().toArray()[0]['id'];
            var peraturan = tabelperaturan_desa.rows(row).data().toArray()[0]['jenis_peraturan'];

            console.log(peraturan);
            $.ajax({
                url      : "{{ route('peraturan-desa.cari', '') }}/"+id,
                type     : "GET",
                dataType : "json",
                global   : false
            }).done(function(data){
                if(peraturan == "Peraturan Kepala Desa"){
                    $('#modal-ubah').find('input[name=nomor_ditetapkan]').prop('readonly', true);
                    $('#modal-ubah').find('input[name=tentang]').prop('readonly', true);
                    $('#modal-ubah').find('textarea[name=uraian_singkat]').prop('readonly', true);
                    $('#modal-ubah').find('textarea[name=keterangan]').prop('readonly', true);
                }
                if(peraturan == "Peraturan Desa"){
                    $('#modal-ubah').find('input[name=nomor_ditetapkan]').prop('readonly', false);
                    $('#modal-ubah').find('input[name=tentang]').prop('readonly', false);
                    $('#modal-ubah').find('textarea[name=uraian_singkat]').prop('readonly', false);
                    $('#modal-ubah').find('textarea[name=keterangan]').prop('readonly', false);
                }
                $('#modal-ubah').find('input[name=nomor_dilaporkan]').prop('readonly', true)
                $('#modal-ubah').find('input[name=id]').val(data.data.id);
                $('#modal-ubah').find('input[name=nomor_ditetapkan]').val(data.data.nomor_ditetapkan);
                $('#modal-ubah').find('input[name=tanggal_ditetapkan]').val(data.data.tanggal_ditetapkan);
                $('#modal-ubah').find('input[name=tentang]').val(data.data.tentang);
                $('#modal-ubah').find('textarea[name=uraian_singkat]').val(data.data.uraian);
                $('#modal-ubah').find('input[name=tanggal_peraturan]').val(data.data.tanggal_kesepakatan);
                $('#modal-ubah').find('input[name=no_kesepakatan]').val(data.data.nomor_kesepakatan);
                $('#modal-ubah').find('input[name=nomor_dilaporkan]').val(data.data.nomor_laporan);
                $('#modal-ubah').find('input[name=tanggal_dilaporkan]').val(data.data.tanggal_laporan);
                $('#modal-ubah').find('textarea[name=keterangan]').val(data.data.keterangan);

                $('#modal-ubah').modal('show');
            });

        });


        $('#modal-ubah').on('shown.bs.modal', function(){
            var row = tabelperaturan_desa.rows('.selected').indexes();
            var peraturan = tabelperaturan_desa.rows(row).data().toArray()[0]['jenis_peraturan'];
            if(peraturan == "Peraturan Kepala Desa"){

            }
            if(peraturan == "Peraturan Desa"){
                $(this).find('input[name=tanggal_ditetapkan]').datepicker({
                    format : 'yyyy-mm-dd'
                });
//                $(this).find('input[name=tanggal_dilaporkan]').datepicker({
//                    format : 'yyyy-mm-dd'
//                });
            }
            $(this).find('input[name=tanggal_peraturan]').datepicker({
                format : 'yyyy-mm-dd'
            });
        });

        $('#modal-ubah').find('form').submit(function(e){
            var id = $(this).find('input[name=id]').val();
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('peraturan-desa.ubah', '')  }}/"+id,
                type     : "PUT",
                dataType : "json",
                data     : $(this).serialize()
            }).done(function(){
                tabelperaturan_desa.ajax.reload();
            });
            e.preventDefault();
        });


        $('#btn-hapus').on('click', function(){
            if(confirm('Apakah Yakin Akan Dihapus ?')){
                var row = tabelperaturan_desa.rows('.selected').indexes();
                var id = tabelperaturan_desa.rows(row).data().toArray()[0]['id'];
                $.ajax({
                    context : {
                        context : "form"
                    },
                    url      : "{{ route('peraturan-desa.hapus', '')  }}/"+id,
                    type     : "POST",
                    dataType : "json",
                }).done(function(){
                    tabelperaturan_desa.ajax.reload();
                });
            }
        });

        $('#btn-export').click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('peraturan.excel') }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('peraturan.excel') }}";
            });
        });
        
    })

</script>
@endpush