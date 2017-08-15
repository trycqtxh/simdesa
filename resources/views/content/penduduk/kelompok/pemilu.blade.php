@extends('layouts.template')

@section('title', 'Kelompok Penduduk Pemilih Pemilu')

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
            <table class="table table-bordered" id="table">
                <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('js')
<script type="text/javascript">
    $(function(){
        $('table#table').DataTable({
            ordering     : false,
            paging       : false,
            searching    : false,
            lengthChange: false,
            language  : {
                url : "{{ url('assets/plugins/datatables/indonesia.json') }}"
            },
            ajax : {
                url : "{{ route('kelompok.pemilu') }}",
                dataSrc : 'data'
            },
            columns   : [
                {"data" : "nik"},
                {"data" : "nama"},
                {"data" : "jenis_kelamin"},
                {"data" : "tempat_lahir"},
                {"data" : "tanggal_lahir"},

//                {"data" : "status_perkawinan"},
//                {"data" : "agama"},
//                {"data" : "pendidikan"},
//                {"data" : "pekerjaan"},
//                {"data" : "membaca"},
//                {"data" : "kewarga_negaraan"},
//                {"data" : "alamat"},
//                {"data" : "status_keluarga"},
//                {"data" : "nomor_kk"},
//                {"data" : "keterangan"},
            ],

        });
    });
</script>
@endpush