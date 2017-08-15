@php($profil = new App\Entities\ProfilDesa()))

<style type="text/css">
    .form-group-sm{
        margin-bottom: 0px;
    }
    td{
        padding: 10px;
    }
    #template-surat p{
        text-align: left;
        font-family: 'Times New Roman';
        font-size: 12pt;
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
        <h4>Pihak 1</h4>
        <table class="table table-striped table-bordered" id="tabel-1">
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
        <h4>Pihak 2</h4>
        <table class="table table-striped table-bordered" id="tabel-2">
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
        <h3><u>SURAT KETERANGAN BELUM KAWIN</u></h3>

        <div class=" col-xs-4"></div>
        <div class="form-group form-group-sm col-xs-4"><input class="form-control" name="nomor_surat"></div>
        <div class=" col-xs-4"></div>
        <br>
        <br>
        <br>
        <br>
        <p>Kepala {{ $profil->find('des')['value'].' '.$profil->find('nama_desa')['value'].' '.$profil->find('kec')['value'].' '.$profil->find('kecamatan')['value'] }}
            Pemerintah Daerah {{ $profil->find('kab')['value'].' '.$profil->find('kota')['value']}} menerangkan dengan sesungguhnya bahwa :</p>

        <table id="surat" style="font-size:12pt; text-align: left; font-family: 'Times New Roman'" align="center" width="90%">
            <tbody>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:30%">Nama</td>
                <td style="width:1%">:</td>
                <td style="width:69%"><div class="form-group form-group-sm"><input class="form-control" name="nama1"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Tempat Tanggal Lahir</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="tempat_tanggal_lahir1"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Bangsa</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="warga_negara1"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="jenis_kelamin1"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Pekerjaan</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="pekerjaan1" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Alamat</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="alamat1" ></div></td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            </tbody>
        </table>

        <p>Orang tersebut di atas menurut data yang ada pada kami betul-betul Sudah bercerai dengan Suaminya :</p>

        <table id="surat" style="font-size:12pt; text-align: left; font-family: 'Times New Roman'" align="center" width="90%">
            <tbody>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:30%">Nama</td>
                <td style="width:1%">:</td>
                <td style="width:69%"><div class="form-group form-group-sm"><input class="form-control" name="nama2"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Tempat Tanggal Lahir</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="tempat_tanggal_lahir2"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Bangsa</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="warga_negara2"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="jenis_kelamin2"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Pekerjaan</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="pekerjaan2" ></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Alamat</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="alamat2" ></div></td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            </tbody>
        </table>
        <p>Demikian surat keterangan ini, kami buat dengan sebenarnya untuk di pergunakan sebagaimana mestinya.</p>

        <button class="btn btn-lg btn-default" style="position: fixed; bottom: 75px; right: 5px" id="download"><i class="fa fa-download"></i></button>
    </div>
    </form>
</div>

{{ Html::script('assets/plugins/slimScroll/jquery.slimscroll.js') }}
<script type="text/javascript">
    var tabel1 = $('#tabel-1').DataTable({
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
    var tabel2 = $('#tabel-2').DataTable({
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
        tabel1.on('select', function(){
            var row = tabel1.rows('.selected').indexes();
            var data = tabel1.rows(row).data().toArray()[0];

            $('#step-2').find('input[name=nama1]').val(data['nama']);
            $('#step-2').find('input[name=tempat_tanggal_lahir1]').val(data['tempat_tanggal_lahir']);
            $('#step-2').find('input[name=warga_negara1]').val(data['warga_negara']);
            $('#step-2').find('input[name=jenis_kelamin1]').val(data['jenis_kelamin']);

            $('#step-2').find('input[name=pekerjaan1]').val(data['pekerjaan']);
            $('#step-2').find('input[name=alamat1]').val(data['alamat']);
        });
        tabel2.on('select', function(){
            var row = tabel2.rows('.selected').indexes();
            var data = tabel2.rows(row).data().toArray()[0];

            $('#step-2').find('input[name=nama2]').val(data['nama']);
            $('#step-2').find('input[name=tempat_tanggal_lahir2]').val(data['tempat_tanggal_lahir']);
            $('#step-2').find('input[name=warga_negara2]').val(data['warga_negara']);
            $('#step-2').find('input[name=jenis_kelamin2]').val(data['jenis_kelamin']);

            $('#step-2').find('input[name=pekerjaan2]').val(data['pekerjaan']);
            $('#step-2').find('input[name=alamat2]').val(data['alamat']);
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