@extends('layouts.template')

@section('title', 'Rancangan Pendapatan APBD')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title') Tahun {{ $current_year }}
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection


@section('content-main')
    <div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered table-striped table-responsive" id="tabel">
                <thead>
                <tr>
                    <th rowspan="2" width="75px">#</th>
                    <th colspan="4" width="8%">KODE REKENING</th>
                    <th>URAIAN</th>
                    <th>ANGGARAN (Rp.)</th>
                    <th>KETERANGAN</th>
                </tr>
                <tr>
                    <th colspan="4">1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    @include('modal.perencanaan.pendapatan')
@endsection

@push('js')
<script type="text/javascript">
    var modalTambah = $("#modal-tambah-sub-bidang");
    var modalTambahPendapatan = $("#modal-tambah-pendapatan");
    var modalUbah = $("#modal-ubah-sub-bidang");
    var modalUbahPendapatan = $("#modal-ubah-pendapatan");

    var tabel = $("table#tabel").DataTable({
        ordering     : false,
        info         : false,
        paging       : false,
        searching    : false,
        lengthChange : false,
        scrollX      : false,
        fixedHeader  : true,
        select    : {
            style: 'single'
        },
        ajax      : {
            context : {
                context: 'table'
            },
            url     : "{{ route('pendapatan.index') }}",
            dataSrc : "data"
        },
        columns   : [
            {"data" : "act"},
            {"data" : "kode_1"},
            {"data" : "kode_2"},
            {"data" : "kode_3"},
            {"data" : "kode_4"},
            {"data" : "uraian"},
            {"data" : "anggaran", 'className': 'text-right'},
            {"data" : "keterangan"},
        ]
    });

    function tambah_subpendapatan(id, uraian, jenis){
        modalTambah.find('.modal-title').text(uraian);
        modalTambah.find('input[name=jenis]').val(jenis);
        modalTambah.find('input[name=bidang]').val(id);
        modalTambah.modal("show");
    }

    function tambah_pendapatan(id, uraian, jenis){
        modalTambahPendapatan.find('.modal-title').text(uraian);
        modalTambahPendapatan.find('input[name=jenis]').val(jenis);
        modalTambahPendapatan.find('input[name=sub_pendapatan]').val(id);
        modalTambahPendapatan.modal("show");
    }

    function ubah_pendapatan(id, uraian, jenis){
        modalUbah.find('.modal-title').text('Form Ubah '+uraian);
        modalUbah.find('input[name=id]').val(id);
        modalUbah.find('input[name=jenis]').val(jenis);
        modalUbah.find('input[name=uraian]').val(uraian);
        modalUbah.modal("show");

    }

    function ubah_subpendapatan(id, uraian, jenis){
        $.ajax({
            global     : false,
            dataType   : "json",
            type       : "GET",
            url        : "{{ route('pendapatan.cari', '') }}/"+id
        }).done(function(data){
            var pen = data.data.data;
            modalUbahPendapatan.find('.modal-title').text("Form Ubah "+pen.uraian);
            modalUbahPendapatan.find('input[name=jenis]').val(jenis);
            modalUbahPendapatan.find('input[name=sub_pendapatan]').val(pen.id);
            modalUbahPendapatan.find('input[name=id]').val(pen.id);
            modalUbahPendapatan.find('input[name=uraian]').val(pen.uraian);
            modalUbahPendapatan.find('input[name=anggaran]').val(pen.anggaran);
            modalUbahPendapatan.find('textarea[name=keterangan]').val(pen.keterangan);
            modalUbahPendapatan.modal("show");
        });
    }

    function hapus(id, uraian, jenis){
        if(confirm('Apakah Anda Yakin "'+uraian+'" Akan Dihapus ?')){
            $.ajax({
                context   : {
                    context  : "form"
                },
                dataType  : "json",
                type      : "POST",
                url       : "{{ route('pendapatan.hapus', '') }}/"+id
            }).done(function(){
                tabel.ajax.reload();
            });
        }
        return false;
    }

    $(function(){

        $('input[name=anggaran]').inputmask({alias: "rupiah"});

        modalTambah.find('form').submit(function(e){
            var jenis = $(this).find("input[name=jenis]").val();
            $.ajax({
                context  : {
                    context: "form"
                },
                type     : "POST",
                dataType : "json",
                url      : "{{ route('pendapatan.tambah', '') }}/"+jenis,
                data     : $(this).serialize()
            }).done(function(){
                tabel.ajax.reload();
            });
            e.preventDefault();
        });
        modalTambahPendapatan.find('form').submit(function(e){            
            $('input[name=anggaran]').inputmask('remove');

            var jenis = $(this).find("input[name=jenis]").val();
            $.ajax({
                context  : {
                    context: "form"
                },
                type     : "POST",
                dataType : "json",
                url      : "{{ route('pendapatan.tambah', '') }}/"+jenis,
                data     : $(this).serialize()
            }).done(function(){
                tabel.ajax.reload();
            }).fail(function(){
                $('input[name=anggaran]').inputmask({alias: "rupiah"});
            });
            e.preventDefault();
        });
        modalUbah.find('form').submit(function(e){
            var id = $(this).find('input[name=id]').val();
            $.ajax({
                context  : {
                    context: "form"
                },
                type     : "PUT",
                dataType : "json",
                url      : "{{ route('pendapatan.ubah', ['jenis'=>'sub-bidang', 'id'=>'']) }}/"+id,
                data     : $(this).serialize()
            }).done(function(){
                tabel.ajax.reload();
            });
            e.preventDefault();
        });
        modalUbahPendapatan.find('form').submit(function(e){
            $('input[name=anggaran]').inputmask('remove');

            var id = $(this).find('input[name=id]').val();
            $.ajax({
                context  : {
                    context: "form"
                },
                type     : "PUT",
                dataType : "json",
                url      : "{{ route('pendapatan.ubah', ['jenis'=>'pendapatan', 'id'=>'']) }}/"+id,
                data     : $(this).serialize()
            }).done(function(){
                tabel.ajax.reload();
            }).fail(function(){
                $('input[name=anggaran]').inputmask({alias: "rupiah"});
            });
            e.preventDefault();
        });
    });
</script>
@endpush