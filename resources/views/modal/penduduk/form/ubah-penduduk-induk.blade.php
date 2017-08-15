<?php
$penduduk = App\Entities\Penduduk::findOrFail($id)->first();
$induk = App\Entities\PendudukInduk::where('penduduk_id', $id)->first();
?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group form-group-sm">
            <label for="nik" class="col-md-4 control-label">NIK</label>
            <div class="col-md-8">
                <input class="form-control" name="nik" id="nik" value="{{ $induk->nik }}">
                <input type="hidden" name="id" id="id" value="{{$penduduk->id}}">
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="nomor_kk" class="col-md-4 control-label">No Katu Keluarga</label>
            <div class="col-md-8">
                {{--<input class="form-control" name="nomor_kk" id="nomor_kk" value="{{ $induk->nomor_kk }}">--}}
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari" readonly name="nomor_kk" id="nomor_kk" value="{{ $induk->nomor_kk }}">
                      <span class="input-group-btn">
                        <button class="btn btn-default btn-sm" type="button" id="cari-kk"><i class="fa fa-search-plus"></i> </button>
                      </span>
                </div><!-- /input-group -->
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="nama" class="col-md-4 control-label">Nama Lengkap</label>
            <div class="col-md-8">
                <input class="form-control" name="nama" id="nama" value="{{ $penduduk->nama }}">
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="jenis_kelamin  selectpicker show-tick" class="col-md-4 control-label">Jenis Kelamin</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="jenis_kelamin" id="jenis_kelamin">
                    <option value="">Pilih</option>
                    <option value="L" {{ ($penduduk->jenis_kelamin == 'L') ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="P" {{ ($penduduk->jenis_kelamin == 'P') ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="tempat_lahir" class="col-md-4 control-label">Tempat Lahir</label>
            <div class="col-md-8">
                <input class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ $penduduk->tempat_lahir }}">
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="tanggal_lahir" class="col-md-4 control-label">Tanggal Lahir</label>
            <div class="col-md-8">
                <div class="input-group">
                    <input class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ $penduduk->tanggal_lahir }}" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="agama" class="col-md-4 control-label">Agama</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="agama" id="agama">
                    <option value="">Pilih</option>
                    <option {{ ($induk->agama == 'ISLAM') ? 'selected'  : ''}} value="ISLAM">ISLAM</option>
                    <option {{ ($induk->agama == 'KRISTEN PROTESTAN') ? 'selected' : '' }} value="KRISTEN PROTESTAN">KRISTEN PROTESTAN</option>
                    <option {{ ($induk->agama == 'KRISTEN KATOLIK') ? 'selected' : '' }} value="KRISTEN KATOLIK">KRISTEN KATOLIK</option>
                    <option {{ ($induk->agama == 'HINDU') ? 'selected' : '' }} value="HINDU">HINDU</option>
                    <option {{ ($induk->agama == 'BUDDHA') ? 'selected' : '' }} value="BUDDHA">BUDDHA</option>
                    <option {{ ($induk->agama == 'KONGHUCU') ? 'selected' : '' }} value="KONGHUCU">KONGHUCU</option>
                </select>
            </div>
        </div>
        @php( $ayah = App\Entities\PendudukInduk::whereHas('penduduk', function($q){
                $q->where('jenis_kelamin', 'L');
            })->get() )
        <div class="form-group form-group-sm">
            <label for="ayah" class="col-md-4 control-label">Ayah</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="ayah" id="ayah" data-live-search="true">
                    <option value="">Pilih</option>
                    @foreach($ayah as $a)
                        <option value="{{ $a->nik }}" {{ ($induk->nik_ayah == $a->nik) ? 'selected' : '' }}>{{ $a->penduduk->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="ayah_input" class="col-md-4 control-label">Ayah</label>
            <div class="col-md-8">
                <input class="form-control" name="ayah_input" id="ayah_input" value="{{ $induk->ayah }}">
            </div>
        </div>
        @php( $ibu = App\Entities\PendudukInduk::whereHas('penduduk', function($q){
                $q->where('jenis_kelamin', 'P');
            })->get() )
        <div class="form-group form-group-sm">
            <label for="ibu" class="col-md-4 control-label">Ibu</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="ibu" id="ibu" data-live-search="true">
                    <option value="">Pilih</option>
                    @foreach($ibu as $a)
                        <option value="{{ $a->nik }}" {{ ($induk->nik_ibu == $a->nik) ? 'selected' : '' }}>{{ $a->penduduk->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="ibu_input" class="col-md-4 control-label">Ibu</label>
            <div class="col-md-8">
                <input class="form-control" name="ibu_input" id="ibu_input" value="{{ $induk->ibu }}">
            </div>
        </div>
        <div class="form-group form-group-sm"  style="margin-bottom: 0px">
            <label for="keterangan" class="col-md-4 control-label">Keterangan</label>
            <div class="col-md-8">
                <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="15">{{ $induk->keterangan }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group form-group-sm">
            <label for="status_perkawinan" class="col-md-4 control-label">Status Perkawinan</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="status_perkawinan" id="status_perkawinan">
                    <option value="">Pilih Status Pernikahan</option>
                    <option {{ ($induk->status_perkawinan == 'BK') ? 'selected' : '' }} value="BK">Belum Kawin</option>
                    <option {{ ($induk->status_perkawinan == 'K') ? 'selected' : '' }} value="K">Kawin</option>
                    <option {{ ($induk->status_perkawinan == 'JD') ? 'selected' : '' }} value="JD">Janda</option>
                    <option {{ ($induk->status_perkawinan == 'DD') ? 'selected' : '' }} value="DD">Duda</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="status_keluarga" class="col-md-4 control-label">Kedudukan Dalam Keluarga</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="status_keluarga" id="status_keluarga">
                    @php( $status = App\Entities\StatusKeluarga::all() )
                    <option value="">Pilih</option>
                    @foreach($status as $s)
                        <option value="{{ $s->id }}" {{ ($induk->status_keluarga_id == $s->id) ? 'selected' : '' }}>{{ $s->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="kewarga_negaraan" class="col-md-4 control-label">Kewarganegaraan</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="kewarga_negaraan" id="kewarga_negaraan">
                    <option value="">Pilih</option>
                    <option value="WNI" {{ ($penduduk->kewarga_negaraan == 'WNI' ) ? 'selected' : '' }}>Warga Negara Indonesia</option>
                    <option value="WNA" {{ ($penduduk->kewarga_negaraan == 'WNA' ) ? 'selected' : '' }}>Warga Negara Asing</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="pendidikan" class="col-md-4 control-label">Pendidikan Terakhir</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="pendidikan" id="pendidikan">
                    <option value="">Pilih</option>
                    <option {{ ($induk->pendidikan == 'Tidak/Belum Sekolah')? 'selected'  : ''}} value="Tidak/Belum Sekolah">Tidak/Belum Sekolah</option>
                    <option {{ ($induk->pendidikan == 'SD')? 'selected'  : ''}} value="SD">SD</option>
                    <option {{ ($induk->pendidikan == 'SMP')? 'selected' : '' }} value="SMP">SMP</option>
                    <option {{ ($induk->pendidikan == 'SMA')? 'selected' : '' }} value="SMA">SMA</option>
                    <option {{ ($induk->pendidikan == 'DIPLOMA I (D1)')? 'selected' : '' }} value="DIPLOMA I (D1)">DIPLOMA I (D1)</option>
                    <option {{ ($induk->pendidikan == 'DIPLOMA II (D2)')? 'selected' : '' }} value="DIPLOMA II (D2)">DIPLOMA II (D2)</option>
                    <option {{ ($induk->pendidikan == 'DIPLOMA III (D3)')? 'selected' : '' }} value="DIPLOMA III (D3)">DIPLOMA III (D3)</option>
                    <option {{ ($induk->pendidikan == 'STRATA I (S1)')? 'selected' : '' }} value="STRATA I (S1)">STRATA I (S1)</option>
                    <option {{ ($induk->pendidikan == 'STRATA II (S2)')? 'selected' : '' }} value="STRATA II (S2)">STRATA II (S2)</option>
                    <option {{ ($induk->pendidikan == 'STRATA III (S3)')? 'selected' : '' }} value="STRATA III (S3)">STRATA III (S3)</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="pekerjaan" class="col-md-4 control-label">Pekerjaan</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="pekerjaan" id="pekerjaan">
                    @php($pekerjaan = \App\Entities\Pekerjaan::all())
                    <option value="">Pilih</option>
                    @foreach($pekerjaan as $p)
                        <option value="{{ $p->id }}" {{ ($induk->pekerjaan_id == $p->id) ? 'selected' : '' }}>{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="membaca" class="col-md-4 control-label">Dapat Membaca Huruf</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="membaca" id="membaca">
                    <option value="">Pilih</option>
                    <option {{ ($induk->membaca == 'L') ? 'selected' : '' }} value="L">Latin</option>
                    <option {{ ($induk->membaca == 'D') ? 'selected' : '' }} value="D">Daerah</option>
                    <option {{ ($induk->membaca == 'A') ? 'selected' : '' }} value="A">Arab</option>
                    <option {{ ($induk->membaca == 'AL') ? 'selected' : '' }} value="AL">Arab & Latin</option>
                    <option {{ ($induk->membaca == 'AD') ? 'selected' : '' }} value="AD">Arab & Daerah</option>
                    <option {{ ($induk->membaca == 'ALD') ? 'selected' : '' }} value="ALD">Arab, Latin & Daerah</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="golongan_darah" class="col-md-4 control-label">Golongan Darah</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="golongan_darah" id="golongan_darah">
                    <option value="">Pilih</option>
                    <option {{ ($induk->golongan_darah == 'A') ? 'selected' : '' }} value="A">A</option>
                    <option {{ ($induk->golongan_darah == 'B') ? 'selected' : '' }} value="B">B</option>
                    <option {{ ($induk->golongan_darah == 'AB') ? 'selected' : '' }} value="AB">AB</option>
                    <option {{ ($induk->golongan_darah == 'O') ? 'selected'  : ''}} value="O">O</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="dusun" class="col-md-4 control-label">Dusun</label>
            <div class="col-md-8">
                <input class="form-control" name="dusun" id="dusun" value="{{ $induk->dusun }}">
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="rw" class="col-md-4 control-label">RW</label>
            <div class="col-md-8">
                <select class="form-control  selectpicker show-tick" name="rw" id="rw">
                    <option value="">Pilih</option>
                    @php($rw = App\Entities\RW::all() )
                    @foreach($rw as $r)
                        <option value="{{ $r->id }}" {{ ($induk->rw_id == $r->id) ? 'selected' : '' }}>{{ $r->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="rt" class="col-md-4 control-label">RT</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="rt" id="rt">
                    <option value="">Pilih</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm"  style="margin-bottom: 0px">
            <label for="alamat" class="col-md-4 control-label">Alamat</label>
            <div class="col-md-8">
                <textarea class="form-control" name="alamat" id="alamat" style="resize: none" rows="4" tabindex="15">{{ $induk->alamat }}</textarea>
            </div>
        </div>
    </div>
</div>

<script>
    $('select[name=jenis_kelamin]').selectpicker();
    $('select[name=agama]').selectpicker();
    $('select[name=ayah]').selectpicker();
    $('select[name=ibu]').selectpicker();
    $('select[name=status_perkawinan]').selectpicker();
    $('select[name=status_keluarga]').selectpicker();
    $('select[name=kewarga_negaraan]').selectpicker();
    $('select[name=pendidikan]').selectpicker();
    $('select[name=pekerjaan]').selectpicker();
    $('select[name=membaca]').selectpicker();
    $('select[name=golongan_darah]').selectpicker();
    $('select[name=rt]').selectpicker();
    $('select[name=rw]').selectpicker();
    $('input[name=nik]').inputmask({alias: "nik"});
    $('input[name=nomor_kk]').inputmask({alias: "nik"});

        $(function(){
            var select = $.ajax({
                type : "GET",
                url : "{{ route('rt.cari.select', $induk->rw_id) }}",
                dataType : "json",
                global : false,
            });
            select.done(function(data) {
                var dt = [];
                $.each(data, function (key, val) {
                    dt[key] = val;
                });
                var opt_list = [["", "Pilih"]].concat(dt);
                formUbahInduk.find("select[name='rt']").empty();
                for (var i = 0; i < opt_list.length; i++) {
                    formUbahInduk.find("select[name='rt']").append($("<option></option>").attr('value', opt_list[i][0]).text(opt_list[i][1]));
                }
                formUbahInduk.find("select[name=rt]").val("{{$induk->rt_id}}").selectpicker('refresh');
            });
            $('button#cari-kk').click(function(){
                $.ajax({
                    url: "{{ route('penduduk.induk.select-kk') }}"
                }).done(function(html){
                    $('#modal-select-kk').find('#load-html').html(html);
                    $('#modal-select-kk').modal('show');
                });
            });
        })
</script>