{{-- MODAL TAMBAH SUBKEGIATAN --}}
<div  id="modal-tambah-sub-kegiatan" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Sub Kegiatan</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-tambah-sub-kegiatan">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="sub_kegiatan" class="col-md-4 control-label">Sub Kegiatan</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" id="sub_kegiatan" name="sub_kegiatan">
                                <option value="">Pilih</option>
                                @php( $sub_bidang = App\Entities\KegiatanKerja::where('jenis', 'level_2')->where('rpjm_id', $rpjm->id)->get() )
                                @foreach( $sub_bidang as $sb)
                                    <option value="{{ $sb->id }}">{{ $sb->uraian }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="kegiatan" class="col-md-4 control-label">Kegiatan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="kegiatan" id="kegiatan">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="lokasi" class="col-md-4 control-label">Lokasi</label>
                        <div class="col-md-8">
                            <input class="form-control" name="lokasi" id="lokasi">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="volume" class="col-md-4 control-label">Volume</label>
                        <div class="col-md-8">
                            <input class="form-control" name="volume" id="volume">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="manfaat" class="col-md-4 control-label">Sasaran / Manfaat</label>
                        <div class="col-md-8">
                            <input class="form-control" name="manfaat" id="manfaat">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jumlah" class="col-md-4 control-label">jumlah (Rp)</label>
                        <div class="col-md-8">
                            <input class="form-control" name="jumlah" id="jumlah">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="sumber_dana" class="col-md-4 control-label">Sumber Dana</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" name="sumber_dana" id="sumber_dana">
                                <option value="">Pilih</option>
                                @php( $sumber_dana = App\Entities\SumberDana::all() )
                                @foreach($sumber_dana as $s)
                                    <option value="{{ $s->id }}"> {{ $s->nama }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="pola_pelaksanaan" class="col-md-4 control-label">Pola Pelaksanaan</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" id="pola_pelaksanaan" name="pola_pelaksanaan">
                                <option value="">Pilih</option>
                                <option value="SWAKELOLA">SWAKELOLA</option>
                                <option value="KERJASAMA ANTAR DESA">KERJASAMA ANTAR DESA</option>
                                <option value="KERJASAMA PIHAK 3">KERJASAMA PIHAK 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{-- MODAL TAMBAH SUBKEGIATAN --}}
<div  id="modal-ubah-sub-kegiatan" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Sub Kegiatan </h4>
            </div>
            <form class="form-horizontal" role="form" id="form-ubah-sub-kegiatan">
                <input type="hidden" name="id">
                <div class="modal-body">
                    {{--<div class="form-group form-group-sm">--}}
                        {{--<label for="sub_kegiatan" class="col-md-4 control-label">Sub Kegiatan</label>--}}
                        {{--<div class="col-md-8">--}}
                            {{--<select class="form-control selectpicker show-tick" id="sub_kegiatan" name="sub_kegiatan">--}}
                                {{--<option value="">Pilih</option>--}}
                                {{--@php( $sub_bidang = App\Entities\KegiatanKerja::where('jenis', 'level_2')->get() )--}}
                                {{--@foreach( $sub_bidang as $sb)--}}
                                    {{--<option value="{{ $sb->id }}">{{ $sb->uraian }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group form-group-sm">
                        <label for="kegiatan" class="col-md-4 control-label">Kegiatan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="kegiatan" id="kegiatan">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="lokasi" class="col-md-4 control-label">Lokasi</label>
                        <div class="col-md-8">
                            <input class="form-control" name="lokasi" id="lokasi">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="volume" class="col-md-4 control-label">Volume</label>
                        <div class="col-md-8">
                            <input class="form-control" name="volume" id="volume">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="manfaat" class="col-md-4 control-label">Sasaran / Manfaat</label>
                        <div class="col-md-8">
                            <input class="form-control" name="manfaat" id="manfaat">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jumlah" class="col-md-4 control-label">jumlah (Rp)</label>
                        <div class="col-md-8">
                            <input class="form-control" name="jumlah" id="jumlah">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="sumber_dana" class="col-md-4 control-label">Sumber Dana</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" name="sumber_dana" id="sumber_dana">
                                <option value="">Pilih</option>
                                @php( $sumber_dana = App\Entities\SumberDana::all() )
                                @foreach($sumber_dana as $s)
                                    <option value="{{ $s->id }}"> {{ $s->nama }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="pola_pelaksanaan" class="col-md-4 control-label">Pola Pelaksanaan</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" id="pola_pelaksanaan" name="pola_pelaksanaan">
                                <option value="">Pilih</option>
                                <option value="SWAKELOLA">SWAKELOLA</option>
                                <option value="KERJASAMA ANTAR DESA">KERJASAMA ANTAR DESA</option>
                                <option value="KERJASAMA PIHAK 3">KERJASAMA PIHAK 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{-- MODAL TAMBAH SUBKEGIATAN TABEL--}}
<div  id="modal-tambah-sub-kegiatan-tabel" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Sub Kegiatan </h4>
            </div>
            <form class="form-horizontal" role="form" id="form-ubah-sub-kegiatan">
                <div class="modal-body">
                    <input type="hidden" name="sub_kegiatan">
                    <div class="form-group form-group-sm">
                        <label for="kegiatan" class="col-md-4 control-label">Kegiatan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="kegiatan" id="kegiatan">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="lokasi" class="col-md-4 control-label">Lokasi</label>
                        <div class="col-md-8">
                            <input class="form-control" name="lokasi" id="lokasi">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="volume" class="col-md-4 control-label">Volume</label>
                        <div class="col-md-8">
                            <input class="form-control" name="volume" id="volume">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="manfaat" class="col-md-4 control-label">Sasaran / Manfaat</label>
                        <div class="col-md-8">
                            <input class="form-control" name="manfaat" id="manfaat">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jumlah" class="col-md-4 control-label">jumlah (Rp)</label>
                        <div class="col-md-8">
                            <input class="form-control" name="jumlah" id="jumlah">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="sumber_dana" class="col-md-4 control-label">Sumber Dana</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" name="sumber_dana" id="sumber_dana">
                                <option value="">Pilih</option>
                                @php( $sumber_dana = App\Entities\SumberDana::all() )
                                @foreach($sumber_dana as $s)
                                    <option value="{{ $s->id }}"> {{ $s->nama }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="pola_pelaksanaan" class="col-md-4 control-label">Pola Pelaksanaan</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" id="pola_pelaksanaan" name="pola_pelaksanaan">
                                <option value="">Pilih</option>
                                <option value="SWAKELOLA">SWAKELOLA</option>
                                <option value="KERJASAMA ANTAR DESA">KERJASAMA ANTAR DESA</option>
                                <option value="KERJASAMA PIHAK 3">KERJASAMA PIHAK 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>