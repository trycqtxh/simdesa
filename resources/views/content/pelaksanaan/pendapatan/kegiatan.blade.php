@extends('layouts.template')

@section('title', 'Rincian Biaya')

@section('content-main')
    <div class="box box-default">
        <div class="box-body">
            <table class="table table-striped" id="info">
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
            <div class="info-box bg-yellow" id="selisih">
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
            <div class="btn-group btn-group-sm">
                @permission('add-pendapatan-pelaksanaan')
                <button class="btn btn-default" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
                @endpermission
                @permission('edit-pendapatan-pelaksanaan')
                <button class="btn btn-default" id="btn-ubah" disabled><i class="fa fa-edit"></i> Ubah</button>
                @endpermission
                @permission('remove-pendapatan-pelaksanaan')
                <button class="btn btn-default" id="btn-hapus" disabled><i class="fa fa-trash"></i> Hapus</button>
                @endpermission
            </div>
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
    @include('modal.pelaksanaan.pendapatan')
@endsection

@push('js')
<script type="text/javascript">

    var info = $('#info').DataTable({
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
        fixedHeader : true,
        columns   : [
            {"data" : "satu"},
            {"data" : "dua"},
        ]
    });

    var table = $('#tabel-realisasi').DataTable({
        ordering  : false,
        paging    : false,
        searching : false,
        info      : false,
        select    : {
            style: 'single'
        },
        ajax      : {
            context : {
                context: 'table'
            },
            url     : "{{ route('pelaksanaan.apbd.pendapatan.kegiatan', $id) }}",
            dataSrc : "data.rincian"
        },
        fixedHeader : true,
        columns   : [
            {"data" : "nomor_bukti"},
            {"data" : "metode"},
            {"data" : "tanggal"},
            {"data" : "uraian"},
            {"data" : "jumlah", 'className': 'text-right'},
        ]
    });
    var btnTambah = $('#btn-tambah');
    var btnUbah = $('#btn-ubah');
    var btnHapus = $('#btn-hapus');
    var modalTambah = $('#modal-tambah');
    var modalUbah = $('#modal-ubah');

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
        table.on('select', function(){
            btnUbah.attr('disabled', false);
            btnHapus.attr('disabled', false);
        }).on('deselect', function(){
            btnUbah.prop('disabled', true);
            btnHapus.prop('disabled', true);
        });
        btnTambah.click(function(){
            modalTambah.modal("show");
        });
        modalTambah.find('form').submit(function(e){
            $('input[name=jumlah]').inputmask('remove');
            $.ajax({
                context : {
                    context : "form"
                },
                url      : "{{ route('pelaksanaan.apbd.pendapatan.tambah') }}",
                type     : "POST",
                dataType : "json",
                data     : $(this).serialize(),
            }).done(function(){
                $('input[name=jumlah]').inputmask({alias: "rupiah"});
                table.ajax.reload();
                info.ajax.reload();
                control_panel();
            }).fail(function(){
                $('input[name=jumlah]').inputmask({alias: "rupiah"});
            });
            e.preventDefault();
        });
        btnUbah.click(function(){
            var row = table.rows('.selected').indexes();
            var id = table.rows(row).data().toArray()[0]['id'];
            $.ajax({
                global    : false,
                url       : "{{ route('pelaksanaan.apbd.pendapatan.cari', '') }}/"+id,
                dataType  : "json"
            }).done(function(data){
                var data = data[0];
                var form = modalUbah.find("form");
                form.find('input[name=id]').val(data.id);
                form.find('input[name=nomor_bukti]').val(data.nomor_bukti);
                form.find('select[name=metode]').val(data.metode);
                form.find('input[name=tanggal]').val(data.tanggal);
                form.find('textarea[name=uraian]').val(data.uraian);
                form.find('input[name=jumlah]').val(data.jumlah);
                modalUbah.modal("show");
            });
        });
        modalUbah.find("form").submit(function(e){
            $('input[name=jumlah]').inputmask('remove');
            var id = $(this).find('input[name=id]').val();
            $.ajax({
                context : {
                    context : "form"
                },
                type    : "PUT",
                dataType: "json",
                data    : $(this).serialize(),
                url     : "{{ route('pelaksanaan.apbd.pendapatan.ubah', '') }}/"+id,
            }).done(function(){
                $('input[name=jumlah]').inputmask({alias: "rupiah"});
                table.ajax.reload();
                info.ajax.reload();
                control_panel();
            }).fail(function(){
                $('input[name=jumlah]').inputmask({alias: "rupiah"});
            });
            e.preventDefault();
        });
        btnHapus.click(function(){
            var row = table.rows('.selected').indexes();
            var id = table.rows(row).data().toArray()[0]['id'];
            var nomor = table.rows(row).data().toArray()[0]['nomor_bukti'];
            if(confirm('Apakah Yakin Nomor Bukti "'+nomor+'" ini Akan Dihapus ?')){
                $.ajax({
                    context : {
                        context : "form"
                    },
                    type    : "POST",
                    dataType: "json",
                    url      : "{{ route('pelaksanaan.apbd.pendapatan.hapus', '') }}/"+id
                }).done(function(e){
                    table.ajax.reload();
                    info.ajax.reload();
                    control_panel();
                });
                return true;
            }
            return false;
        });

        $('input[name=tanggal]').datepicker({
            format : 'yyyy-mm-dd'
        });
        $('input[name=jumlah]').inputmask({alias: "rupiah"});
    });
</script>
@endpush