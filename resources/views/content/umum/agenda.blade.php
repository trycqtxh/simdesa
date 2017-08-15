@extends('layouts.template')

@section('title', 'Buku Agenda')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
    <div class="box" id="agenda">
        <div class="box-body">
            <div class="btn-group btn-group-sm">
                {{--<button class="btn btn-default" id="btn-tambah-masuk"><i class="fa fa-plus"></i> Tambah Surat Masuk</button>--}}
                {{--<button class="btn btn-default" id="btn-tambah-keluar"><i class="fa fa-plus"></i> Tambah Surat Keluar</button>--}}
                {{--<button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>--}}
                {{--<button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>--}}
                {{--<button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>--}}

                @permission('add-agenda-umum')
                <button class="btn btn-default" id="btn-tambah-masuk"><i class="fa fa-plus"></i> Tambah Surat Masuk</button>
                <button class="btn btn-default" id="btn-tambah-keluar"><i class="fa fa-plus"></i> Tambah Surat Keluar</button>
                @endpermission
                @permission('edit-agenda-umum')
                <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
                @endpermission
                @permission('remove-agenda-umum')
                <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
                @endpermission
                @permission('export-agenda-umum')
                <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
                @endpermission
            </div>
        </div>
    </div>
 <div class="box box-default">
    <div class="box-body">
	   <table class="table table-bordered" id="tabel-agenda">
            <thead>
              <tr>
                <th rowspan="2">NOMOR URUT</th>
                <th rowspan="2">TANGGAL PENERIMAAN / PENGIRIMAN SURAT</th>
                <th colspan="4">SURAT MASUK</th>
                <th colspan="4">SURAT KELUAR</th>
                <th rowspan="2">KET</th>
              </tr>
              <tr>
                <th>NOMOR</th>
                <th>TANGGAL</th>
                <th>PENGIRIM</th>
                <th>ISI SINGKAT</th>
                <th>NOMOR</th>
                <th>TANGGAL</th>
                <th>DITUJUKAN KEPADA</th>
                <th>ISI SURAT</th>
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
              </tr>
            </tbody>
        </table>
    </div>
 </div>
@include('modal.umum.agenda')
@endsection
@push('js')
<script type="text/javascript">
    var modal = $('#modal-tambah');
    var tabAgenda = $('div#agenda');
    var btnT = tabAgenda.find('#btn-tambah');
    var btnU = tabAgenda.find('#btn-ubah');
    var btnH = tabAgenda.find('#btn-hapus');
    var tabelAgenda = $('table#tabel-agenda').DataTable({
        ordering     : false,
        paging       : true,
        searching    : true,
        lengthChange: false,
        select    : {
            style: 'single'
        },
        language  : {
            url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
        },
        ajax      : {
            url     : "{{ route('adm-surat.index.agenda') }}",
            dataSrc : "data.data"
        },
        columnDefs :[
            { 'targets' : [0], 'visible' : false, 'searchable' : false }
        ],
        columns : [
            { data : 'id'},
            { data : 'tanggal_pengiriman'},
            { data : 'nomor_masuk'},
            { data : 'tanggal_masuk'},
            { data : 'nama_pengirim_masuk'},
            { data : 'isi_singkat_masuk'},
            { data : 'nomor_keluar'},
            { data : 'tanggal_keluar'},
            { data : 'ditujukan_kepada'},
            { data : 'isi_singkat_keluar'},
            { data : 'keterangan'},
        ]
    }); 
    $(function(){
        $('#btn-tambah-masuk').on('click',function(e){
            modal.find('.modal-title').text('Tambah Data Surat Masuk');
            modal.find('label[for="tanggal_pengiriman"]').text('Tanggal Penerimaan');
            modal.find('label[for="pengirim"]').text('Pengirim');
            modal.find('input[name="jenis_surat"]').val('masuk');
            $('#modal-tambah').modal('show');
        });
        $('#btn-tambah-keluar').on('click',function(e){
            modal.find('.modal-title').text('Tambah Data Surat Keluar');
            modal.find('label[for="tanggal_pengiriman"]').text('Tanggal Pengiriman');
            modal.find('label[for="pengirim"]').text('Ditujukan Kepada');
            modal.find('input[name="jenis_surat"]').val('keluar');
            $('#modal-tambah').modal('show');
        });

        modal.find('form').submit(function(e){
            var jenis =   modal.find('input[name="jenis_surat"]').val();
            if(jenis == 'masuk'){
                $.ajax({
                    context : {
                        context : "form"
                    },
                    url      : "{{ route('adm-surat.tambah', '') }}/"+jenis,
                    type     : "POST",
                    dataType : "json",
                    data     : {
                        tanggal_penerimaan : $(this).find('input[name=tanggal_pengiriman]').val(),
                        nomor_surat        : $(this).find('input[name=nomor_surat]').val(),
                        tanggal_surat      : $(this).find('input[name=tanggal_surat]').val(),
                        pengirim           : $(this).find('input[name=pengirim]').val(),
                        isi_surat          : $(this).find('textarea[name=isi_surat]').val(),
                        keterangan         : $(this).find('textarea[name=keterangan]').val(),
                    }
                }).done(function(){
                    tabelAgenda.ajax.reload();
                });
            }
            if(jenis == 'keluar'){
                $.ajax({
                    context : {
                        context : "form"
                    },
                    url      : "{{ route('adm-surat.tambah', '') }}/"+jenis,
                    type     : "POST",
                    dataType : "json",
                    data     : {
                        tanggal_pengiriman : $(this).find('input[name=tanggal_pengiriman]').val(),
                        nomor_surat        : $(this).find('input[name=nomor_surat]').val() ,
                        tanggal_surat      : $(this).find('input[name=tanggal_surat]').val(),
                        ditujukan_kepada   : $(this).find('input[name=pengirim]').val(),
                        isi_surat          : $(this).find('textarea[name=isi_surat]').val(),
                        keterangan         : $(this).find('textarea[name=keterangan]').val(),
                    }
                }).done(function(){
                    tabelAgenda.ajax.reload();
                });
            }
            
            e.preventDefault();
        });

        $('#modal-tambah').on("shown.bs.modal", function(){
            $('#modal-tambah').find('input[name=tanggal_pengiriman]').datepicker({
                format : 'yyyy-mm-dd'
            });
            $('#modal-tambah').find('input[name=tanggal_surat]').datepicker({
                format : 'yyyy-mm-dd'
            });
        });
        $('#modal-ubah').on("shown.bs.modal", function(){
            $('#modal-tambah').find('input[name=tanggal_pengiriman]').datepicker({
                format : 'yyyy-mm-dd'
            });
            $('#modal-tambah').find('input[name=tanggal_surat]').datepicker({
                format : 'yyyy-mm-dd'
            });
        });

        tabelAgenda.on("select", function(){
            btnH.attr('disabled', false);
            btnU.attr('disabled', false);
        }).on('deselect', function(){
            btnH.prop('disabled', true);
            btnU.prop('disabled', true);
        });

        btnH.click(function(){
            if(confirm("Apakah yakin akan Dihapus ?")){
                var row = tabelAgenda.rows('.selected').indexes();
                var id = tabelAgenda.rows(row).data().toArray()[0]['id'];
                $.ajax({
                    context : {
                        context : "form"
                    },
                    url : "{{ route('adm-surat.hapus', '') }}/"+id,
                    dataType : "json",
                    type : "POST"
                }).done(function(){
                    tabelAgenda.ajax.reload();
                });
            }
        });

        btnU.click(function(){
            var row = tabelAgenda.rows('.selected').indexes();
            var id = tabelAgenda.rows(row).data().toArray()[0]['id'];
            $.ajax({
                context : {
                    context : "form"
                },
                url : "{{ route('adm-surat.cari', '') }}/"+id,
                dataType : "json",
                type : "GET",
                global : false
            }).done(function(data){
                if(data.data.jenis == "masuk"){
                    $("#modal-ubah").find('label[for=tanggal_pengiriman]').text("Tanggal Penerimaan");
                    $("#modal-ubah").find('label[for=pengirim]').text("Pengirim");
                }
                if(data.data.jenis == "keluar"){
                    $("#modal-ubah").find('label[for=tanggal_pengiriman]').text("Tanggal Pengiriman");
                    $("#modal-ubah").find('label[for=pengirim]').text("Ditujukan Kepada");
                }
                $("#modal-ubah").find('input[name=tanggal_pengiriman]').val(data.data.tanggal_pengirim_penerima);
                $("#modal-ubah").find('input[name=nomor_surat]').val(data.data.nomor_surat);
                $("#modal-ubah").find('input[name=tanggal_surat]').val(data.data.tanggal_surat);
                $("#modal-ubah").find('input[name=pengirim]').val(data.data.pengirim_penerima);
                $("#modal-ubah").find('textarea[name=isi_surat]').val(data.data.isi_surat);
                $("#modal-ubah").find('textarea[name=keterangan]').val(data.data.keterangan);
                $("#modal-ubah").find('input[name=id]').val(data.data.id);
                $("#modal-ubah").find('input[name=jenis_surat]').val(data.data.jenis);

                $("#modal-ubah").modal("show");
            });
        });

        $("#modal-ubah").find("form").submit(function(e){
            var jenis =   $(this).find('input[name="jenis_surat"]').val();
            var id = $(this).find('input[name=id]').val();

            if(jenis == "masuk"){
                var xhr = $.ajax({
                    context   :{
                        context : "form"
                    },
                    url      : "{{ route('adm-surat.ubah', ['jenis'=>'masuk', 'id'=>'']) }}/"+id,
                    type     : "PUT",
                    dataType : "json",
                    data     : {
                        tanggal_penerimaan : $(this).find('input[name=tanggal_pengiriman]').val(),
                        nomor_surat        : $(this).find('input[name=nomor_surat]').val(),
                        tanggal_surat      : $(this).find('input[name=tanggal_surat]').val(),
                        pengirim           : $(this).find('input[name=pengirim]').val(),
                        isi_surat          : $(this).find('textarea[name=isi_surat]').val(),
                        keterangan         : $(this).find('textarea[name=keterangan]').val(),
                    }
                });
                xhr.done(function(data){
                    tabelAgenda.ajax.reload();
                });


            }

            if(jenis == "keluar"){
                var xhr = $.ajax({
                    context  :{
                        context : "form"
                    },
                    url      : "{{ route('adm-surat.ubah', ['jenis'=>'keluar', 'id'=>'']) }}/"+id,
                    type     : "PUT",
                    dataType : "json",
                    data     : {
                        tanggal_pengiriman : $(this).find('input[name=tanggal_pengiriman]').val(),
                        nomor_surat        : $(this).find('input[name=nomor_surat]').val() ,
                        tanggal_surat      : $(this).find('input[name=tanggal_surat]').val(),
                        ditujukan_kepada   : $(this).find('input[name=pengirim]').val(),
                        isi_surat          : $(this).find('textarea[name=isi_surat]').val(),
                        keterangan         : $(this).find('textarea[name=keterangan]').val(),
                    }
                });
                xhr.done(function(data){
                    tabelAgenda.ajax.reload();
                });
            }

            e.preventDefault();
        });

        $('#btn-export').click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('agenda.excel') }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('agenda.excel') }}";
            });
        });
    })


</script>
@endpush