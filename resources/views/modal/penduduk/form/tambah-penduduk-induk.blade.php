<div class="row">
    <div class="col-md-6">
        <div class="form-group form-group-sm">
            <label for="nik" class="col-md-4 control-label">NIK</label>
            <div class="col-md-8">
                <input class="form-control" name="nik" id="nik" >
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="nomor_kk" class="col-md-4 control-label">No Katu Keluarga</label>
            <div class="col-md-8">
                {{--<input class="form-control" name="nomor_kk" id="nomor_kk" >--}}
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari" readonly name="nomor_kk" id="nomor_kk">
                      <span class="input-group-btn">
                        <button class="btn btn-default btn-sm" type="button" id="cari-kk"><i class="fa fa-search-plus"></i> </button>
                      </span>
                </div><!-- /input-group -->
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="nama" class="col-md-4 control-label">Nama Lengkap</label>
            <div class="col-md-8">
                <input class="form-control" name="nama" id="nama">
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="jenis_kelamin  selectpicker show-tick" class="col-md-4 control-label">Jenis Kelamin</label>
            <div class="col-md-8">
                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                    <option value="">Pilih</option>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="tempat_lahir" class="col-md-4 control-label">Tempat Lahir</label>
            <div class="col-md-8">
                <input class="form-control" name="tempat_lahir" id="tempat_lahir">
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="tanggal_lahir" class="col-md-4 control-label">Tanggal Lahir</label>
            <div class="col-md-8">
                <div class="input-group">
                    <input class="form-control" name="tanggal_lahir" id="tanggal_lahir" readonly>
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
                    <option value="ISLAM">ISLAM</option>
                    <option value="KRISTEN PROTESTAN">KRISTEN PROTESTAN</option>
                    <option value="KRISTEN KATOLIK">KRISTEN KATOLIK</option>
                    <option value="HINDU">HINDU</option>
                    <option value="BUDDHA">BUDDHA</option>
                    <option value="KONGHUCU">KONGHUCU</option>
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
                        <option value="{{ $a->nik }}">{{ $a->penduduk->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="ayah_input" class="col-md-4 control-label">Ayah</label>
            <div class="col-md-8">
                <input class="form-control" name="ayah_input" id="ayah_input">
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
                        <option value="{{ $a->nik }}">{{ $a->penduduk->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="ibu_input" class="col-md-4 control-label">Ibu</label>
            <div class="col-md-8">
                <input class="form-control" name="ibu_input" id="ibu_input">
            </div>
        </div>
        <div class="form-group form-group-sm"  style="margin-bottom: 0px">
            <label for="keterangan" class="col-md-4 control-label">Keterangan</label>
            <div class="col-md-8">
                <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="15"></textarea>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group form-group-sm">
            <label for="status_perkawinan" class="col-md-4 control-label">Status Perkawinan</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="status_perkawinan" id="status_perkawinan">
                    <option value="">Pilih Status Pernikahan</option>
                    <option value="BK">Belum Kawin</option>
                    <option value="K">Kawin</option>
                    <option value="JD">Janda</option>
                    <option value="DD">Duda</option>
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
                        <option value="{{ $s->id }}">{{ $s->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="kewarga_negaraan" class="col-md-4 control-label">Kewarganegaraan</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="kewarga_negaraan" id="kewarga_negaraan">
                    <option value="">Pilih</option>
                    <option value="WNI">Warga Negara Indonesia</option>
                    <option value="WNA">Warga Negara Asing</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="pendidikan" class="col-md-4 control-label">Pendidikan Terakhir</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="pendidikan" id="pendidikan">
                    <option value="">Pilih</option>
                    <option>Tidak/Belum Sekolah</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="DIPLOMA I (D1)">DIPLOMA I (D1)</option>
                    <option value="DIPLOMA II (D2)">DIPLOMA II (D2)</option>
                    <option value="DIPLOMA III (D3)">DIPLOMA III (D3)</option>
                    <option value="STRATA I (S1)">STRATA I (S1)</option>
                    <option value="STRATA II (S2)">STRATA II (S2)</option>
                    <option value="STRATA III (S3)">STRATA III (S3)</option>
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
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="membaca" class="col-md-4 control-label">Dapat Membaca Huruf</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="membaca" id="membaca">
                    <option value="">Pilih</option>
                    <option value="L">Latin</option>
                    <option value="D">Daerah</option>
                    <option value="A">Arab</option>
                    <option value="AL">Arab & Latin</option>
                    <option value="AD">Arab & Daerah</option>
                    <option value="ALD">Arab, Latin & Daerah</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="golongan_darah" class="col-md-4 control-label">Golongan Darah</label>
            <div class="col-md-8">
                <select class="form-control selectpicker show-tick" name="golongan_darah" id="golongan_darah">
                    <option value="">Pilih</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="dusun" class="col-md-4 control-label">Dusun</label>
            <div class="col-md-8">
                <input class="form-control" name="dusun" id="dusun">
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="rw" class="col-md-4 control-label">RW</label>
            <div class="col-md-8">
                <select class="form-control  selectpicker show-tick" name="rw" id="rw">
                    <option value="">Pilih</option>
                    @php($rw = App\Entities\RW::all() )
                    @foreach($rw as $r)
                        <option value="{{ $r->id }}">{{ $r->nama }}</option>
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
                <textarea class="form-control" name="alamat" id="alamat" style="resize: none" rows="4" tabindex="15"></textarea>
            </div>
        </div>
    </div>
</div>
{{--{{ Html::script('assets/plugins/jQuery/jquery-2.2.3.min.js') }}--}}
{{--{{ Html::script('assets/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js') }}--}}
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