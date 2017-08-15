<style type="text/css">
    .form-group-sm{
        margin-bottom: 0px;
    }
    td{
        padding: 10px;
    }
</style>
<div class="row form-group">
    <div class="col-xs-12">
        <ul class="nav nav-pills nav-justified thumbnail setup-panel" style="margin-bottom: 20px">
            <li class="active"><a href="#step-1">
                    <h4 class="list-group-item-heading">Surat</h4>
                </a></li>
            <li class=""><a href="#step-2">
                    <h4 class="list-group-item-heading">Lihat Surat</h4>
                </a></li>
        </ul>
    </div>
</div>

<div class="row setup-content" id="step-1">
    <div class="col-xs-6">
        <h4>Orang yang Meninggal</h4>
        <br>
        <table class="table table-striped table-bordered" id="tabel-meninggal">
            <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="col-xs-6">
        <h4>Pelapor :</h4>
        <br>
        <table class="table table-striped table-bordered" id="tabel-pelapor">
            <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<div class="row setup-content" id="step-2">
    <form role="form" id="form-surat">
    <div class="col-xs-12 text-center well" id="template-surat" style="height: inherit; padding-left: 160px; padding-right: 160px">
        <h3><u>SURAT KETERANGAN KEMATIAN</u></h3>

        <div class=" col-xs-4"></div>
        <div class="form-group form-group-sm col-xs-4"><input class="form-control" name="nomor_surat"></div>
        <div class=" col-xs-4"></div>

        <table id="surat" style="font-size:12pt; text-align: left; font-family: 'Times New Roman'" align="center" width="90%">
            <tbody><tr>
                <td colspan="4">Yang bertanda tangan dibawah ini, menerangkan bahwa :</td>
            </tr>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:30%">Nama Lengkap</td>
                <td style="width:1%">:</td>
                <td style="width:69%"><div class="form-group form-group-sm"><input class="form-control" name="nama"></div></td>
            </tr>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:30%">Jenis Kelamin</td>
                <td style="width:1%">:</td>
                <td style="width:69%"><div class="form-group form-group-sm"><input class="form-control" name="jenis_kelamin"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Tempat Tanggal Kelahiran</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="tempat_tanggal_lahir"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Agama</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="agama" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Pekerjaan</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="pekerjaan" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Alamat</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="alamat" ></div></td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Telah meninggal dunia pada</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Hari</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="hari_meninggal" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Tanggal</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="tanggal_meninggal" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Bertempat di</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="tempat_meninggal" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Penyebab Kematian </td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="penyebab_meninggal"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2">Surat keterangan ini dibuat berdasarkan keterangan Pelapor</td>
                <td>:</td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="nama_pelapor" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Tempat tanggal Lahir</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="tempat_tanggal_lahir_pelapor" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Umur</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="umur_pelapor" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Pekerjaan</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="pekerjaan_pelapor" ></div></td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td>Hubungan Pelapor dengan yang  Meninggal</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="hubungan_pelapor" ></div></td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            </tbody></table>

        <button class="btn btn-lg btn-default" style="position: fixed; bottom: 75px; right: 5px" id="download"><i class="fa fa-download"></i></button>
    </div>
    </form>
</div>

{{ Html::script('assets/plugins/slimScroll/jquery.slimscroll.js') }}
<script type="text/javascript">
    var tabelMeninggal = $('#tabel-meninggal').DataTable({
        ajax : {
            url : "{{ route('surat.penduduk-meninggal') }}"
        },
        select    : {
            style: 'single'
        },
        columns : [
            {data : "nik"},
            {data : "nama"},
            {data : "jenis_kelamin"},
        ]
    });
    var tabelPelapor = $('#tabel-pelapor').DataTable({
        ajax : {
            url : "{{ route('surat.penduduk') }}"
        },
        select    : {
            style: 'single'
        },
        columns : [
            {data : "nik"},
            {data : "nama"},
            {data : "jenis_kelamin"},
        ]
    });

    $(function(){
        tabelMeninggal.on('select', function(){
            var row = tabelMeninggal.rows('.selected').indexes();
            var data = tabelMeninggal.rows(row).data().toArray()[0];

            $('#step-2').find('input[name=nama]').val(data['nama']);
            $('#step-2').find('input[name=jenis_kelamin]').val(data['jenis_kelamin']);
            $('#step-2').find('input[name=tempat_tanggal_lahir]').val(data['tempat_tanggal_lahir']);
            $('#step-2').find('input[name=agama]').val(data['agama']);
            $('#step-2').find('input[name=pekerjaan]').val(data['pekerjaan']);
            $('#step-2').find('input[name=alamat]').val(data['alamat']);

            $('#step-2').find('input[name=hari_meninggal]').val(data['hari_meninggal']);
            $('#step-2').find('input[name=tanggal_meninggal]').val(data['tanggal_meninggal']);
            $('#step-2').find('input[name=tempat_meninggal]').val(data['tempat_meninggal']);
            $('#step-2').find('input[name=penyebab_meninggal]').val(data['penyebab_meninggal']);
        });
        tabelPelapor.on('select', function(){
            var row = tabelPelapor.rows('.selected').indexes();
            var data = tabelPelapor.rows(row).data().toArray()[0];

            $('#step-2').find('input[name=nama_pelapor]').val(data['nama']);
            $('#step-2').find('input[name=tempat_tanggal_lahir_pelapor]').val(data['tempat_tanggal_lahir']);
            $('#step-2').find('input[name=umur_pelapor]').val(data['umur']);
            $('#step-2').find('input[name=pekerjaan_pelapor]').val(data['pekerjaan']);
        });

        $('form#form-surat').submit(function(e){
            $.ajax({
                type    : "POST",
                dataType: "json",
                url     : "{{ route('surat.save', $jenis) }}",
                data    : $(this).serialize()
            }).done(function(data){
                NOTIF.show({
                    title   : data.message,
                    message : data.message
                });
                window.location = "{{ route('surat.download', '') }}/"+data.path_download;
            }).fail(function(event, xhr, settings, thrownError){
                console.log(event);
                console.log(xhr);
                console.log(settings);
                $.each(event.responseJSON, function(key, val){
                    NOTIF.show({
                        title   : event.responseJSON.title,
                        message : val
                    });
                });
            });
            e.preventDefault();
        });

        var navListItems = $('ul.setup-panel li a'),
                allWells = $('.setup-content');

        allWells.hide();

        navListItems.click(function(e)
        {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                    $item = $(this).closest('li');

            if (!$item.hasClass('disabled')) {
                navListItems.closest('li').removeClass('active');
                $item.addClass('active');
                allWells.hide();
                $target.show();
            }
        });

        $('ul.setup-panel li.active a').trigger('click');
        $('#template-surat').slimScroll({
            height: '335px',
            width : '100%'
        });
    });
</script>