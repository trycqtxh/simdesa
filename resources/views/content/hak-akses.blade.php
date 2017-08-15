@extends('layouts.template')

@section('title', 'Hak Akses')

@section('content-main')

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#aparat-desa" data-toggle="tab" aria-expanded="false">Aparat Desa</a></li>

            @if(Auth()->user()->admin)
            <li><a href="#roles" data-toggle="tab" aria-expanded="false">Aturan</a></li>
            <li><a href="#permision" data-toggle="tab" aria-expanded="true">Ijin</a></li>
            <li><a href="#history" data-toggle="tab" aria-expanded="true">Riwayat</a></li>
            @endif
        </ul>
        <div class="tab-content" style="min-height: 480px">
            <div class="tab-pane active" id="aparat-desa">
                <button class="btn btn-default btn-sm" onclick="return tambah_users()"><i class="fa fa-plus"></i> Tambah</button>
                <br>
                <br>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>NIP / NIAP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Sebagai</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <!-- /.tab-pane -->
            @if(Auth()->user()->admin)
            <div class="tab-pane" id="roles">
                <button class="btn btn-default btn-sm" onclick="return tambah()"><i class="fa fa-plus"></i>Tambah Role</button>
                <br>
                <br>
                <table class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                    <tr>
                        <th>Sebagai</th>
                        <th>Nama Tampilan</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="permision">
                <table class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Nama Tampilan</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>

            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="history">
                <table class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Sebagai</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <!-- /.tab-pane -->
            @endif
        </div>
        <!-- /.tab-content -->
    </div>
    @include('modal.hak-akses')
@endsection

@push('js')
    <script type="text/javascript">
        var $tableAparat = $('#aparat-desa > table').DataTable({
            ordering  : false,
            paging    : false,
            searching : false,
            info      : false,
            ajax   : {
                context : {
                    context: "table"
                },
                url     : "{{ route('hak-akses.aparat') }}",
                dataSrc : "table"
            },
            columns : [
                {data : 'nomor'},
                {data : 'nip'},
                {data : 'nama'},
                {data : 'jabatan'},
                {data : 'roles'},
                {data : 'act'},
            ]
        });
        var $tableRoles = $('#roles > table').DataTable({
            ordering  : false,
            paging    : false,
            searching : false,
            info      : false,
            ajax   : {
                context : {
                    context: "table"
                },
                url     : "{{ route('hak-akses.roles') }}",
                dataSrc : "table"
            },
            columns : [
                {data : 'name'},
                {data : 'display_name'},
                {data : 'desc'},
                {data : 'action'},
            ]
        });

        @if(Auth()->user()->admin)
        var $tablePermision = $('#permision > table').DataTable({
            ordering  : false,
            paging    : false,
            searching : false,
            info      : false,
            ajax   : {
                context : {
                    context: "table"
                },
                url     : "{{ route('hak-akses.permision') }}",
                dataSrc : "table"
            },
            columns : [
                {data : 'name'},
                {data : 'display_name'},
                {data : 'desc'},
                {data : 'action'},
            ]
        });
        @endif

        var $modalTambahPermission = $('#modal-tambah');
        var $modalUbahPermission = $('#modal-ubah');
        var $modalTambahUsers = $('#modal-tambah-users');
        var $modalUbahUsers = $('#modal-ubah-users');
        function tambah(){
            $.ajax({
                url : "{{ route('hak-akses.load.tambah') }}"
            }).done(function(data){
                $('#load_tambah').html(data);
                $modalTambahPermission.modal("show");
            });
        }
        function edit_permission(id){
            $.ajax({
                url : "{{ route('hak-akses.load.ubah', '') }}/"+id
            }).done(function(data){
                $('#load_ubah').html(data);
                $modalUbahPermission.modal("show");
            });
        }
        function hapus_permission(id, name){
            if(confirm("Apakah Yakin "+name+" Akan Dihapus ?")){
                $.ajax({
                    context: {
                        context : "form"
                    },
                    dataType : "json",
                    type     : "POST",
                    data     : $(this).serialize(),
                    url      : "{{ route('hak-akses.hapus', '') }}/"+id
                }).done(function(data){
                    $tableRoles.ajax.reload();
                });
            }
        }
        function tambah_users(){
            $.ajax({
                url : "{{ route('hak-akses.load.tambah-users') }}"
            }).done(function(data){
                $modalTambahUsers.modal("show");
                $modalTambahUsers.find("form").html(data);
            });
        }
        function edit_users(id){
            $.ajax({
                url : "{{ route('hak-akses.load.ubah-users', '') }}/"+id
            }).done(function(data){
                $modalUbahUsers.modal("show");
                $modalUbahUsers.find("form").html(data);
            });
        }
        function hapus_users(id, nama){
            if(confirm("Apakah anda yakin "+nama+" akan dihapus ?")){
                $.ajax({
                    context: {
                        context : "form"
                    },
                    url : "{{ route('hak-akses.users.hapus', '') }}/"+id,
                    type : "POST",
                    dataType : "json",
                }).done(function(){
                    $tableAparat.ajax.reload();
                });
            }
            return false;
        }
        $(function(){

            $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            $modalTambahPermission.find('form').submit(function(e){
                $.ajax({
                    context: {
                        context : "form"
                    },
                    dataType : "json",
                    type     : "POST",
                    data     : $(this).serialize(),
                    url      : "{{ route('hak-akses.tambah') }}"
                }).done(function(){
                    $tableRoles.ajax.reload();
                });
                e.preventDefault();
            });

            $modalUbahPermission.find('form').submit(function(e){
                var id = $(this).find('input[name=id]').val();
                $.ajax({
                    context: {
                        context : "form"
                    },
                    dataType : "json",
                    type     : "POST",
                    data     : $(this).serialize(),
                    url      : "{{ route('hak-akses.ubah', '') }}/"+id
                }).done(function(){
                    $tableRoles.ajax.reload();
                });
                e.preventDefault();
            });
            $modalTambahUsers.find("form").submit(function(e){
                $.ajax({
                    context: {
                        context : "form"
                    },
                    dataType : "json",
                    type     : "POST",
                    data     : $(this).serialize(),
                    global   : true,
                    url      : "{{ route('hak-akses.users.tambah') }}"
                }).done(function(){
                    $tableAparat.ajax.reload();
                });
                e.preventDefault();
            });
            $modalUbahUsers.find("form").submit(function(e){
                var id = $(this).find('input[name=id]').val();
                $.ajax({
                    context: {
                        context : "form"
                    },
                    dataType : "json",
                    type     : "POST",
                    data     : $(this).serialize(),
                    global   : true,
                    url      : "{{ route('hak-akses.users.ubah', '') }}/"+id
                }).done(function(){
                    $tableAparat.ajax.reload();
                });
                e.preventDefault();
            });
        });
    </script>
@endpush