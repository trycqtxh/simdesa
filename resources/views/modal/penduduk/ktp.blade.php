{{-- Tambah KK--}}
<div class="modal" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah KTP</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-tambah">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="nik" class="col-md-3 control-label">NIK</label>
                        <div class="col-md-9">
                            {{--<input class="form-control" name="nik" id="nik">--}}
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari" readonly name="nik" id="nik">
                                <span class="input-group-btn">
                                <button class="btn btn-default btn-sm" id="cari-nik" type="button"><i class="fa fa-search-plus"></i> </button>
                                </span>
                            </div><!-- /input-group -->
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tempat_dikeluarkan" class="col-md-3 control-label">Tempat Dikeluarkan</label>
                        <div class="col-md-9">
                            <input class="form-control" name="tempat_dikeluarkan" id="tempat_dikeluarkan">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_dikeluarkan" class="col-md-3 control-label">Tanggal Dikeluarkan</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_dikeluarkan" id="tanggal_dikeluarkan" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_mulai_didesa" class="col-md-3 control-label">Tanggal Mulai Didesa</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_mulai_didesa" id="tanggal_mulai_di_desa" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="keterangan" class="col-md-3 control-label">Keterangan</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Ubah KK--}}
<div class="modal" id="modal-ubah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah KTP</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-ubah">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="nik" class="col-md-3 control-label">NIK</label>
                        <div class="col-md-9">
                            <input class="form-control" name="nik" id="nik" readonly>
                            <input type="hidden" name="id" id="id">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tempat_dikeluarkan" class="col-md-3 control-label">Tempat Dikeluarkan</label>
                        <div class="col-md-9">
                            <input class="form-control" name="tempat_dikeluarkan" id="tempat_dikeluarkan">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_dikeluarkan" class="col-md-3 control-label">Tanggal Dikeluarkan</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_dikeluarkan" id="tanggal_dikeluarkan" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_mulai_didesa" class="col-md-3 control-label">Tanggal Mulai Didesa</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_mulai_didesa" id="tanggal_mulai_di_desa" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="keterangan" class="col-md-3 control-label">Keterangan</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Select KTP--}}
<div class="modal" id="modal-select-ktp" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Select KTP</h4>
            </div>
            <div class="modal-body" id="load-html">

            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- TAMBAH Ayah --}}
<div class="modal" id="modal-tambah-ayah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Ayah</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-tambah">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="nik" class="col-md-3 control-label">NIK</label>
                        <div class="col-md-9">
                            <input class="form-control" name="nik" id="nik" readonly>
                            <input class="form-control" name="id" id="id" type="hidden">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="nama" class="col-md-3 control-label">Nama</label>
                        <div class="col-md-9">
                            <input class="form-control" name="nama" id="nama" readonly>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="ayah" class="col-md-3 control-label">Nama Ayah yang Ada DiDesa</label>
                        <div class="col-md-9">
                            <select class="form-control selectpicker " data-live-search="true" name="ayah" id="ayah">
                                <option value="">Pilih</option>
                                @php( $ayah = App\Entities\PendudukInduk::whereHas('penduduk', function($q){
                                    $q->where('jenis_kelamin', 'L');
                                })->get() )
                                @foreach($ayah as $a)
                                    <option value="{{ $a->nik }}">{{ $a->penduduk->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="ayah_input" class="col-md-3 control-label">Ayah</label>
                        <div class="col-md-9">
                            <input class="form-control" name="ayah_input" id="ayah_input">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Tambah Ibu--}}
<div class="modal" id="modal-tambah-ibu" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Ibu</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-tambah">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="nik" class="col-md-3 control-label">NIK</label>
                        <div class="col-md-9">
                            <input class="form-control" name="nik" id="nik" readonly>
                            <input class="form-control" name="id" id="id" type="hidden">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="nama" class="col-md-3 control-label">Nama</label>
                        <div class="col-md-9">
                            <input class="form-control" name="nama" id="nama" readonly>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="ibu" class="col-md-3 control-label">Nama Ibu yang Ada Di Desa</label>
                        <div class="col-md-9">
                            <select class="form-control selectpicker " data-live-search="true" name="ibu" id="ibu">
                                <option value="">Pilih</option>
                                @php( $ibu = App\Entities\PendudukInduk::whereHas('penduduk', function($q){
                                    $q->where('jenis_kelamin', 'P');
                                })->get() )
                                @foreach($ibu as $a)
                                <option value="{{ $a->nik }}">{{ $a->penduduk->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="ibu_input" class="col-md-3 control-label">Ibu</label>
                        <div class="col-md-9">
                            <input class="form-control" name="ibu_input" id="ibu_input">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>