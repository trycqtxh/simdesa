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
    <div class="nav nav-tabs-custom">
        <ul class="nav nav-tabs pull-right" role="tablist">
            <li role="presentation" class="active"><a href="#tabpanel-mutasi" aria-controls="tabpanel-mutasi" role="tab" data-toggle="tab"> Data Penduduk Mutasi</a> </li>
            <li role="presentation" class=""><a href="#tabpanel-induk" aria-controls="tabpanel-induk" role="tab" data-toggle="tab"> Data Penduduk Induk</a> </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="tabpanel-induk">

                <div class="btn-group btn-group-sm">
                    <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                    <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
                    <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
                    <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
                </div>

                <table class="table table-bordered" id="tabel-induk">
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

            <div class="tab-pane active" role="tabpanel" id="tabpanel-mutasi">

                <div class="btn-group btn-group-sm">
                    <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                    <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
                    <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
                    <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
                </div>

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
    </div>
    @include('modal.penduduk.form')
@endsection

@push('js')
<script type="text/javascript">
    var modalTambahInduk = $('#modal-tambah-induk');
    var modalUbahInduk = $('#modal-ubah-induk');
    var formTambahInduk = modalTambahInduk.find('form#form-tambah-induk');
    var formUbahInduk = modalUbahInduk.find('form#form-ubah-induk');
    var tabInduk = $('div#tabpanel-induk');
    var btnTambahInduk = tabInduk.find('button#btn-tambah');
    var btnUbahInduk = tabInduk.find('button#btn-ubah');
    var btnHapusInduk = tabInduk.find('button#btn-hapus');
    var btnExportInduk = tabInduk.find('button#btn-export');
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

    var modalTambahMutasi = $('#modal-tambah-mutasi');
    var modalUbahMutasi = $('#modal-ubah-mutasi');
    var formTambahMutasi = modalTambahMutasi.find('form#form-tambah-mutasi');
    var formUbahMutasi = modalUbahMutasi.find('form#form-ubah-mutasi');
    var tabMutasi = $('div#tabpanel-mutasi');
    var btnTambahMutasi = tabMutasi.find('button#btn-tambah');
    var btnUbahMutasi = tabMutasi.find('button#btn-ubah');
    var btnHapusMutasi = tabMutasi.find('button#btn-hapus');
    var btnExportMutasi = tabMutasi.find('button#btn-export');
    var tabelMutasi = tabMutasi.find('table#tabel-mutasi').DataTable({
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
        {{-- TAMBAH INDUK --}}
        tabInduk.find('button#btn-tambah').on('click', function(event){
            modalTambahInduk.modal("show");
        });

        formTambahInduk.submit(function(event){
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
            });
            event.preventDefault();
        });

        {{-- UBAH INDUK --}}
        tabelInduk.on('select', function(){
            tabInduk.find('button#btn-ubah').attr('disabled', false);
            tabInduk.find('button#btn-hapus').attr('disabled', false);
        }).on('deselect', function(){
            tabInduk.find('button#btn-ubah').prop('disabled', true);
            tabInduk.find('button#btn-hapus').prop('disabled', true);
        });

        tabInduk.find('button#btn-ubah').on('click', function(){
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
                modalUbahInduk.modal("show");
                formUbahInduk.find("input[name='nik']").val(data.data[0].data.nik);
                formUbahInduk.find("input[name='nomor_kk']").val(data.data[0].data.nomor_kk);
                formUbahInduk.find("input[name='nama']").val(data.data[0].data.nama);
                formUbahInduk.find("select[name='jenis_kelamin']").val(data.data[0].data.jenis_kelamin);
                formUbahInduk.find("input[name='tempat_lahir']").val(data.data[0].data.tempat_lahir);
                formUbahInduk.find("input[name='tanggal_lahir']").val(data.data[0].data.tanggal_lahir); //parse YYYY-mm-d
                formUbahInduk.find("select[name='agama']").val(data.data[0].data.agama);
                formUbahInduk.find("select[name='status_perkawinan']").val(data.data[0].data.status_perkawinan);
                formUbahInduk.find("select[name='status_keluarga']").val(data.data[0].data.status_keluarga_id); //
                formUbahInduk.find("select[name='kewarga_negaraan']").val(data.data[0].data.kewarga_negaraan);
                formUbahInduk.find("select[name='pendidikan']").val(data.data[0].data.pendidikan);
                formUbahInduk.find("input[name='pekerjaan']").val(data.data[0].data.pekerjaan);
                formUbahInduk.find("select[name='membaca']").val(data.data[0].data.membaca);
                formUbahInduk.find("input[name='alamat']").val(data.data[0].data.alamat);
                formUbahInduk.find("input[name='dusun']").val(data.data[0].data.dusun);
                formUbahInduk.find("select[name='rw']").val(data.data[0].data.rw);
                formUbahInduk.find("select[name='rt']").val(data.data[0].data.rt);
                formUbahInduk.find("textarea[name='keterangan']").val(data.data[0].data.keterangan);
                console.log(data.data[0].data.nik);
                formUbahInduk.find(".selectpicker").selectpicker('refresh');
                formUbahInduk.find("select[name='status_keluarga']").selectpicker('refresh');
            });
        });

        formUbahInduk.submit(function(event){
            var id = formUbahInduk.find("select[name='id']").val();
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('induk.ubah', '') }}/"+id,
                type     : "PUT",
                dataType : "json",
                data     : formTambahInduk.serialize()
            }).done(function(){
                tabelInduk.ajax.reload();
            });
            event.preventDefault();
        });

        {{-- HAPUS INDUK --}}
        tabInduk.find('button#btn-hapus').on('click', function(){
            if(confirm("Apakah Yakin Akan Di Hapus ?")){
                var row = tabelInduk.rows('.selected').indexes();
                var id = tabelInduk.rows(row).data().toArray()[0]['id'];
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
        })

        {{-- EVENT MODAL INDUK --}}
        modalTambahInduk.on("shown.bs.modal", function(){
            formTambahInduk.find("input[name='tanggal_lahir']").datepicker({
                format : 'yyyy-mm-dd'
            });
        });
        modalTambahInduk.on("hidden.bs.modal", function(){
            $(".selectpicker").val('').selectpicker('refresh');
            formTambahInduk[0].reset();
        });
        modalUbahInduk.on("shown.bs.modal", function(){
            formUbahInduk.find("input[name='tanggal_lahir']").datepicker({
                format : 'yyyy-mm-dd'
            });
        });
        modalUbahInduk.on("hidden.bs.modal", function(){
            $(".selectpicker").val('').selectpicker('refresh');
            formUbahInduk[0].reset();
        });

        {{---------------------------------------------------------------------------------------------------------------------------------------------}}
        {{-- TAMBAH MUTASI --}}
        tabInduk.find('button#btn-tambah').on('click', function(event){
            modalTambahInduk.modal("show");
        });

        formTambahInduk.submit(function(event){
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
            });
            event.preventDefault();
        });

        {{---------------------------------------------------------------------------------------------------------------------------------------------}}

        {{-- TAMBAHAN--}}
//        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
//            if (e.target.hash == '#tabpanel-penduduk-mutasi') {
//                mutasi.columns.adjust().draw()
//            }
//            if (e.target.hash == '#tabpanel-penduduk-sementara') {
//                sementara.columns.adjust().draw()
//            }
//            if (e.target.hash == '#tabpanel-penduduk-induk') {
//                induk.columns.adjust().draw()
//            }
//        });
    })
</script>
@endpush