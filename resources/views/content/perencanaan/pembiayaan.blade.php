@extends('layouts.template')

@section('title', 'Rancangan Pembiayaan APBD')

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
            <table class="table table-bordered" id="tabel">
                <thead>
                <tr>
                    <th rowspan="2" style="width: 75px">#</th>
                    <th colspan="4"  width="8%">Kode Rekening</th>
                    <th>Uraian</th>
                    <th>Anggaran (Rp.)</th>
                    <th>Keterangan</th>
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
    @include('modal.perencanaan.pembiayaan')
@endsection

@push('js')
<script type="text/javascript">
    var modalTambah = $("#modal-tambah-pembiayaan");
    var modalUbah = $("#modal-ubah-pembiayaan");

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
            url     : "{{ route('pembiayaan.index') }}",
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

    function tambah(id, uraian, jenis){
        modalTambah.find('.modal-title').text(uraian);
        modalTambah.find('input[name=jenis]').val(jenis);
        modalTambah.find('input[name=bidang]').val(id);
        modalTambah.modal("show");
    }


    function ubah(id, uraian, jenis){
        $.ajax({
            global : false,
            dataType : "json",
            type     : "GET",
            url      : "{{ route('pembiayaan.cari', '') }}/"+id
        }).done(function(data){
            var pem = data.data.data;
            console.log(pem);
            modalUbah.find('.modal-title').text("Form Ubah "+pem.uraian);
            modalUbah.find('input[name=uraian]').val(pem.uraian);
            modalUbah.find('input[name=anggaran]').val(pem.anggaran);
            modalUbah.find('input[name=jenis]').val(jenis);
            modalUbah.find('input[name=id]').val(id);
            modalUbah.find('input[name=keterangan]').val(pem.keterangan);
            modalUbah.modal("show");
        });
    }

    function hapus(id, uraian, jenis){
        if(confirm('Apakah Anda Yakin "'+uraian+'" Akan Dihapus ?')){
            $.ajax({
                context : {
                    context : "form"
                },
                type    : "POST",
                dataType: "json",
                url     : "{{ route('pembiayaan.hapus', '') }}/"+id
            }).done(function(){
                tabel.ajax.reload();
            });
        }
        return false;
    }

    $(function(){
        $('input[name=anggaran]').inputmask({alias:"rupiah"});
        
        modalTambah.find("form").submit(function(e){
            $('input[name=anggaran]').inputmask('remove');
            $.ajax({
                context : {
                    context : "form"
                },
                type     : "POST",
                dataType : "json",
                url      : "{{ route('pembiayaan.tambah', ['jenis'=>'sub-bidang']) }}",
                data     : $(this).serialize()
            }).done(function(){
                tabel.ajax.reload();
            }).fail(function(){
                $('input[name=anggaran]').inputmask({alias: "rupiah"});
            });
            e.preventDefault();
        });
        modalUbah.find("form").submit(function(e){
            $('input[name=anggaran]').inputmask('remove');
            var id = $(this).find('input[name=id]').val();
            $.ajax({
                context : {
                    context : "form"
                },
                type     : "PUT",
                dataType : "json",
                url      : "{{ route('pembiayaan.ubah', ['sub-bidang', '']) }}/"+id,
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
