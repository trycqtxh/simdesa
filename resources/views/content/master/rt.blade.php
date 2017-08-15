@extends('layouts.template')

@section('title', 'Data Induk RT')

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
                @permission('add-rt-master')
                <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                @endpermission
                @permission('edit-rt-master')
                <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
                @endpermission
                @permission('remove-rt-master')
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
                    <th>RW</th>
                    <th>RT</th>
                    <th>Petugas RT</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    @include('modal.master.rt')
@endsection

@push('js')
<script type="text/javascript">
    var modalTambah = $('div#modal-tambah');
    var modalUbah = $('div#modal-ubah');
    var formTambah = modalTambah.find("form#form-tambah");
    var formUbah = modalUbah.find("form#form-ubah");
    var btnTambah = $("button#btn-tambah");
    var btnUbah = $("button#btn-ubah");
    var btnHapus = $("button#btn-hapus");
    var tabel = $("table#tabel").DataTable({
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
            url     : "{{ route('rt.index') }}",
            dataSrc : "data.data"
        },
        columns   : [
            {"data" : "rw",},
            {"data" : "rt",},
            {"data" : "petugas",}
        ]
    });

    $(function(){
        tabel.on('select', function(){
            btnUbah.attr('disabled', false);
            btnHapus.attr('disabled', false);
        }).on('deselect', function(){
            btnUbah.prop('disabled', true);
            btnHapus.prop('disabled', true);
        });

        btnTambah.on('click', function(e){
            $('input[name=rt]').inputmask({mask: "99"});
            modalTambah.modal("show");
        });

        btnUbah.on('click', function(e){
            var row = tabel.rows('.selected').indexes();
            var id = tabel.rows(row).data().toArray()[0]['id'];
            $.ajax({
                url : "{{ route('rt.cari', '') }}/"+id,
                type : "GET",
                dataType : "json",
                global : false,
            }).done(function(data){
                formUbah.find("select[name='rw']").val(data.data.data.rw_id);
                formUbah.find("input[name='rt']").val(data.data.data.rt);
                formUbah.find("input[name='id']").val(data.data.data.id);
                formUbah.find("input[name='petugas']").val(data.data.data.petugas);
                formUbah.find("select[name='rw']").selectpicker('refresh');
                modalUbah.modal("show");
            });
        });

        btnHapus.on('click', function(e){
            var row = tabel.rows('.selected').indexes();
            var id = tabel.rows(row).data().toArray()[0]['id'];

            if(confirm("Apakah Yakin Akan Dihapus ?")){
                $.ajax({
                    context : {
                        context : "form"
                    },
                    url : "{{ route('rt.hapus', '') }}/"+id,
                    type : "POST",
                    dataType : "json"
                }).done(function(){
                    tabel.ajax.reload();
                });
            }
            return false;
        });

        formTambah.submit(function(event){
            $.ajax({
                context : {
                    context : "form"
                },
                type     : "POST",
                dataType : "json",
                url      : "{{ route('rt.tambah') }}",
                data     : {
                    rt : formTambah.find('input[name="rt"]').val(),
                    rw : formTambah.find('select[name="rw"]').val(),
                    petugas : formTambah.find('input[name="petugas"]').val(),
                }
            }).done(function(){
                tabel.ajax.reload();
            });
            event.preventDefault();
        });

        formUbah.submit(function(event){
            var id = formUbah.find("input[name='id']").val();
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('rt.ubah', '') }}/"+id,
                type     : "PUT",
                dataType : "json",
                data     : {
                    rt : formUbah.find('input[name="rt"]').val(),
                    rw : formUbah.find('select[name="rw"]').val(),
                    petugas : formUbah.find('input[name="petugas"]').val(),
                }
            }).done(function(){
                tabel.ajax.reload();
            });
            event.preventDefault();
        });

        modalTambah.on("hidden.bs.modal", function(){
            formTambah[0].reset();
        });

        modalUbah.on("hidden.bs.modal", function(){
            formUbah[0].reset();
        });
    });
</script>
@endpush