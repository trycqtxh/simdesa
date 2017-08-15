@extends('layouts.template')

@section('title', 'Buku Lembar & Berita Desa')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
	<div class="box box-default" id="lembar_berita">
      <div class="box-body">
          <div class="btn-group btn-group-sm">
            {{--<button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>--}}
            {{--<button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>--}}
            {{--<button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>--}}
            {{--<button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>--}}
              @permission('add-lembar-berita-umum')
              <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
              @endpermission
              @permission('edit-lembar-berita-umum')
              <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
              @endpermission
              @permission('remove-lembar-berita-umum')
              <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
              @endpermission
              @permission('export-lembar-berita-umum')
              <button class="btn btn-default" id="btn-export"><i class="fa fa-download"></i> Export</button>
              @endpermission
          </div>
      </div>
    </div>
	<div class="box box-default">
      <div class="box-body">
          <table class="table table-bordered" id="tabel-lembar_berita">
            <thead>
              <tr>
                <th rowspan="2">NOMOR URUT</th>
                <th rowspan="2">JENIS PERATURAN DI DESA</th>
                <th rowspan="2">NOMOR DAN TANGGAL DITETAPKAN</th>
                <th rowspan="2">TENTANG</th>
                <th colspan="2">DIUNDANGKAN</th>
                <th rowspan="2">KET</th>
              </tr>
              <tr>
                <th>TANGGAL</th>
                <th>NOMOR</th>
              </tr>
              <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
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
            </tr>
          </tbody>
        </table>
      </div>
    </div>

@include('modal.umum.lembar_berita')
@endsection
@push('js')
<script type="text/javascript">
    var tablembar_berita = $('div#lembar_berita');
    var tabellembar_berita = $('table#tabel-lembar_berita').DataTable({
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
            url     : "{{ route('lembar-berita.index') }}",
            dataSrc : "data.data"
        },
        columnDefs :[
            { 'targets' : [0], 'visible' : false, 'searchable' : false }
        ],
        columns : [
            { data : 'id'},
            { data : 'jenis_peraturan'},
            { data : 'ditetapkan'},
            { data : 'tentang'},
            { data : 'tanggal_diundangkan'},
            { data : 'nomor_diundangkan'},
            { data : 'keterangan'},
        ]
    }); 
    $(function(){
        $('#btn-tambah').on('click',function(e){
            $('#modal-tambah').modal('show');
        });

        $('#modal-tambah').on('shown.bs.modal', function(){
            $(this).find('input[name=tanggal_diundangkan]').datepicker({
                format: 'yyyy-mm-dd'
            });
        });

        $('#modal-tambah').find('form').submit(function(e){
            $.ajax({
                context : {
                    context: "form"
                },
                url     : "{{ route('lembar-berita.tambah') }}",
                type    : "POST",
                dataType: "json",
                data    : $(this).serialize()
            }).done(function(data){
                tabellembar_berita.ajax.reload();
            });
            e.preventDefault();
        });

        tabellembar_berita.on('select', function(){
            $('#btn-hapus').attr('disabled', false);
            $('#btn-ubah').attr('disabled', false);
        }).on('deselect', function(){
            $('#btn-hapus').prop('disabled', true);
            $('#btn-ubah').prop('disabled', true);
        });

        $('#btn-ubah').click(function(){
            var row = tabellembar_berita.rows('.selected').indexes();
            var id = tabellembar_berita.rows(row).data().toArray()[0]['id'];
            $.ajax({
                global    : false,
                dataType  : "json",
                type      : "GET",
                url       : "{{ route('lembar-berita.cari', '') }}/"+id
            }).done(function(data){
                $("#modal-ubah").find("input[name=id]").val(data.data.id);
                $("#modal-ubah").find("input[name=nomor_diundangkan]").val(data.data.nomor_diundangkan);
                $("#modal-ubah").find("input[name=tanggal_diundangkan]").val(data.data.tanggal_diundangkan);
                $("#modal-ubah").find("textarea[name=keterangan]").val(data.data.keterangan);
                $("#modal-ubah").modal("show");
            });
        });

        $("#modal-ubah").find('form').submit(function(e){
            var id = $(this).find('input[name=id]').val();
            $.ajax({
                context: {
                    context: "form"
                },
                url    : "{{ route('lembar-berita.ubah', '') }}/"+id,
                type   : "PUT",
                dataType: "json",
                data   : $(this).serialize()
            }).done(function(){
                tabellembar_berita.ajax.reload();
            });
            e.preventDefault();
        });
        $('#btn-hapus').click(function(){
            if(confirm('Apakah yakin Akan Dihapus ?')){
                var row = tabellembar_berita.rows('.selected').indexes();
                var id = tabellembar_berita.rows(row).data().toArray()[0]['id'];
                $.ajax({
                    context: {
                        context : "form"
                    },
                    dataType  : "json",
                    type      : "POST",
                    url       : "{{ route('lembar-berita.hapus', '') }}/"+id
                }).done(function(data){
                    tabellembar_berita.ajax.reload();
                });
            }
        });
        $('#btn-export').click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('lembar-berita.lembar.excel') }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('lembar-berita.lembar.excel') }}";
            });
        });
    });
</script>
@endpush