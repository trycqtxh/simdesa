@extends('layouts.template')

@section('title', 'Data Penduduk')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
    <div class="box box-default" id="induk">
        <div class="box-body">
            <div class="btn-group btn-group-sm">
                @permission('add-induk-penduduk')
                <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                @endpermission
                @permission('edit-induk-penduduk')
                <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
                @endpermission
                @permission('remove-induk-penduduk')
                <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
                @endpermission
                <button class="btn btn-default" id="btn-lihat" disabled><i class="fa fa-search-plus"></i> Lihat</button>
                @permission('export-induk-penduduk')
                <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
                @endpermission
            </div>

            <div class="btn-group btn-group-sm pull-right">
                @permission('add-pindah-mutasi-penduduk')
                <button class="btn btn-default" id="btn-mutasi" disabled><i class="fa fa-trash"></i> Pindah</button>
                @endpermission
                @permission('add-meninggal-mutasi-penduduk')
                <button class="btn btn-default" id="btn-mati" disabled><i class="fa fa-trash"></i> Meninggal</button>
                @endpermission
            </div>
        </div>
    </div>
    <div class="box box-default" id="induk">
        <div class="box-body">
            <table class="table table-bordered box-shadow--16dp" id="tabel-induk">
                <thead>
                <tr>
                    <th rowspan="3">#</th>

                    <th rowspan="2">NAMA LENGKAP / PANGGILAN</th>
                    <th rowspan="2">JENIS KELAMIN</th>
                    <th rowspan="2">STATUS PERNIKAHAN</th>
                    <th colspan="2">TEMPAT & TANGGAL LAHIR</th>
                    <th rowspan="2">AGAMA</th>
                    <th rowspan="2">PENDIDIKAN TERAKHIR</th>
                    <th rowspan="2">PEKERJAAN</th>
                    <th rowspan="2">DAPAT MEMBACA HURUF</th>
                    <th rowspan="2">KE WARGANEGARAAN</th>
                    <th rowspan="2">ALAMAT LENGKAP</th>
                    <th rowspan="2">KEDUDUKAN DALAM KELUARGA</th>
                    <th rowspan="2">NIK</th>
                    <th rowspan="2">NOMOR KK</th>
                    <th rowspan="2">KET</th>
                </tr>
                <tr>
                    <th>TEMPAT LAHIR</th>
                    <th>TGL</th>
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
                    <th>16</th>
                </tr>
                </thead>
            </table>

            <div>
                <b>KETERANGAN TABEL :</b>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="col-md-3">
                        <p>STATUS PERNIKAHAN :</p>
                        <ol>
                            <li>BK : BELUM KAWIN</li>
                            <li>K : KAWIN</li>
                            <li>JD : JANDA</li>
                            <li>DD : DUDA</li>
                        </ol>
                    </div>
                    <div class="col-md-3">
                        <p>DAPAT MEMBACA :</p>
                        <ol>
                            <li>L : Latin</li>
                            <li>D : Daerah</li>
                            <li>A : Arab</li>
                            <li>AL : Arab & LAtin</li>
                            <li>AD : Arab & Daerah</li>
                            <li>ALD : Arab, Latin & Daerah</li>
                        </ol>
                    </div>
                    <div class="col-md-3">
                        <p>KEWARGANEGARAAN :</p>
                        <ol>
                            <li>WNI : Warga Negara Indonesia</li>
                            <li>WNA : Warga Negara Asing</li>
                        </ol>
                    </div>
                    <div class="col-md-3">
                        <p>KEDUDUDUKAN DALAM KELUARGA</p>
                        <ol>
                            @php( $status_kelarga = App\Entities\StatusKeluarga::all() )
                            @foreach($status_kelarga as $s)
                                <li>{{ $s->kode.' : '.$s->nama }}</li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modal.penduduk.induk')
@endsection

@push('js')
<script type="text/javascript">
    var modalLihatInduk = $('#modal-lihat-induk');
    var modalTambahInduk = $('#modal-tambah-induk');
    var modalUbahInduk = $('#modal-ubah-induk');
    var modalTambahMutasi = $('#modal-tambah-mutasi');
    var modalMutasiMati = $('#modal-mutasi-mati');

    var formTambahInduk = modalTambahInduk.find('form#form-tambah-induk');
    var formUbahInduk = modalUbahInduk.find('form#form-ubah-induk');
    var formTambahMutasi = modalTambahMutasi.find('form#form-tambah-mutasi');
    var formMutasiMati = modalMutasiMati.find('form#form-mutasi-mati');

    var tabInduk = $('div#induk');
    var btnTambahInduk = tabInduk.find('button#btn-tambah');
    var btnLihatInduk = tabInduk.find('button#btn-lihat');
    var btnUbahInduk = tabInduk.find('button#btn-ubah');
    var btnHapusInduk = tabInduk.find('button#btn-hapus');
    var btnExportInduk = tabInduk.find('button#btn-export');
    var btnTambahMutasi = tabInduk.find('button#btn-mutasi');
    var btnMutasiMati = tabInduk.find('button#btn-mati');

    var tabelInduk = tabInduk.find('table#tabel-induk').DataTable({
        ordering     : false,
        paging       : true,
        searching    : true,
        lengthChange: false,
        scrollX      : true,
        scrollY      : "400px",
        fixedHeader  : true,
        scrollCollapse: true,
        scroller:       true,
        // stateSave:      true,
        // fixedColumns  : {
        //     leftColumns : 2,
        // },
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
            url     : "{{ route('induk.index') }}",
            dataSrc : "data.data"
        },
        columns   : [
            {"data" : "id"},
            {"data" : "nama"},
            {"data" : "jenis_kelamin"},
            {"data" : "status_perkawinan"},
            {"data" : "tempat_lahir"},
            {"data" : "tanggal_lahir"},
            {"data" : "agama"},
            {"data" : "pendidikan"},
            {"data" : "pekerjaan"},
            {"data" : "membaca"},
            {"data" : "kewarga_negaraan"},
            {"data" : "alamat"},
            {"data" : "status_keluarga"},
            {"data" : "nik"},
            {"data" : "nomor_kk"},
            {"data" : "keterangan"},
        ],
        columnDefs :[
            { 'targets' : [0], 'visible' : false, 'searchable' : false }
        ]
    });

    $(function(){
        $('input[name=nik]').inputmask({alias: "nik"});    
        $('input[name=nomor_kk]').inputmask({alias: "nik"});    
        {{-- TAMBAH INDUK --}}
        tabInduk.find('button#btn-tambah').on('click', function(event){
            // $('input[name=nomor_kk]').inputmask({mask: "-999999-9999"});
            $.ajax({
                url     : "{{ route('induk.tambah.form', '') }}",
            }).done(function(html){
                modalTambahInduk.find('#load-file-html-tambah').html(html);
                modalTambahInduk.modal("show");
            });
        });

        formTambahInduk.submit(function(event){
            // $('input[name=nomor_kk]').inputmask('remove');
            event.preventDefault();
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('induk.tambah') }}",
                type     : "POST",
                dataType : "json",
                data     : formTambahInduk.serialize()
            }).done(function(){
                tabelInduk.ajax.reload();
            }).fail(function(){
                // $('input[name=nomor_kk]').inputmask({mask: "999999-999999-9999"});
            });

        });

        {{-- UBAH INDUK --}}
        tabelInduk.on('select', function(){
            btnLihatInduk.attr('disabled', false);
            btnUbahInduk.attr('disabled', false);
            btnHapusInduk.attr('disabled', false);
            btnTambahMutasi.attr('disabled', false);
            btnMutasiMati.attr('disabled', false);
        }).on('deselect', function(){
            btnLihatInduk.prop('disabled', true);
            btnUbahInduk.prop('disabled', true);
            btnHapusInduk.prop('disabled', true);
            btnTambahMutasi.prop('disabled', true);
            btnMutasiMati.prop('disabled', true);
        });

        tabInduk.find('button#btn-ubah').on('click', function(){
            var row = tabelInduk.rows('.selected').indexes();
            var id = tabelInduk.rows(row).data().toArray()[0]['id'];
            $.ajax({
                url      : "{{ route('induk.ubah.form', '') }}/"+id,
            }).done(function(html){
//                var tgl_lahir = moment(data.data[0].data.tanggal_lahir, 'DD-MM-YYYY').format('YYYY-MM-DD');

                {{--formUbahInduk.find("input[name='id']").val(data.data[0].data.id);--}}
                {{--formUbahInduk.find("input[name='nik']").val(data.data[0].data.nik);--}}
                {{--formUbahInduk.find("input[name='nomor_kk']").val(data.data[0].data.nomor_kk);--}}
                {{--formUbahInduk.find("input[name='nama']").val(data.data[0].data.nama);--}}
                {{--formUbahInduk.find("select[name='jenis_kelamin']").val(data.data[0].data.jenis_kelamin);--}}
                {{--formUbahInduk.find("input[name='tempat_lahir']").val(data.data[0].data.tempat_lahir);--}}
                {{--formUbahInduk.find("input[name='tanggal_lahir']").val(tgl_lahir); //parse YYYY-mm-d--}}
                {{--formUbahInduk.find("select[name='agama']").val(data.data[0].data.agama);--}}
                {{--formUbahInduk.find("select[name='status_perkawinan']").val(data.data[0].data.status_perkawinan);--}}
                {{--formUbahInduk.find("select[name='status_keluarga']").val(data.data[0].data.status_keluarga_id); //--}}
                {{--formUbahInduk.find("select[name='kewarga_negaraan']").val(data.data[0].data.kewarga_negaraan);--}}
                {{--formUbahInduk.find("select[name='pendidikan']").val(data.data[0].data.pendidikan);--}}
                {{--formUbahInduk.find("select[name='pekerjaan']").val(data.data[0].data.pekerjaan_id);--}}
                {{--formUbahInduk.find("select[name='membaca']").val(data.data[0].data.membaca);--}}
                {{--formUbahInduk.find("input[name='dusun']").val(data.data[0].data.dusun);--}}
                {{--formUbahInduk.find("select[name='rw']").val(data.data[0].data.rw);--}}
                {{--formUbahInduk.find("textarea[name='alamat']").val(data.data[0].data.alamat);--}}
                {{--formUbahInduk.find("textarea[name='keterangan']").val(data.data[0].data.keterangan);--}}
                {{--formUbahInduk.find("select[name='golongan_darah']").val(data.data[0].data.golongan_darah);--}}
                {{--formUbahInduk.find("select[name='ayah']").val(data.data[0].data.ayah_id);--}}
                {{--formUbahInduk.find("input[name='ayah_input']").val(data.data[0].data.ayah_input);--}}
                {{--formUbahInduk.find("select[name='ibu']").val(data.data[0].data.ibu_id);--}}
                {{--formUbahInduk.find("input[name='ibu_input']").val(data.data[0].data.ibu_input);--}}
                {{--var rw_id = data.data[0].data.rw;--}}
                {{--var select = $.ajax({--}}
                    {{--type : "GET",--}}
                    {{--url : "{{ route('rt.cari.select', '') }}/"+rw_id,--}}
                    {{--dataType : "json",--}}
                    {{--global : false,--}}
                {{--});--}}
                {{--select.done(function(data){--}}
                    {{--var dt = [];--}}
                    {{--$.each(data, function(key, val){--}}
                        {{--dt[key] = val;--}}
                    {{--});--}}
                    {{--var opt_list = [["", "Pilih"]].concat(dt);--}}
                    {{--formUbahInduk.find("select[name='rt']").empty();--}}
                    {{--for(var i=0; i<opt_list.length; i++){--}}
                        {{--formUbahInduk.find("select[name='rt']").append($("<option></option>").attr('value', opt_list[i][0]).text(opt_list[i][1]));--}}
                    {{--}--}}
                    {{--formUbahInduk.find("select[name=rt]").selectpicker('refresh');--}}
                {{--});--}}
                {{--formUbahInduk.find("select[name='rt']").val(data.data[0].data.rt);--}}
                {{--formUbahInduk.find("select[name=rt]").selectpicker('refresh');--}}

                {{--formUbahInduk.find(".selectpicker").selectpicker('refresh');--}}
                modalUbahInduk.find('#load-file-html').html(html);
                modalUbahInduk.modal("show");
            });
        });

        formUbahInduk.submit(function(event){
            var id = formUbahInduk.find("input[name='id']").val();
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('induk.ubah', '') }}/"+id,
                type     : "PUT",
                dataType : "json",
                data     : formUbahInduk.serialize()
            }).done(function(){
                tabelInduk.ajax.reload();
            });
            event.preventDefault();
        });

        {{-- HAPUS INDUK --}}
        btnHapusInduk.on('click', function(){
            var row = tabelInduk.rows('.selected').indexes();
            var id = tabelInduk.rows(row).data().toArray()[0]['id'];
            var nama = tabelInduk.rows(row).data().toArray()[0]['nama'];
            if(confirm('Apakah Anda Yakin Menghapus " '+nama+' " ?')){
                $.ajax({
                    context : {
                        context : "form"
                    },
                    url      : "{{ route('induk.hapus', '') }}/"+id,
                    type     : "POST",
                    dataType : "json",
                }).done(function(){
                    tabelInduk.ajax.reload();
                });
            }
        });

        btnLihatInduk.on('click', function(){
            var row = tabelInduk.rows('.selected').indexes();
            var id = tabelInduk.rows(row).data().toArray()[0]['id'];
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('induk.cari', '') }}/"+id,
                type     : "GET",
                dataType : "json",
                global   : false,
            }).done(function(data){
                modalLihatInduk.modal("show");
                modalLihatInduk.find("td[induk='nik']").text(data.data[0].data.nik);
                modalLihatInduk.find("td[induk='nomor_kk']").text(data.data[0].data.nomor_kk);
                modalLihatInduk.find("td[induk='nama']").text(data.data[0].data.nama);
                modalLihatInduk.find("td[induk='jenis_kelamin']").text(data.data[0].data.jenis_kelamin);
                modalLihatInduk.find("td[induk='tempat_lahir']").text(data.data[0].data.tempat_lahir);
                modalLihatInduk.find("td[induk='tanggal_lahir']").text(data.data[0].data.tanggal_lahir); //parse YYYY-mm-d
                modalLihatInduk.find("td[induk='agama']").text(data.data[0].data.agama);
                modalLihatInduk.find("td[induk='status_perkawinan']").text(data.data[0].data.status_perkawinan);
                modalLihatInduk.find("td[induk='status_keluarga']").text(data.data[0].data.status_keluarga_id); //
                modalLihatInduk.find("td[induk='kewarga_negaraan']").text(data.data[0].data.kewarga_negaraan);
                modalLihatInduk.find("td[induk='pendidikan']").text(data.data[0].data.pendidikan);
                modalLihatInduk.find("td[induk='pekerjaan']").text(data.data[0].data.pekerjaan);
                modalLihatInduk.find("td[induk='membaca']").text(data.data[0].data.membaca);
                modalLihatInduk.find("td[induk='alamat']").text(data.data[0].data.alamat);
                modalLihatInduk.find("td[induk='dusun']").text(data.data[0].data.dusun);
                modalLihatInduk.find("td[induk='rw']").text(data.data[0].data.rw);
                modalLihatInduk.find("td[induk='rt']").text(data.data[0].data.rt);
                modalLihatInduk.find("td[induk='keterangan']").text(data.data[0].data.keterangan);
            });
        });

        btnTambahMutasi.on('click', function(){
            var row = tabelInduk.rows('.selected').indexes();
            var id = tabelInduk.rows(row).data().toArray()[0]['id'];
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('induk.cari', '') }}/"+id,
                type     : "GET",
                dataType : "json",
                global   : false,
            }).done(function(data){
                formTambahMutasi.find("input[name='id']").val(data.data[0].data.id);
                formTambahMutasi.find("input[name='nik']").val(data.data[0].data.nik);
                formTambahMutasi.find("input[name='nama']").val(data.data[0].data.nama);
                formTambahMutasi.find("input[name='jenis_kelamin']").val(data.data[0].data.jenis_kelamin);
                formTambahMutasi.find("input[name='kewarga_negaraan']").val(data.data[0].data.kewarga_negaraan);
                formTambahMutasi.find("input[name='tempat_lahir']").val(data.data[0].data.tempat_lahir);
                formTambahMutasi.find("input[name='tanggal_lahir']").val(data.data[0].data.tanggal_lahir);
                modalTambahMutasi.modal("show");
            });
        });

        formTambahMutasi.submit(function(e){
            var id = formTambahMutasi.find("input[name='id']").val();
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('mutasi.pindah', '') }}/"+id,
                type     : "PUT",
                dataType : "json",
                data     : formTambahMutasi.serialize()
            }).done(function(){
                window.location.replace("{{ route('mutasi.index') }}");
            });
            e.preventDefault();
        });

        btnMutasiMati.on('click', function(){
            var row = tabelInduk.rows('.selected').indexes();
            var id = tabelInduk.rows(row).data().toArray()[0]['id'];
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('induk.cari', '') }}/"+id,
                type     : "GET",
                dataType : "json",
                global   : false
            }).done(function(data){
                formMutasiMati.find("input[name='id']").val(data.data[0].data.id);
                formMutasiMati.find("input[name='nik']").val(data.data[0].data.nik);
                formMutasiMati.find("input[name='nama']").val(data.data[0].data.nama);
                formMutasiMati.find("input[name='jenis_kelamin']").val(data.data[0].data.jenis_kelamin);
                formMutasiMati.find("input[name='kewarga_negaraan']").val(data.data[0].data.kewarga_negaraan);
                formMutasiMati.find("input[name='tempat_lahir']").val(data.data[0].data.tempat_lahir);
                formMutasiMati.find("input[name='tanggal_lahir']").val(data.data[0].data.tanggal_lahir);
                modalMutasiMati.modal("show");
            });
        });

        formMutasiMati.submit(function(e){
            var id = formMutasiMati.find("input[name='id']").val();
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('mutasi.mati', '') }}/"+id,
                type     : "PUT",
                dataType : "json",
                data     : formMutasiMati.serialize()
            }).done(function(){
                window.location.replace("{{ route('mutasi.index') }}");
            });
            e.preventDefault();
        });

        {{-- EVENT MODAL TAMBAH INDUK --}}
        modalTambahInduk.on("shown.bs.modal", function(){
            formTambahInduk.find("input[name='tanggal_lahir']").datepicker({
                format : 'yyyy-mm-dd',
                autoclose:true,
                endDate: "today",
                startDate :'1917-01-01'
            });
            formTambahInduk.find("select[name='rw']").on('change', function(){
                var rw_id = $(this).find(":selected").val();
                if(rw_id == ""){
                    formTambahInduk.find("select[name='rt']").val('').selectpicker('refresh');
                    formTambahInduk.find("select[name='rt']").empty();
                }else {
                    var select = $.ajax({
                        type: "GET",
                        url: "{{ route('rt.cari.select', '') }}/" + rw_id,
                        dataType: "json",
                        global: false,
                    });
                    select.done(function (data) {
                        var dt = [];
                        $.each(data, function (key, val) {
                            dt[key] = val;
                        });
                        var opt_list = [["", "Pilih"]].concat(dt);
                        formTambahInduk.find("select[name='rt']").empty();
                        for (var i = 0; i < opt_list.length; i++) {
                            formTambahInduk.find("select[name='rt']").append($("<option></option>").attr('value', opt_list[i][0]).text(opt_list[i][1]));
                        }
                        formTambahInduk.find("select[name=rt]").selectpicker('refresh');
                    });
                }
            });
        });
        modalTambahInduk.on("hidden.bs.modal", function(){
            formTambahInduk.find("select[name='rt']").empty();
            $(".selectpicker").val('').selectpicker('refresh');
            formTambahInduk[0].reset();
        });

        {{-- EVENT MODAL UBAH INDUK --}}
        modalUbahInduk.on("shown.bs.modal", function(){
            formUbahInduk.find("input[name='tanggal_lahir']").datepicker({
                format : 'yyyy-mm-dd'
            });
            rw_change_ubah()
        });
        modalUbahInduk.on("hidden.bs.modal", function(){
            $(".selectpicker").val('').selectpicker('refresh');
            formUbahInduk[0].reset();
        });

        {{-- EVENT MODAL PINDAH MUTASI --}}
        modalTambahMutasi.on('shown.bs.modal', function(){
            formTambahMutasi.find("input[name='tanggal_pindah']").datepicker({
                format : 'yyyy-mm-dd',
                autoclose:true,
                startDate: "today"
               
            });
        });
        modalTambahMutasi.on('hidden.bs.modal', function(){
            formTambahMutasi[0].reset();
        });

        {{-- EVENT MODAL MATI MUTASI --}}
        modalMutasiMati.on('shown.bs.modal', function(){
            formMutasiMati.find("input[name='tanggal_meninggal']").datepicker({
                format : 'yyyy-mm-dd',
                autoclose:true,
                endDate: "today",
                startDate :'1917-01-01'
            });
        });
        modalMutasiMati.on('hidden.bs.modal', function(){
            formMutasiMati[0].reset();
        });

        btnExportInduk.click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('induk.excel') }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('induk.excel') }}";
            });
        });
    });

    function rw_change_ubah(){
        formUbahInduk.find("select[name='rw']").on('change', function(){
            var rw_id = $(this).find(":selected").val();
            var select = $.ajax({
                type : "GET",
                url : "{{ route('rt.cari.select', '') }}/"+rw_id,
                dataType : "json",
                global : false,
            });
            select.done(function(data){
                var dt = [];
                $.each(data, function(key, val){
                    dt[key] = val;
                });
                var opt_list = [["", "Pilih"]].concat(dt);
                formUbahInduk.find("select[name='rt']").empty();
                for(var i=0; i<opt_list.length; i++){
                    formUbahInduk.find("select[name='rt']").append($("<option></option>").attr('value', opt_list[i][0]).text(opt_list[i][1]));
                }
                formUbahInduk.find("select[name=rt]").selectpicker('refresh');
            });
        });
    }

    function pilih(nomor_kk){
        $('input[name=nomor_kk]').val(nomor_kk);
    }
</script>
@endpush