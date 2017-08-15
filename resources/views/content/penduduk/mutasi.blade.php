@extends('layouts.template')

@section('title', 'Data Penduduk Mutasi')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
    <div class="box box-default" id="mutasi">
        <div class="box-body">
            <div class="btn-group btn-group-sm">
                @permission('add-datang-mutasi-penduduk')
                <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                @endpermission
                <button class="btn btn-default" id="btn-lihat" disabled><i class="fa fa-search-plus"></i> Lihat</button>
                @permission('export-mutasi-penduduk')
                <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
                @endpermission
            </div>
        </div>
    </div>
    <div class="box box-default" id="mutasi">
            <table class="table table-bordered" id="tabel-mutasi">
                <thead>
                <tr>
                    <th rowspan="3"></th>
                    <th rowspan="2">NAMA LENGKAP / PANGGILAN</th>
                    <th colspan="2">TEMPAT & TANGGAL LAHIR</th>
                    <th rowspan="2">JENIS KELAMIN</th>
                    <th rowspan="2">KE WARGANEGARAAN</th>
                    <th colspan="2">PENAMBAHAN</th>
                    <th colspan="4">PENGURANGAN</th>
                    <th rowspan="2">KET</th>
                </tr>
                <tr>
                    <th>TEMPAT LAHIR</th>
                    <th>TGL</th>
                    <th>DATANG DARI</th>
                    <th>TANGGAL</th>
                    <th>PINDAH KE</th>
                    <th>TANGGAL</th>
                    <th>MENINGGAL</th>
                    <th>TANGGAL</th>
                </tr>
                <tr>

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
            </table>

        </div>
    </div>
    @include('modal.penduduk.mutasi')
@endsection

@push('js')
<script type="text/javascript">
    var modalTambahMutasi = $('#modal-tambah-mutasi');
    var modalLihatMutasi = $('#modal-lihat-mutasi');
    var formTambahMutasi = modalTambahMutasi.find('form#form-tambah-mutasi');
    var tabMutasi = $('div#mutasi');
    var btnTambahMutasi = tabMutasi.find('button#btn-tambah');
    var btnLihatMutasi = tabMutasi.find('button#btn-lihat');
    var btnExportMutasi = tabMutasi.find('button#btn-export');
    var tabelMutasi = $('table#tabel-mutasi').DataTable({
        ordering     : false,
        paging       : true,
        searching    : true,
        lengthChange: false,
//        scrollX      : true,
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
            context : {
                context: "table"
            },
            url     : "{{ route('mutasi.index') }}",
            dataSrc : "data.data"
        },
        columns   : [
            {"data" : "id"},
            {"data" : "nama"},
            {"data" : "tempat_lahir"},
            {"data" : "tanggal_lahir"},
            {"data" : "jenis_kelamin"},
            {"data" : "kewarga_negaraan"},
            {"data" : "datang_dari"},
            {"data" : "datang_tanggal"},
            {"data" : "pindah_ke"},
            {"data" : "pindah_tanggal"},
            {"data" : "meninggal"},
            {"data" : "meninggal_tanggal"},
            {"data" : "keterangan"},
        ],
        columnDefs :[
            { 'targets' : [0], 'visible' : false, 'searchable' : false }
        ]
    });

    $(function(){
        {{-- TAMBAH MUTASI --}}
        btnTambahMutasi.on('click', function(event){
             $('input[name=nik]').inputmask({mask: "999999-999999-9999"});
            modalTambahMutasi.modal("show");
        });

        formTambahMutasi.submit(function(event){
            $('input[name=nik]').inputmask('remove');
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('mutasi.tambah') }}",
                type     : "POST",
                dataType : "json",
                data     : formTambahMutasi.serialize()
            }).done(function(){
                tabelMutasi.ajax.reload();
            }).fail(function(){
                $('input[name=nik]').inputmask({mask: "999999-999999-9999"});
            });
            event.preventDefault();
        });

        {{-- UBAH MUTASI --}}
        tabelMutasi.on('select', function(){
            btnLihatMutasi.attr('disabled', false);
        }).on('deselect', function(){
            btnLihatMutasi.prop('disabled', true);
        });

        btnLihatMutasi.on('click', function(){
            var row = tabelMutasi.rows('.selected').indexes();
            var id = tabelMutasi.rows(row).data().toArray()[0]['id'];
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('mutasi.cari', '') }}/"+id,
                type     : "GET",
                dataType : "json",
                global   : false,
            }).done(function(data){
                console.log(data.data.data);
                modalLihatMutasi.modal("show");
                modalLihatMutasi.find("td[mutasi='nama']").text(data.data.data.nama);
                modalLihatMutasi.find("td[mutasi='tempat_lahir']").text(data.data.data.tempat_lahir);
                modalLihatMutasi.find("td[mutasi='tanggal_lahir']").text(data.data.data.tanggal_lahir);
                modalLihatMutasi.find("td[mutasi='jenis_kelamin']").text(data.data.data.jenis_kelamin);
                modalLihatMutasi.find("td[mutasi='kewarga_negaraan']").text(data.data.data.kewarga_negaraan);
                var text_daerah = '';
                if(data.data.data.jenis == "MASUK"){
                    modalLihatMutasi.find("td[mutasi='text_daerah']").text('Datang Dari');
                }
                if(data.data.data.jenis == "KELUAR"){
                    modalLihatMutasi.find("td[mutasi='text_daerah']").text('Pindah Ke');
                }
                if(data.data.data.jenis == "MATI"){
                    modalLihatMutasi.find("td[mutasi='text_daerah']").text('Meninggal di');
                }
                modalLihatMutasi.find("td[mutasi='tanggal']").text(data.data.data.meninggal_tanggal+data.data.data.pindah_tanggal+data.data.data.datang_tanggal);
                modalLihatMutasi.find("td[mutasi='daerah']").text(data.data.data.meninggal+data.data.data.pindah_ke+data.data.data.datang_dari);

            });
        });

        {{-- EVENT MODAL MUTASI --}}
        modalTambahMutasi.on("shown.bs.modal", function(){
            formTambahMutasi.find("input[name='tanggal_lahir']").datepicker({
                format : 'yyyy-mm-dd'
            });
            formTambahMutasi.find("input[name='tanggal_datang']").datepicker({
                format : 'yyyy-mm-dd'
            });
        });
        modalTambahMutasi.on("hidden.bs.modal", function(){
            $(".selectpicker").val('').selectpicker('refresh');
            formTambahMutasi[0].reset();
        });

        btnExportMutasi.click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('mutasi.excel') }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('mutasi.excel') }}";
            });
        });

    })
</script>
@endpush