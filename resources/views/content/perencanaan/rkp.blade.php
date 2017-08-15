@extends('layouts.template')

@section('title', 'RKP Desa - Rencana Kerja Pemerintah Desa')

@section('content-header')
    <section class="content-header">
        <h1>
            RKP - Rencana Kerja Pemerintah Desa {{ $tahun }}
            <small>{{ config('app.name') }}</small>
        </h1>
    </section>
@endsection

@section('content-main')
    <div class="box box-default">
        <div class="box-body">
            <button class="btn btn-default btn-sm" id="btn-export"><i class="fa fa-download"></i> Export</button>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered" id="table">
                <thead>
                <tr>
                    <th rowspan="3">#</th>
                    <th rowspan="2">NO</th>
                    <th colspan="4">JENIS KEGIATAN<br></th>
                    <th rowspan="2">LOKASI</th>
                    <th rowspan="2">VOLUME</th>
                    <th rowspan="2">SASARAN / MANFAAT<br></th>
                    <th rowspan="2">WAKTU PELAKSANAAN<br></th>
                    <th colspan="2">BIAYA DAN SUMBER DANA<br></th>
                    <th colspan="3">POLA PELAKSANAAN<br></th>
                    <th rowspan="2">RENCANA PELAKSANAAN KEGIATAN<br></th>
                </tr>
                <tr>
                    <th>BIDANG</th>
                    <th></th>
                    <th>SUB BIDANG</th>
                    <th>JENIS KEGIATAN<br></th>
                    <th>JUMLAH (Rp.)<br></th>
                    <th>SUMBER DANA<br></th>
                    <th>SWAKELOLA</th>
                    <th>KERJASAMA ANTAR DESA<br></th>
                    <th>KERJA SAMA PIHAK TIGA<br></th>
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
                </tr>
            </table>
        </div>
    </div>
    @include('modal.perencanaan.rkp')
@endsection


@push('js')
<script type="text/javascript">
    var modalUbah = $('#modal-ubah');
    var table = $('#table').DataTable({
        ordering     : false,
        paging       : true,
        searching    : false,
        lengthChange : false,
        scrollX      : true,
        scrollY      : "400px",
        fixedHeader  : true,
        scrollCollapse: true,
        scroller     : true,
        stateSave    : true,
        select    : {
            style: 'single'
        },
        ajax      : {
            context : {
                context: 'table'
            },
            url     : "{{ route('rkp.index', ['id'=>$id]) }}",
            dataSrc : "data"
        },
        columns   : [
            {"data" : "action"},
            {"data" : "no"},
            {"data" : "bidang"},
            {"data" : "kosong"},
            {"data" : "sub_bidang"},
            {"data" : "jenis_kegiatan"},
            {"data" : "lokasi"},
            {"data" : "volume"},
            {"data" : "manfaat"},
            {"data" : "waktu_pelaksanaan"},
            {"data" : "jml", 'className': 'text-right'},
            {"data" : "sumber"},
            {"data" : "swakelola"},
            {"data" : "antar_desa"},
            {"data" : "pihak_tiga"},
            {"data" : "rencana_pelaksanaan"},
        ]
    });

    function ubah(rkp_id, rencana_kegiatan, uraian){
        modalUbah.find('input[name=id]').val(rkp_id);
        modalUbah.find('input[name=uraian]').val(uraian);
        modalUbah.find('textarea[name=rencana_kegiatan]').val(rencana_kegiatan);
        modalUbah.modal('show');
    }

    $(function(){
        modalUbah.find('form').submit(function(e){
            var id = $(this).find('input[name=id]').val();
            $.ajax({
                context :{
                    context : "form"
                },
                dataType : "json",
                data     : $(this).serialize(),
                url      : "{{ route('rkp.ubah', '') }}/"+id,
                type     : "PUT"
            }).done(function(){
                table.ajax.reload();
            });
            e.preventDefault();
        });

        $('#btn-export').click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('rkp.excel', $id) }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('rkp.excel', $id) }}";
            });
        });
    });
</script>
@endpush