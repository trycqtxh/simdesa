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
    <div class="col-xs-12">
        <table class="table table-striped table-bordered" id="tabel-anak">
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
        <h3><u>SURAT KETERANGAN KELAHIRAN</u></h3>

        <div class=" col-xs-4"></div>
        <div class="form-group form-group-sm col-xs-4"><input class="form-control" name="nomor_surat"></div>
        <div class=" col-xs-4"></div>

        <table id="surat" style="font-size:12pt; text-align: left; font-family: 'Times New Roman'" align="center" width="90%">
            <tbody><tr>
                <td colspan="4">Yang bertanda tangan dibawah ini, menerangkan bahwa pada :</td>
            </tr>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:30%">Hari</td>
                <td style="width:1%">:</td>
                <td style="width:69%"><div class="form-group form-group-sm"><input class="form-control" name="hari_lahir"></div></td>
            </tr>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:30%">Tanggal</td>
                <td style="width:1%">:</td>
                <td style="width:69%"><div class="form-group form-group-sm"><input class="form-control" name="tanggal_lahir"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Pukul</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="jam_lahir"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Tempat Kelahiran</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="tempat_lahir"></div></td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Telah lahir anak</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="jenis_kelamin_anak" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Bernama</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="nama_anak" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Dari seorang ibu</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Nama Lengkap Ibu</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="nama_ibu" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>NIK</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="nik_ibu" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Umur</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="umur_ibu" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Pekerjaan </td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="pekerjaan_ibu"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Alamat</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="alamat_ibu" ></div></td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Istri dari</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="nama_ayah" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>NIK</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="nik_ayah" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Umur</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="umur_ayah" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Pekerjaan</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="pekerjaan_ayah" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Alamat</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="alamat_ayah" ></div></td>
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
    var tabel = $('#tabel-anak').DataTable({
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
        tabel.on('select', function(){
            var row = tabel.rows('.selected').indexes();
            var data = tabel.rows(row).data().toArray()[0];

            $('#step-2').find('input[name=hari_lahir]').val(data['hari_lahir']);
            $('#step-2').find('input[name=tanggal_lahir]').val(data['tanggal_lahir']);
            $('#step-2').find('input[name=jam_lahir]').val(data['jam_lahir']);
            $('#step-2').find('input[name=tempat_lahir]').val(data['tempat_lahir']);

            $('#step-2').find('input[name=nama_anak]').val(data['nama']);
            $('#step-2').find('input[name=jenis_kelamin_anak]').val(data['jenis_kelamin']);

            $('#step-2').find('input[name=nama_ibu]').val(data['ibu']);
            $('#step-2').find('input[name=nik_ibu]').val(data['nik_ibu']);
            $('#step-2').find('input[name=umur_ibu]').val(data['umur_ibu']);
            $('#step-2').find('input[name=pekerjaan_ibu]').val(data['pekerjaan_ibu']);
            $('#step-2').find('input[name=alamat_ibu]').val(data['alamat_ibu']);

            $('#step-2').find('input[name=nama_ayah]').val(data['ayah']);
            $('#step-2').find('input[name=nik_ayah]').val(data['nik_ayah']);
            $('#step-2').find('input[name=umur_ayah]').val(data['umur_ayah']);
            $('#step-2').find('input[name=pekerjaan_ayah]').val(data['pekerjaan_ayah']);
            $('#step-2').find('input[name=alamat_ayah]').val(data['alamat_ayah']);
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
                suratMenyurat.ajax.reload();
            }).fail(function(event, xhr, settings, thrownError){
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