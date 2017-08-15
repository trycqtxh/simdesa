<div class="modal" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Keputusan Kepala Desa</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="nomor_keputusan" class="col-md-4 control-label">Nomor Keputusan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nomor_keputusan" id="nomor_keputusan" tabindex="1" autofocus>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_keputusan" class="col-md-4 control-label">Tanggal Keputusan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_keputusan" id="tanggal_keputusan" tabindex="2" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tentang" class="col-md-4 control-label">Tentang</label>
                        <div class="col-md-8">
                            <input class="form-control" name="tentang" id="tentang" tabindex="3">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="uraian_singkat" class="col-md-4 control-label">Uraian Singkat</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="uraian_singkat" id="uraian_singkat" style="resize: none" rows="" tabindex="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="nomor_dilaporkan" class="col-md-4 control-label">Nomor Dilaporkan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nomor_dilaporkan" id="nomor_dilaporkan" tabindex="5">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_dilaporkan" class="col-md-4 control-label">Tanggal Dilaporkan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_dilaporkan" id="tanggal_dilaporkan" tabindex="6" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="keterangan" class="col-md-4 control-label">Keterangan</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="7"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" tabindex="8">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-ubah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Data Keputusan Kepala Desa</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="nomor_keputusan" class="col-md-4 control-label">Nomor Keputusan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nomor_keputusan" id="nomor_keputusan" tabindex="1" autofocus>
                            <input name="id" type="hidden">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_keputusan" class="col-md-4 control-label">Tanggal Keputusan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_keputusan" id="tanggal_keputusan" tabindex="2" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tentang" class="col-md-4 control-label">Tentang</label>
                        <div class="col-md-8">
                            <input class="form-control" name="tentang" id="tentang" tabindex="3">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="uraian_singkat" class="col-md-4 control-label">Uraian Singkat</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="uraian_singkat" id="uraian_singkat" style="resize: none" rows="" tabindex="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="nomor_dilaporkan" class="col-md-4 control-label">Nomor Dilaporkan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nomor_dilaporkan" id="nomor_dilaporkan" tabindex="5">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_dilaporkan" class="col-md-4 control-label">Tanggal Dilaporkan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_dilaporkan" id="tanggal_dilaporkan" tabindex="6" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="keterangan" class="col-md-4 control-label">Keterangan</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="7"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" tabindex="8">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>