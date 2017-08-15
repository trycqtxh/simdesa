@extends('layouts.template')

@section('title', 'Data Induk Pekerjaan')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
    <div class="box box-default">
        <div class="box-header">
            <div class="btn-group btn-group-sm">
                @permission('add-pekerjaan-master')
                <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                @endpermission
                @permission('edit-pekerjaan-master')
                <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
                @endpermission
                @permission('remove-pekerjaan-master')
                <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
                @endpermission
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered" id="tabel">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pekerjaan</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    @include('modal.master.pekerjaan')
@endsection

@push('js')
<script type="text/javascript">
    var modalT = $('#modal-tambah');
    var modalU = $('#modal-ubah');
    var btnT = $('#btn-tambah');
    var btnU = $('#btn-ubah');
    var btnH = $('#btn-hapus');
    var tabel = $('#tabel').DataTable({
        ordering  : false,
        paging    : false,
        searching : false,
        select    : {
            style: 'single'
        },
        language  : {
            url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
        },
        ajax      : {
            context : {
                context: "table"
            },
            url     : "{{ route('pekerjaan.index') }}",
            dataSrc : "data.data"
        },
        columns   : [
            {"data" : "id"},
            {"data" : "pekerjaan"}
        ]
    });

    $(function(){
        btnT.click(function(){
            console.log("click");
            modalT.modal('show');
        });

        modalT.find('form').submit(function(e){
            var $form = $(this);
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('pekerjaan.tambah') }}",
                type     : "POST",
                dataType : "json",
                data     : $(this).serialize()
            }).done(function () {
                tabel.ajax.reload();
            });
            e.preventDefault();
        });

        tabel.on('select', function(){
            btnU.attr('disabled', false);
            btnH.attr('disabled', false);
        }).on('deselect', function(){
            btnU.prop('disabled', true);
            btnH.prop('disabled', true);
        });

        btnU.click(function(){
            var row = tabel.rows('.selected').indexes();
            var id = tabel.rows(row).data().toArray()[0]['id'];
            $.ajax({
                url    : "{{ route('pekerjaan.cari', '') }}/"+id,
                type   : "GET",
                dataType : "json",
                global : false,
            }).done(function(data){
                modalU.find('input[name=id]').val(data.data.data.id);
                modalU.find('input[name=kode]').val(data.data.data.kode);
                modalU.find('input[name=pekerjaan]').val(data.data.data.pekerjaan);
                modalU.modal('show');
            });
        });

        modalU.find('form').submit(function(e){
            var id = $(this).find('input[name=id]').val();
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('pekerjaan.ubah', '') }}/"+id,
                type     : "PUT",
                dataType : "json",
                data     : $(this).serialize()
            }).done(function(){
                tabel.ajax.reload();
            });
            e.preventDefault();
        });

        btnH.click(function(){
            if(confirm('Apakah Yakin Akan Dihapus ?')){
                var row = tabel.rows('.selected').indexes();
                var id = tabel.rows(row).data().toArray()[0]['id'];
                $.ajax({
                    context : {
                        context : "form"
                    },
                    url     : "{{ route('pekerjaan.hapus', '') }}/"+id,
                    type    : "POST",
                    dataType: "json",
                }).done(function(){
                    tabel.ajax.reload();
                });
            }
        });
    });

</script>
@endpush