@extends('layouts.template')

@section('title', 'Rancangan Belanja APBD')

@section('content-header')
    <section class="content-header">
        <h1>
            @yield('title') Tahun {{ $current_year }}
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection


@section('content-main')
    <div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered table-striped" id="tabel">
                <thead>
                <tr>
                    <th colspan="4" width="8%">Kode Rekening</th>
                    <th>Uraian</th>
                    <th>Anggaran (Rp.)</th>
                    <th>Keterangan</th>
                </tr>
                <tr>
                    <th colspan="4">1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('js')
<script type="text/javascript">
    var tabel = $('#tabel').DataTable({
        ordering     : false,
        info         : false,
        paging       : false,
        searching    : false,
        lengthChange : false,
        scrollX      : false,
        fixedHeader  : true,
        select    : {
            style: 'single'
        },
        ajax      : {
            context : {
                context: 'table'
            },
            url     : "{{ route('belanja.index') }}",
            dataSrc : "data"
        },
        columns   : [
            {"data" : "kode_1"},
            {"data" : "kode_2"},
            {"data" : "kode_3"},
            {"data" : "kode_4"},
            {"data" : "uraian"},
            {"data" : "anggaran", 'className': 'text-right'},
            {"data" : "keterangan"},
        ]
    });
</script>
@endpush