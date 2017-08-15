<div class="modal" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Peraturan di Desa</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="nomor_ditetapkan" class="col-md-4 control-label">Nomor Ditetapkan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nomor_ditetapkan" id="nomor_ditetapkan" autofocus>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_ditetapkan" class="col-md-4 control-label">Tanggal Ditetapkan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_ditetapkan" id="tanggal_ditetapkan" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tentang" class="col-md-4 control-label">Tentang</label>
                        <div class="col-md-8">
                            <input class="form-control" name="tentang" id="tentang">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="uraian_singkat" class=" col-md-4 control-label">Uraian singkat</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="uraian_singkat" id="uraian_singkat" style="resize: none" rows=""></textarea>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_peraturan" class="col-md-4 control-label">Tanggal Peraturan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_peraturan" id="tanggal_peraturan" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="no_kesepakatan" class="col-md-4 control-label">No Kesepakatan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="no_kesepakatan" id="no_kesepakatan" >
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="nomor_dilaporkan" class="col-md-4 control-label">Nomor Dilaporkan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nomor_dilaporkan" id="nomor_dilaporkan" >
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_dilaporkan" class="col-md-4 control-label">Tanggal Dilaporkan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_dilaporkan" id="tanggal_dilaporkan" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="keterangan" class=" col-md-4 control-label">Keterangan</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" tabindex="14">Simpan</button>
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
                <h4 class="modal-title">Ubah Data Peraturan di Desa</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="nomor_ditetapkan" class="col-md-4 control-label">Nomor Ditetapkan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nomor_ditetapkan" id="nomor_ditetapkan" autofocus>
                            <input type="hidden" name="id">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_ditetapkan" class="col-md-4 control-label">Tanggal Ditetapkan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_ditetapkan" id="tanggal_ditetapkan" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tentang" class="col-md-4 control-label">Tentang</label>
                        <div class="col-md-8">
                            <input class="form-control" name="tentang" id="tentang">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="uraian_singkat" class=" col-md-4 control-label">Uraian singkat</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="uraian_singkat" id="uraian_singkat" style="resize: none" rows=""></textarea>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_peraturan" class="col-md-4 control-label">Tanggal Peraturan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_peraturan" id="tanggal_peraturan" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="no_kesepakatan" class="col-md-4 control-label">No Kesepakatan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="no_kesepakatan" id="no_kesepakatan" >
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="nomor_dilaporkan" class="col-md-4 control-label">Nomor Dilaporkan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nomor_dilaporkan" id="nomor_dilaporkan" >
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_dilaporkan" class="col-md-4 control-label">Tanggal Dilaporkan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_dilaporkan" id="tanggal_dilaporkan" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="keterangan" class=" col-md-4 control-label">Keterangan</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" tabindex="14">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>