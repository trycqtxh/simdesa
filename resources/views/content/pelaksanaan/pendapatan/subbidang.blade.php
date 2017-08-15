@extends('layouts.template')

@section('title', 'Rincian Biaya')

@section('content-main')
    <div class="box box-default">
        <div class="box-body">
            <table class="table table-striped" id="tabel-info">
            <thead>
                <tr>
                    <th width="15%"></th>
                    <th></th>
                </tr>                
            </thead>
            </table>
        </div>
    </div>

    {{-- BOX PANEL --}}
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-dollar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Anggaran</span>
                    <span class="info-box-number" control="anggaran"></span>
                    <div class="progress">
                        <div class="progress-bar" control="progress-bar-anggaran"></div>
                    </div>
                    <span class="progress-description" control="progress-description-anggaran"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Realisasi</span>
                    <span class="info-box-number" control="realisasi"></span>
                    <div class="progress">
                        <div class="progress-bar" control="progress-bar-realisasi"></div>
                    </div>
                    <span class="progress-description" control="progress-description-realisasi"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-random"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Selisih</span>
                    <span class="info-box-number" control="selisih"></span>
                    <div class="progress">
                        <div class="progress-bar" control="progress-bar-selisih"></div>
                    </div>
                    <span class="progress-description" control="progress-description-selisih"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    {{-- END BOX PANEL--}}

    <div class="box box-default">
        <div class="box-header">
            <h4>Rincian Realisasi</h4>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped" id="tabel-realisasi">
                <thead>
                <tr>
                    <th width="10%">Nomor Bukti</th>
                    <th width="10%">Metode</th>
                    <th width="10%">Tanggal</th>
                    <th>Uraian</th>
                    <th width="20%">Jumlah</th>
                </tr>
                </thead>
                <tbody>
                <tr>
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

@endsection

@push('js')
<script type="text/javascript">
    var tabelInfo = $("#tabel-info").DataTable({
        ordering  : false,
        paging    : false,
        searching : false,
        info      : false,
        ajax      : {
            context : {
                context: 'table'
            },
            url     : "{{ url()->current() }}",
            dataSrc : "data.info"
        },
        columns   : [
            {"data" : "index"},
            {"data" : "value"},
        ]
    });

    var tabelRealisasi = $("#tabel-realisasi").DataTable({
        ordering  : false,
        paging    : false,
        searching : false,
        info      : false,
        ajax      : {
            context : {
                context: 'table'
            },
            url     : "{{ url()->current() }}",
            dataSrc : "data.rincian"
        },
        columns   : [
            {"data" : "nomor_bukti"},
            {"data" : "metode"},
            {"data" : "tanggal"},
            {"data" : "uraian"},
            {"data" : "jumlah", 'className': 'text-right'},
        ]
    });

    //--------------------------------------- Control
    function control_panel() {
        var jXHR = $.ajax({
            url      : "{{ url()->current() }}",
            global   : false,
            type     : "GET",
            dataType : "json",
        });
        jXHR.done(function (data) {
            var control = data.control;
            var comma = $.animateNumber.numberStepFactories.separator('.');

            $('span[control=anggaran]').animateNumber({number: control.anggaran, numberStep: comma}, 1500);
            $('div[control=progress-bar-anggaran]').animate({width: control.anggaran_progress_bar}, 1500);
            $('span[control=progress-description-anggaran]').text(control.anggaran_progress_description);

            $('span[control=realisasi]').animateNumber({number: control.realisasi, numberStep: comma}, 1500);
            $('div[control=progress-bar-realisasi]').animate({width: control.realisasi_progress_bar}, 1500);
            $('span[control=progress-description-realisasi]').text(control.realisasi_progress_description);

            if (control.selisih < 0) {
                $('#selisih').removeClass('bg-yellow');
                $('#selisih').addClass('bg-red');
            }else{
                $('#selisih').removeClass('bg-red');
                $('#selisih').addClass('bg-yellow');
            }
            var selisih = Math.abs(control.selisih);
            $('span[control=selisih]').animateNumber({number: selisih, numberStep: comma}, 1500);
            $('div[control=progress-bar-selisih]').animate({width: control.selisih_progress_bar}, 1500);
            $('span[control=progress-description-selisih]').text(control.selisih_progress_description);
        });
    }
    //------------------------------------------------End Control

    $(function(){
        control_panel();
    });
</script>
@endpush