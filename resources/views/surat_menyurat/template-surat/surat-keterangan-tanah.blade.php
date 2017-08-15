@php($profil = new App\Entities\ProfilDesa() )
<style type="text/css" xmlns="http://www.w3.org/1999/html">
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
        <h3><u>SURAT KETERANGAN TANAH</u></h3>

        <div class=" col-xs-4"></div>
        <div class="form-group form-group-sm col-xs-4"><input class="form-control" name="nomor_surat"></div>
        <div class=" col-xs-4"></div>
        <br>
        <br>
        <br>
        <br>
        <p>Yang bertanda tangan di bawah ini:</p>
        <table id="surat" style="font-size:12pt; text-align: left; font-family: 'Times New Roman'" align="center" width="90%">
            <tbody>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:30%">Nama</td>
                <td style="width:1%">:</td>
                <td style="width:69%"><div class="form-group form-group-sm"><input class="form-control" name="kepala_desa" value="{{ $profil->find('kepala_desa')['value'] }}" readonly></div></td>
            </tr>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:30%">Jabtan</td>
                <td style="width:1%">:</td>
                <td style="width:69%"><div class="form-group form-group-sm"><input class="form-control" name="jabatan" value="Kepala Desa" readonly></div></td>
            </tr>
            </tbody>
        </table>
        <br>
        <br>
        <p>
            Menerangkan dengan sesungguhnya bahwa:
        </p>
        <table id="surat" style="font-size:12pt; text-align: left; font-family: 'Times New Roman'" align="center" width="90%">
            <tbody>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:30%">Nama Lengkap</td>
                <td style="width:1%">:</td>
                <td style="width:69%"><div class="form-group form-group-sm"><input class="form-control" name="nama"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Tempat Tanggal Lahir</td>
                <td>:</td>
                <td><div class="form-group form-group-sm"><input class="form-control" name="tempat_tanggal_lahir"></div></td>
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
            </tbody>
        </table>

        <p>
            Adalah benar pemilik tanah seluas <input type="text" name="luas_tanah"> m2 dan / atau bangunan seluas <input name="luas_bangunan"> m2
            yang terletak di
            <input name="alamat_tanah">
            dengan batas - batas kepemilikan
        </p>
        <table id="surat" style="font-size:12pt; text-align: left; font-family: 'Times New Roman'" align="center" width="90%">
            <tbody>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:30%">Sebelah Utara</td>
                <td style="width:1%">:</td>
                <td style="width:30%"><div class="form-group form-group-sm"><input class="form-control" name="utara"></div></td>
                <td style="width:8%">NOP</td>
                <td style="width:30%"><div class="form-group form-group-sm"><input class="form-control" name="nop_utara"></div></td>
            </tr>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:30%">Sebelah Timur</td>
                <td style="width:1%">:</td>
                <td style="width:30%"><div class="form-group form-group-sm"><input class="form-control" name="timur"></div></td>
                <td style="width:8%">NOP</td>
                <td style="width:30%"><div class="form-group form-group-sm"><input class="form-control" name="nop_timur"></div></td>
            </tr>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:30%">Sebelah Selatan</td>
                <td style="width:1%">:</td>
                <td style="width:30%"><div class="form-group form-group-sm"><input class="form-control" name="selatan"></div></td>
                <td style="width:8%">NOP</td>
                <td style="width:30%"><div class="form-group form-group-sm"><input class="form-control" name="nop_selatan"></div></td>
            </tr>
            <tr>
                <td style="width:5%">&nbsp;</td>
                <td style="width:30%">Sebelah Barat</td>
                <td style="width:1%">:</td>
                <td style="width:30%"><div class="form-group form-group-sm"><input class="form-control" name="barat"></div></td>
                <td style="width:8%">NOP</td>
                <td style="width:30%"><div class="form-group form-group-sm"><input class="form-control" name="nop_barat"></div></td>
            </tr>
            </tbody>
        </table>

        <p>
            Tanah tersebut dasar kepemilikannya berdasarkan  :
        </p>
        <p>
            <div class="form-group form-group-sm"><input class="form-control" name="keterangan"></div>
        </p>
        <p>
            Sejak Tanggal <input name="tanggal_tanah"> Dari Nama <input name="pemilik_tanah">
        </p>
        <p>
            Tanah tersebut sampai saat ini belum dibuatkan Akta dan PPAT atau Sertifikat tanah dan tidak dalam kondisi sengketa atau ditanggungkan kepada pihak lain.
        </p>
        <p>
            Surat keterangan  ini dibuat untuk sebagai dasar mutasi / pecah NOP / pembetulan nama Wajib Pajak beserta luas tanah dan / atau bangunan.
        </p>
        <p>
            Demikian dari kami untuk dipergunakan dengan semestinya.
        </p>
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

            $('#step-2').find('input[name=nama]').val(data['nama']);
            $('#step-2').find('input[name=tempat_tanggal_lahir]').val(data['tempat_tanggal_lahir']);
            $('#step-2').find('input[name=jenis_kelamin]').val(data['jenis_kelamin']);
            $('#step-2').find('input[name=bangsa_agama]').val(data['warga_negara']+' / '+data['agama']);
            $('#step-2').find('input[name=pekerjaan]').val(data['pekerjaan']);
            $('#step-2').find('input[name=alamat]').val(data['alamat']);
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