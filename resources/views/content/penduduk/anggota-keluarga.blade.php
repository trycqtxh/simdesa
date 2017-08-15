@extends('layouts.template')

@section('title', 'Data Kartu Keluarga')

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
        <div class="box-body">
            @permission('add-kk-penduduk')
            <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
            @endpermission
            @permission('edit-kk-penduduk')
            <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
            @endpermission
            @permission('remove-kk-penduduk')
            <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
            @endpermission
            @permission('export-kk-penduduk')
            <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
            @endpermission

            {{--<button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>--}}
            {{--<button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>--}}
            {{--<button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>--}}
            {{--<button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>--}}
        </div>
    </div>
    <div class="nav-tabs-custom" style="cursor: move;">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right ui-sortable-handle">
            <li class="active"><a href="#kartu-keluarga" data-toggle="tab" aria-expanded="false">Kartu Keluaga</a></li>
            <li ><a href="#kepala-keluarga" data-toggle="tab" aria-expanded="true">Kepala Keluarga</a></li>

        </ul>
        <div class="tab-content no-padding">
            <!-- Morris chart - Sales -->
            <div class="tab-pane active" id="kartu-keluarga">
                <table class="table table-bordered" id="table-kartu-keluarga">
                    <thead>
                    <tr>
                        <th>Nomor KK</th>
                        <th>Kepala Keluarga</th>
                        <th>Tanggal Dikeluarkan</th>
                        <th>Tempat Dikeluarkan</th>
                        <th>Tanggal Mulai Didesa</th>
                        <th>Keterangan</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane" id="kepala-keluarga">
                <table class="table table-bordered" id="table">
                    <thead>
                    <tr>
                        <th rowspan="2">NOMOR URUT</th>
                        <th rowspan="2">NO KK</th>
                        <th rowspan="2">NAMA LENGKAP</th>
                        <th rowspan="2">NIK</th>
                        <th rowspan="2">JENIS KELMIN</th>
                        <th rowspan="2">TEMPAT / TANGGAL LAHIR</th>
                        <th rowspan="2">Gol Darah</th>
                        <th rowspan="2">AGAMA</th>
                        <th rowspan="2">PENDIDIKAN</th>
                        <th rowspan="2">PEKERJAAN</th>
                        <th rowspan="2">ALAMAT</th>
                        <th rowspan="2">STATUS PERKAWINAN</th>
                        <th rowspan="2">TEMPAT DAN TANGGAL DI KELUARKAN</th>
                        <th rowspan="2">STATUS HUB KELUARGA</th>
                        <th rowspan="2">KEWARGANEGARAAN</th>
                        <th colspan="2">ORANG TUA</th>
                        <th rowspan="2">TGL MULAI TINGGAL DI DESA</th>
                        <th rowspan="2">KET</th>
                    </tr>
                    <tr>
                        <th>AYAH</th>
                        <th>IBU</th>
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
                        <th>14</th>
                        <th>15</th>
                        <th>16</th>
                        <th>17</th>
                        <th>18</th>
                        <th>19</th>
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
    </div>
    @include('modal.penduduk.anggota-keluarga')
@endsection

@push('js')
<script type="text/javascript">
    var modalTambahKK = $('#modal-tambah-kk');
    var modalUbahKK = $('#modal-ubah-kk');
    var btnTambah = $('#btn-tambah');
    var btnUbah = $('#btn-ubah');
    var btnHapus = $('#btn-hapus');
    var btnExport = $('#btn-export');

    var tabelKK = $('#table-kartu-keluarga').DataTable({
        ordering     : false,
        paging       : false,
        searching    : false,
        lengthChange : false,
        select    : {
            style: 'single'
        },
        language  : {
            url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
        },
        ajax    : {
            context : {
                context: "table"
            },
            url     : "{{ url()->current() }}",
            dataSrc : 'kartu_keluarga'
        },
        columns : [
            {'data' : 'nomor_kk'},
            {'data' : 'kepala_keluarga'},
            {'data' : 'tanggal_dikeluarkan'},
            {'data' : 'tempat_dikeluarkan'},
            {'data' : 'tanggal_mulai_di_desa'},
            {'data' : 'keterangan'},
        ]
    });
    var tabel = $('#table').DataTable({
        ordering     : false,
        paging       : true,
        searching    : true,
        lengthChange : false,
        scrollX      : true,
        scrollY      : "400px",
        fixedHeader  : true,
        scrollCollapse: true,
        scroller     : true,
        stateSave:      true,
        select    : {
            style: 'single'
        },
        language  : {
            url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
        },
        ajax    : {
            context : {
                context: "table"
            },
            url     : "{{ url()->current() }}",
            dataSrc : 'data.data'
        },
        columns : [
            {'data' : 'id'},
            {'data' : 'nomor_kk'},
            {'data' : 'nama'},
            {'data' : 'nik'},
            {'data' : 'jenis_kelamin'},
            {'data' : 'tempat_tanggal_lahir'},
            {'data' : 'golongan_darah'},
            {'data' : 'agama'},
            {'data' : 'pendidikan'},
            {'data' : 'pekerjaan'},
            {'data' : 'alamat'},
            {'data' : 'status_perkawinan'},
            {'data' : 'tempat_tanggal_dikeluarkan'},
            {'data' : 'status_keluarga'},
            {'data' : 'kewarga_negaraan'},
            {'data' : 'ayah'},
            {'data' : 'ibu'},
            {'data' : 'tanggal_mulai_di_desa'},
            {'data' : 'keterangan'},
        ]
    });
    var modalAyah = $('#modal-tambah-ayah');
    var modalIbu = $('#modal-tambah-ibu');
    function tambah_ayah(nik, nama, id){
        modalAyah.find('input[name=id]').val(id);
        modalAyah.find('input[name=nik]').val(nik);
        modalAyah.find('input[name=nama]').val(nama);
        modalAyah.modal("show");
        return false;
    }

    function tambah_ibu(nik, nama, id){
        modalIbu.find('input[name=id]').val(id);
        modalIbu.find('input[name=nik]').val(nik);
        modalIbu.find('input[name=nama]').val(nama);
        modalIbu.modal("show");
        return false;
    }

    $(function(){
        $('input[name=nomor_kk]').inputmask({alias: "nik"});
        modalAyah.find("form").submit(function(e){
            var id = $(this).find('input[name=id]').val();
            $.ajax({
                context: {
                    context: "form"
                },
                type: "PUT",
                dataType: "json",
                data: $(this).val(),
                url : "{{ route('induk.ubah.ortu.ayah', '') }}/"+id
            }).done(function(){
                tabel.ajax.reload();
                tabelKK.ajax.reload();
            });
            e.preventDefault();
        });
        modalIbu.find("form").submit(function(e){
            var id = $(this).find('input[name=id]').val();
            $.ajax({
                context: {
                    context: "form"
                },
                type: "PUT",
                dataType: "json",
                data: $(this).val(),
                url : "{{ route('induk.ubah.ortu.ibu', '') }}/"+id
            }).done(function(){
                tabel.ajax.reload();
                tabelKK.ajax.reload();
            });
            e.preventDefault();
        });
        $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });

        $('input[name=tanggal_dikeluarkan]').datepicker({
            format : 'yyyy-mm-dd',
                autoclose:true,
                endDate: "today",
                startDate :'1917-01-01'
        });
        $('input[name=tanggal_mulai_didesa]').datepicker({
            format : 'yyyy-mm-dd',
                autoclose:true,
                endDate: "today",
                startDate :'1917-01-01'
        });

        btnTambah.click(function(){
            modalTambahKK.modal("show");
        });
        modalTambahKK.find('form').submit(function(e){
            $.ajax({
                context:{
                    context: "form"
                },
                type     : "POST",
                dataType : "json",
                data     : $(this).serialize(),
                url      : "{{ route('penduduk.anggota-keluarga.tambah') }}"
            }).done(function(){
                tabelKK.ajax.reload();
            });
            e.preventDefault();
        });
        tabelKK.on('select', function(){
            btnUbah.attr('disabled', false);
            btnHapus.attr('disabled', false);
        }).on('deselect', function(){
            btnUbah.prop('disabled', true);
            btnHapus.prop('disabled', true);
        });
        btnUbah.click(function(){
            var row = tabelKK.rows('.selected').indexes();
            var nomor_kk = tabelKK.rows(row).data().toArray()[0]['nomor_kk'];
            var tanggal_dikeluarkan = tabelKK.rows(row).data().toArray()[0]['tanggal_dikeluarkan'];
            var tempat_dikeluarkan = tabelKK.rows(row).data().toArray()[0]['tempat_dikeluarkan'];
            var tanggal_mulai_didesa = tabelKK.rows(row).data().toArray()[0]['tanggal_mulai_di_desa'];
            var keterangan = tabelKK.rows(row).data().toArray()[0]['keterangan'];
            modalUbahKK.find('#nomor_kk').val(nomor_kk);
            modalUbahKK.find('#tanggal_dikeluarkan').val(tanggal_dikeluarkan);
            modalUbahKK.find('#tempat_dikeluarkan').val(tempat_dikeluarkan);
            modalUbahKK.find('#tanggal_mulai_didesa').val(tanggal_mulai_didesa);
            modalUbahKK.find('#keterangan').val(keterangan);
            modalUbahKK.modal("show");
        });
        modalUbahKK.find('form').submit(function(e){
            var nomor_kk = $(this).find("input[name=nomor_kk]").val();
            $.ajax({
                context:{
                    context: "form"
                },
                type     : "PUT",
                dataType : "json",
                data     : $(this).serialize(),
                url      : "{{ route('penduduk.anggota-keluarga.ubah', '') }}/"+nomor_kk
            }).done(function(){
                tabelKK.ajax.reload();
            });
            e.preventDefault();
        });
        btnHapus.click(function(){
            var row = tabelKK.rows('.selected').indexes();
            var nomor_kk = tabelKK.rows(row).data().toArray()[0]['nomor_kk'];
            if(confirm("Apakah Yakin Nomor KK "+nomor_kk+" Akan Dihapus ?")){
                $.ajax({
                    context:{
                        context: "form"
                    },
                    type     : "POST",
                    dataType : "json",
                    url      : "{{ route('penduduk.anggota-keluarga.hapus', '') }}/"+nomor_kk
                }).done(function(){
                    tabelKK.ajax.reload();
                });
            }
            return false;
        });
        btnExport.click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('penduduk.anggota-keluarga.excel') }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('penduduk.anggota-keluarga.excel') }}";
            });
        });
    });
</script>
@endpush