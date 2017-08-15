@extends('layouts.template')

@section('title', 'Data Kartu Tanda Penduduk ')

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
            @permission('add-ktp-penduduk')
            <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
            @endpermission
            @permission('edit-ktp-penduduk')
            <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
            @endpermission
            @permission('remove-ktp-penduduk')
            <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
            @endpermission
            @permission('export-ktp-penduduk')
            <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
            @endpermission
        </div>
    </div>
    <div class="box box-default">
        <div class="box-body">
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
    @include('modal.penduduk.ktp')
@endsection

@push('js')
<script type="text/javascript">
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
//        fixedColumns  : {
//            leftColumns : 2,
//        },
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
    var btnTambah = $('#btn-tambah');
    var btnUbah = $('#btn-ubah');
    var btnHapus = $('#btn-hapus');
    var btnExport = $('#btn-export');
    var modalTambah = $('#modal-tambah');
    var modalUbah = $('#modal-ubah');
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

        $('button#cari-nik').click(function(){
            $.ajax({
                url: "{{ route('penduduk.ktp.html-ktp') }}"
            }).done(function(html){
                $('#modal-select-ktp').find('#load-html').html(html);
                $('#modal-select-ktp').modal('show');
            });
        });
        $('input[name=nik]').inputmask({alias: "nik"});
        tabel.on('select', function(){
            btnUbah.attr('disabled', false);
            btnHapus.attr('disabled', false);
        }).on('deselect', function(){
            btnUbah.prop('disabled', true);
            btnHapus.prop('disabled', true);
        });
        btnTambah.click(function(){
            modalTambah.modal("show");
        });
        btnUbah.click(function(){
            var row = tabel.rows('.selected').indexes();
            var id = tabel.rows(row).data().toArray()[0]['id'];
            var nik = tabel.rows(row).data().toArray()[0]['nik'];
            var tempat_dikeluarkan = tabel.rows(row).data().toArray()[0]['tempat_dikeluarkan'];
            var tanggal_dikeluarkan = tabel.rows(row).data().toArray()[0]['tanggal_dikeluarkan'];
            var tanggal_mulai_didesa = tabel.rows(row).data().toArray()[0]['tanggal_mulai_di_desa'];
            modalUbah.find('#nik').val(nik);
            modalUbah.find('#tempat_dikeluarkan').val(tempat_dikeluarkan);
            modalUbah.find('#tanggal_dikeluarkan').val(tanggal_dikeluarkan);
            modalUbah.find('#tanggal_mulai_di_desa').val(tanggal_mulai_didesa);
            modalUbah.find('#id').val(id);
            modalUbah.modal("show");
        });
        $("input[name=tanggal_dikeluarkan]").datepicker({
            format : 'yyyy-mm-dd',
            autoclose:true,
            endDate: "today",
            startDate :'1917-01-01'
        });
        $("input[name=tanggal_mulai_didesa]").datepicker({
            format : 'yyyy-mm-dd',
            autoclose:true,
            endDate: "today",
            startDate :'1917-01-01'
        });
        modalTambah.find('form').submit(function(e){
            $.ajax({
                context: {
                    context : "form"
                },
                type    : "POST",
                dataType: "json",
                data    : $(this).serialize(),
                url     : "{{ route('penduduk.ktp.tambah') }}"
            }).done(function(){
                tabel.ajax.reload();
            });
            e.preventDefault();
        });
        modalUbah.find('form').submit(function(e){
            var id = $(this).find('input[name=id]').val();
            $.ajax({
                context: {
                    context : "form"
                },
                type    : "PUT",
                dataType: "json",
                data    : $(this).serialize(),
                url     : "{{ route('penduduk.ktp.ubah', '') }}/"+id
            }).done(function(){
                tabel.ajax.reload();
            });
            e.preventDefault();
        });
        btnHapus.click(function(){
            var row = tabel.rows('.selected').indexes();
            var id = tabel.rows(row).data().toArray()[0]['id'];
            var nama = tabel.rows(row).data().toArray()[0]['nama'];
            if(confirm('Apakah Yakin '+nama+' Akan Dihapus ?')){
                $.ajax({
                    context: {
                        context : "form"
                    },
                    type    : "POST",
                    dataType: "json",
                    url     : "{{ route('penduduk.ktp.hapus', '') }}/"+id
                }).done(function(){
                    tabel.ajax.reload();
                });
            }
            return false;
        });
        modalTambah.on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset();
        });
        btnExport.click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('penduduk.ktp.excel') }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('penduduk.ktp.excel') }}";
            });
        });
    });

    function pilih(nik){
        $('input[name=nik]').val(nik);
    }
</script>
@endpush