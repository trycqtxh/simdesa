@extends('layouts.template')

@section('title', 'Buku Keputusan Kepala Desa')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
	<div class="box box-default" id="keputusan_kades">
        <div class="box-body">
            <div class="btn-group btn-group-sm">
                {{--<button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>--}}
                {{--<button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>--}}
                {{--<button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>--}}
                {{--<button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>--}}
                @permission('add-keputusan-umum')
                <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                @endpermission
                @permission('edit-keputusan-umum')
                <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
                @endpermission
                @permission('remove-keputusan-umum')
                <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
                @endpermission
                @permission('export-keputusan-umum')
                <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
                @endpermission
            </div>
        </div>
    </div>
	<div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered" id="tabel-keputusan_kades">
                <thead>
                    <tr>
                        <th>NOMOR URUT</th>
                        <th>NOMOR DANTANGGAL KEPUTUSAN KEPALA DESA</th>
                        <th>TENTANG</th>
                        <th>URAIAN SINGKAT</th>
                        <th>NOMOR DAN TANGGAL DILAPORKAN</th>
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
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@include('modal.umum.keputusan_kades')
@endsection
@push('js')
<script type="text/javascript">
    var tabkeputusan_kades = $('div#keputusan_kades');
    var tabelkeputusan_kades = $('table#tabel-keputusan_kades').DataTable({
        ordering     : false,
        paging       : true,
        searching    : true,
        lengthChange: false,
        select    : {
            style: 'single'
        },
        language  : {
            context : {
                context : "table"
            },
            url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
        },
        ajax      : {
            url     : "{{ route('keputusan-kades.index') }}",
            dataSrc : "data.data"
        },
        columnDefs :[
            { 'targets' : [0], 'visible' : false, 'searchable' : false }
        ],
        columns : [
            { data : 'id'},
            { data : 'keputusan'},
            { data : 'judul'},
            { data : 'uraian'},
            { data : 'dilaporkan'},
            { data : 'keterangan'},
        ]
    });

    $(function(){
        $('#btn-tambah').on('click',function(e){
            $('#modal-tambah').modal('show');
        });

        $('#modal-tambah').find('form').submit(function(e){
            $.ajax({
                context : {
                    context: "form"
                },
                url : "{{ route('keputusan-kades.tambah')}}",
                type : "POST",
                dataType : "json",
                data : $(this).serialize()
            }).done(function(data){
                tabelkeputusan_kades.ajax.reload();
            });
            e.preventDefault();
        });

        $('#modal-tambah').on('shown.bs.modal', function(){
            $(this).find('input[name=tanggal_keputusan]').datepicker({
                format: 'yyyy-mm-dd'
            });
            $(this).find('input[name=tanggal_dilaporkan]').datepicker({
                format: 'yyyy-mm-dd'
            });
        });

        tabelkeputusan_kades.on('select', function(){
            $('#btn-ubah').attr('disabled', false);
            $('#btn-hapus').attr('disabled', false);
        }).on('deselect', function(){
            $('#btn-ubah').prop('disabled', true);
            $('#btn-hapus').prop('disabled', true);
        });

        $('#btn-ubah').on('click', function(){
            var row = tabelkeputusan_kades.rows('.selected').indexes();
            var id = tabelkeputusan_kades.rows(row).data().toArray()[0]['id'];
            $.ajax({
                url      : "{{ route('peraturan-desa.cari', '') }}/"+id,
                type     : "GET",
                dataType : "json",
                global   : false
            }).done(function(data){
                $('#modal-ubah').find('input[name=id]').val(data.data.id);
                $('#modal-ubah').find('input[name=nomor_keputusan]').val(data.data.nomor_ditetapkan);
                $('#modal-ubah').find('input[name=tanggal_keputusan]').val(data.data.tanggal_ditetapkan);
                $('#modal-ubah').find('input[name=tentang]').val(data.data.tentang);
                $('#modal-ubah').find('textarea[name=uraian_singkat]').val(data.data.uraian);
                $('#modal-ubah').find('input[name=nomor_dilaporkan]').val(data.data.nomor_laporan);
                $('#modal-ubah').find('input[name=tanggal_dilaporkan]').val(data.data.tanggal_laporan);
                $('#modal-ubah').find('textarea[name=keterangan]').val(data.data.keterangan);
                $('#modal-ubah').modal('show');
            });

        });

        $('#modal-ubah').on('shown.bs.modal', function(){
            $(this).find('input[name=tanggal_keputusan]').datepicker({
                format: 'yyyy-mm-dd'
            });
            $(this).find('input[name=tanggal_dilaporkan]').datepicker({
                format: 'yyyy-mm-dd'
            });
        });

        $('#modal-ubah').find('form').submit(function(e){
            var id = $(this).find('input[name=id]').val();
            $.ajax({
                context : {
                    context: "form"
                },
                url : "{{ route('keputusan-kades.ubah', '') }}/"+id,
                type : "PUT",
                dataType : "json",
                data : $(this).serialize()
            }).done(function(data){
                tabelkeputusan_kades.ajax.reload();
            });
            e.preventDefault();
        });

        $('#btn-hapus').on('click', function(){
            if(confirm('Apakah Yakin Akan Dihapus ?')){
                var row = tabelkeputusan_kades.rows('.selected').indexes();
                var id = tabelkeputusan_kades.rows(row).data().toArray()[0]['id'];
                $.ajax({
                    context : {
                        context : "form"
                    },
                    url      : "{{ route('keputusan-kades.hapus', '')  }}/"+id,
                    type     : "POST",
                    dataType : "json",
                }).done(function(){
                    tabelkeputusan_kades.ajax.reload();
                });
            }
        });

        $('#btn-export').click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('keputusan.excel') }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('keputusan.excel') }}";
            });
        });
        
    });


</script>
@endpush