@extends('layouts.template')

@section('title', 'Data Penduduk Sementara')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
    <div class="box box-default" id="sementara">
        <div class="box-body">
            <div class="btn-group btn-group-sm">
                <button class="btn btn-default" id="btn-lihat" disabled><i class="fa fa-search-plus"></i> Lihat</button>
                @permission('add-sementara-penduduk')
                <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                @endpermission
                @permission('export-sementara-penduduk')
                <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
                @endpermission
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered" id="tabel-sementara">
                <thead>
                <tr>
                    <th rowspan="3"># </th>
                    <th rowspan="2">NAMA LENGKAP </th>
                    <th colspan="2">JENIS KELAMIN</th>
                    <th rowspan="2">NOMOR IDENTITAS/TANDA PENGENAL</th>
                    <th rowspan="2">TEMPAT & TANGGAL LAHIR</th>
                    <th rowspan="2">PEKERJAAN</th>
                    <th colspan="2">KE WARGANEGARAAN</th>
                    <th rowspan="2">DATANG DARI</th>
                    <th rowspan="2">MAKSUD DAN TUJUAN KEDATANGAN</th>
                    <th rowspan="2">NAMA DAN ALAMAT YANG DIDATANGANI</th>
                    <th rowspan="2">DATANG TANGGAL</th>
                    <th rowspan="2">PERGI TANGGAL</th>
                    <th rowspan="2">KETERANGAN</th>
                </tr>
                <tr>
                    <th>L</th>
                    <th>P</th>
                    <th>KEBANGSAAN</th>
                    <th>KETURUNAN</th>
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
                    <th>14</th>
                    <th>15</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
    @include('modal.penduduk.sementara')
@endsection

@push('js')
<script type="text/javascript">
    var modalTambahSementara = $('#modal-tambah-sementara');
    var modalLihatSementara = $('#modal-lihat-sementara');
    var formTambahSementara = modalTambahSementara.find('form#form-tambah-sementara');
    var tabSementara = $('div#sementara');
    var btnTambahSementara = tabSementara.find('button#btn-tambah');
    var btnLihatSementara = tabSementara.find('button#btn-lihat');
    var btnExportSementara = tabSementara.find('button#btn-export');
    var tabelSementara = $('table#tabel-sementara').DataTable({
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
            context : {
                context: "table"
            },
            url     : "{{ route('sementara.index') }}",
            dataSrc : "data.data"
        },
        columns   : [
            {"data" : "id"},
            {"data" : "nama"},
            {"data" : "laki"},
            {"data" : "perempuan"},
            {"data" : "no_identitas"},
            {"data" : "tempat_tanggal_lahir"},
            {"data" : "pekerjaan"},
            {"data" : "kewarga_negaraan"},
            {"data" : "keturunan"},
            {"data" : "datang_dari"},
            {"data" : "maksud_tujuan"},
            {"data" : "alamat_tujuan"},
            {"data" : "datang_tanggal"},
            {"data" : "pergi_tanggal"},
            {"data" : "keterangan"},
        ],
        columnDefs :[
            { 'targets' : [0], 'visible' : false, 'searchable' : false }
        ]
    });



    $(function(){
        {{-- TAMBAH SEMENTARA --}}
        tabSementara.find('button#btn-tambah').on('click', function(event){
            
            modalTambahSementara.modal("show");
        });

        $('select[name=jenis_identitas]').on('change',function(){
            if ($(this).val()=='KTP') {
                $('input[name=no_identitas]').inputmask({mask: "999999-999999-9999"});
            }else if ($(this).val()=='PASPORT'){
                $('input[name=no_identitas]').inputmask({mask: "******-******-******-******-******-******-******"});
            }
        });

        formTambahSementara.submit(function(event){
            $('input[name=no_identitas]').inputmask('remove');
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('sementara.tambah') }}",
                type     : "POST",
                dataType : "json",
                data     : formTambahSementara.serialize()
            }).done(function(){
                tabelSementara.ajax.reload();
            });
            event.preventDefault();
        });

        {{-- UBAH SEMENTARA --}}
        tabelSementara.on('select', function(){
            btnLihatSementara.attr('disabled', false);
        }).on('deselect', function(){
            btnLihatSementara.prop('disabled', true);
        });

        btnLihatSementara.on('click', function(){
            var row = tabelSementara.rows('.selected').indexes();
            var id = tabelSementara.rows(row).data().toArray()[0]['id'];
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('sementara.cari', '') }}/"+id,
                type     : "GET",
                dataType : "json",
                global   : false,
            }).done(function(data){
                modalLihatSementara.find("td[sementara='nama']").text(data.data.data.nama);
                modalLihatSementara.find("td[sementara='jenis_kelamin']").text(data.data.data.laki+data.data.data.perempuan);
                modalLihatSementara.find("td[sementara='no_identitas']").text(data.data.data.no_identitas);
                modalLihatSementara.find("td[sementara='tempat_tanggal_lahir']").text(data.data.data.tempat_tanggal_lahir);
                modalLihatSementara.find("td[sementara='pekerjaan']").text(data.data.data.pekerjaan);
                modalLihatSementara.find("td[sementara='kewarga_negaraan']").text(data.data.data.kewarga_negaraan);
                modalLihatSementara.find("td[sementara='keturunan']").text(data.data.data.keturunan);
                modalLihatSementara.find("td[sementara='datang_dari']").text(data.data.data.datang_dari);
                modalLihatSementara.find("td[sementara='maksud_tujuan']").text(data.data.data.maksud_tujuan);
                modalLihatSementara.find("td[sementara='alamat_tujuan']").text(data.data.data.alamat_tujuan);
                modalLihatSementara.find("td[sementara='datang_tanggal']").text(data.data.data.datang_tanggal);
                modalLihatSementara.find("td[sementara='pergi_tanggal']").text(data.data.data.pergi_tanggal);
                modalLihatSementara.find("td[sementara='keterangan']").text(data.data.data.keterangan);
                modalLihatSementara.modal("show");
            });
        });

        {{-- EVENT MODAL SEMENTARA --}}
        modalTambahSementara.on("shown.bs.modal", function(){
            formTambahSementara.find("input[name='tanggal_lahir']").datepicker({
                format : 'yyyy-mm-dd',
                autoclose:true,
                endDate: "today",
                startDate :'1917-01-01'
            });
            formTambahSementara.find("input[name='tanggal_datang']").datepicker({
                format : 'yyyy-mm-dd'
            });
            formTambahSementara.find("input[name='tanggal_datang']").change(function(){
                formTambahSementara.find("input[name='tanggal_pergi']").datepicker({
                    format : 'yyyy-mm-dd',
                    startDate : formTambahSementara.find("input[name='tanggal_datang']").val(),
                    leftArrow: '&laquo;',
                    rightArrow: '&raquo;'
                    //moment(formTambahSementara.find("input[name='tanggal_datang']").val(),'YYYY-MM-DD')
                });
            });

            
        });
        modalTambahSementara.on("hidden.bs.modal", function(){
            $(".selectpicker").val('').selectpicker('refresh');
            formTambahSementara[0].reset();
        });

        btnExportSementara.click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('sementara.excel') }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('sementara.excel') }}";
            });
        });
    })
</script>
@endpush