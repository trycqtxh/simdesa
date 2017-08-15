@extends('layouts.template')

@section('title', 'RKK Desa - Rencana Kegiatan Kerja Pemerintah Desa')

@section('content-header')
    <section class="content-header">
        <h1>
            RKK - Rencana Kerja Kegiatan Desa {{ $tahun }}
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
                    <th colspan="3">BIDANG /JENIS KEGIATAN</th>
                    <th rowspan="2">LOKASI</th>
                    <th rowspan="2">VOLUME</th>
                    <th rowspan="2">SATUAN</th>
                    <th rowspan="2">BIAYA</th>
                    <th colspan="4">SASARAN</th>
                    <th colspan="3">WAKTU PELAKSANAAN</th>
                </tr>
                <tr>
                    <th>BIDANG</th>
                    <th>SUB BIDANG</th>
                    <th>JENIS KEGIATAN</th>
                    <th>JUMLAH</th>
                    <th>LAKI-LAKI</th>
                    <th>PERERMPUAN</th>
                    <th>A-RTM</th>
                    <th>DURASI</th>
                    <th>MULAI</th>
                    <th>SELESAI</th>
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
                </thead>
                <tbody>
                <tr>
                    <td>#</td>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                    <td>11</td>
                    <td>12</td>
                    <td>13</td>
                    <td>14</td>
                    <td>15</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    @include('modal.perencanaan.rkk')
@endsection

@push('js')
<script type="text/javascript">
    var modalTambah = $('#modal-tambah');
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
            url     : "{{ url()->current() }}",
            dataSrc : "data"
        },
        columns   : [
            {"data" : "act"},
            {"data" : "no"},
            {"data" : "bidang"},
            {"data" : "sub_bidang"},
            {"data" : "jenis_kegiatan"},
            {"data" : "lokasi"},
            {"data" : "volume"},
            {"data" : "satuan"},
            {"data" : "biaya", 'className': 'text-right'},
            {"data" : "jumlah_sasaran"},
            {"data" : "jumlah_laki_laki"},
            {"data" : "jumlah_perempuan"},
            {"data" : "jumlah_rtm"},
            {"data" : "pelaksanaan_durasi"},
            {"data" : "pelaksanaan_mulai"},
            {"data" : "pelaksanaan_selesai"},
        ]
    });
    function tambah(id, uraian, rkp){
        modalTambah.find('input[name=uraian]').val(uraian);
        modalTambah.find('input[name=detail_kegiatan_kerja_id]').val(id);
        modalTambah.find('input[name=rkp_id]').val(rkp);
        modalTambah.modal('show');
    }
    function ubah(uraian, id, jumlah_laki_laki, jumlah_perempuan, jumlah_rt_m, waktu_mulai, waktu_selesai){
        if(id){
            modalUbah.find('input[name=uraian]').val(uraian);
            modalUbah.find('input[name=id]').val(id);
            modalUbah.find('input[name=jumlah_laki_laki]').val(jumlah_laki_laki);
            modalUbah.find('input[name=jumlah_perempuan]').val(jumlah_perempuan);
            modalUbah.find('input[name=jumlah_rt_m]').val(jumlah_rt_m);
            modalUbah.find('input[name=waktu_mulai]').val(waktu_mulai);
            modalUbah.find('input[name=waktu_selesai]').val(waktu_selesai);
            modalUbah.modal('show');
        }
        return false;
    }
    $(function(){

        $('input[name=jumlah_laki_laki]').inputmask({mask:"99"});
        $('input[name=jumlah_perempuan]').inputmask({mask:"99"});
        $('input[name=jumlah_rt_m]').inputmask({mask:"99"});
        modalTambah.find('form').submit(function(e){
            $('input[name=jumlah_laki_laki]').inputmask('remove');
            $('input[name=jumlah_perempuan]').inputmask('remove');
            $('input[name=jumlah_rt_m]').inputmask('remove');
            $.ajax({
                context: {
                    context : "form"
                },
                type   : "POST",
                dataType : "json",
                data     : $(this).serialize(),
                url      : "{{ route('rkk.tambah') }}"
            }).done(function(){
                table.ajax.reload()
            }).fail(function(){
                $('input[name=jumlah_laki_laki]').inputmask({mask:"99"});
                $('input[name=jumlah_perempuan]').inputmask({mask:"99"});
                $('input[name=jumlah_rt_m]').inputmask({mask:"99"});
            });
            e.preventDefault();
        });
        modalUbah.find('form').submit(function(e){
            var  id = $(this).find('input[name=id]').val();
            $.ajax({
                context: {
                    context : "form"
                },
                type   : "PUT",
                dataType : "json",
                data     : $(this).serialize(),
                url      : "{{ route('rkk.ubah', '') }}/"+id
            }).done(function(){
                table.ajax.reload()
            });
            e.preventDefault();

        });

        $('input[name=waktu_mulai]').datepicker({
            format : 'yyyy-mm-dd',
            startDate : 'today',

        });

        $('#waktu_mulai').on('change', function(){
             $('input[name=waktu_selesai]').datepicker({
                 format : 'yyyy-mm-dd',
                 startDate :  $('#waktu_mulai').val()

             });
        });

        $('#btn-export').click(function(){
            $.ajax({
                context  : {
                    context : "form"
                },
                url      : "{{ route('rkk.excel', $id) }}",
                type     : "GET",
                dataType : "json",
            }).done(function(data){
                console.log(data);
                window.location = "{{ route('rkk.excel', $id) }}";
            });
        });
    })
</script>
@endpush