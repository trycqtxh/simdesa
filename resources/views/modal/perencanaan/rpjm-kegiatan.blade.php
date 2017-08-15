{{-- MODAL TAMBAH KEGIATAN RPJM--}}
<div  id="modal-tambah-kegiatan" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Kegiatan</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-tambah-kegiatan">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="sub_kegiatan" class="col-md-4 control-label">Pilih Sub Kegiatan</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" id="sub_kegiatan" name="sub_kegiatan">
                                <option value="">Pilih</option>
                                @php( $sub_bidang = App\Entities\KegiatanKerja::where('jenis', 'level_1')->where('rpjm_id', $rpjm->id)->get() )
                                @foreach( $sub_bidang as $sb)
                                    <option value="{{ $sb->id }}">{{ $sb->uraian }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jenis_kegiatan" class="col-md-4 control-label">Jenis Kegiatan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="jenis_kegiatan" id="jenis_kegiatan">
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

{{-- MODAL UBAH KEGIATAN RPJM--}}
<div  id="modal-ubah-kegiatan" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Kegiatan</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-ubah-kegiatan">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="sub_kegiatan" class="col-md-4 control-label">Pilih Sub Kegiatan</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" id="sub_kegiatan" name="sub_kegiatan">
                                <option value="">Pilih</option>
                                @php( $sub_bidang = App\Entities\KegiatanKerja::where('jenis', 'level_1')->get() )
                                @foreach( $sub_bidang as $sb)
                                    <option value="{{ $sb->id }}">{{ $sb->uraian }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jenis_kegiatan" class="col-md-4 control-label">Jenis Kegiatan</label>
                        <div class="col-md-8">
                            {{--<input class="form-control" name="jenis_kegiatan" id="jenis_kegiatan">--}}
                            <select class="form-control" name="jenis_kegiatan" id="jenis_kegiatan">
                                <option value="">Pilih</option>
                                <option value="Belanja Pegawai">Belanja Pegawai</option>
                                <option value="Belanja Barang dan Jasa">Belanja Barang dan Jasa</option>
                                <option value="Belanja Modal">Belanja Modal</option>
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

{{-- MODAL TAMBAH KEGIATAN TABLE--}}
<div  id="modal-tambah-kegiatan-tabel" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Kegiatan</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-ubah-kegiatan">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="jenis_kegiatan" class="col-md-4 control-label">Jenis Kegiatan</label>
                        <div class="col-md-8">
                            {{--<input class="form-control" name="jenis_kegiatan" id="jenis_kegiatan">--}}
                            <select class="form-control" name="jenis_kegiatan" id="jenis_kegiatan">
                                <option value="">Pilih</option>
                                <option value="Belanja Pegawai">Belanja Pegawai</option>
                                <option value="Belanja Barang dan Jasa">Belanja Barang dan Jasa</option>
                                <option value="Belanja Modal">Belanja Modal</option>
                            </select>
                            <input type="hidden" name="sub_kegiatan" id="sub_kegiatan">
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

{{-- VIEW MODAL KEGIATAN--}}
<div id="modal-view-kegiatan" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">KEGIATAN</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>URAIAN</th>
                        <th>VOLUME</th>
                        <th>SATUAN</th>
                        <th>HARGA SATUAN (Rp.)</th>
                        <th>JUMLAH TOTAL (Rp.)</th>
                        <th>JUMLAH</th>
                    </tr>
                    <tr>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>