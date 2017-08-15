<div class="modal" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="tanggal_pengiriman" class="col-md-4 control-label">Tanggal Pengirim</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_pengiriman" id="tanggal_pengiriman" tabindex="3" readonly >
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="nomor_surat" class="col-md-4 control-label">Nomor Surat</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nomor_surat" id="nomor_surat" tabindex="1" autofocus>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_surat" class="col-md-4 control-label">Tanggal Surat</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_surat" id="tanggal_surat" tabindex="2" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="pengirim" class="col-md-4 control-label">Di Tujukan Kepada</label>
                        <div class="col-md-8">
                            <input class="form-control" name="pengirim" id="pengirim" tabindex="4">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="isi_surat" class="col-md-4 control-label">Isi Surat </label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="isi_surat" id="isi_surat" style="resize: none" rows="" tabindex="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="keterangan" class="col-md-4 control-label">Keterangan</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="6"></textarea>
                            <input type="hidden" name="jenis_surat" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" tabindex="7">Simpan</button>
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
                <h4 class="modal-title"></h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="tanggal_pengiriman" class="col-md-4 control-label">Tanggal Pengirim</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_pengiriman" id="tanggal_pengiriman" tabindex="3" readonly >
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="nomor_surat" class="col-md-4 control-label">Nomor Surat</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nomor_surat" id="nomor_surat" tabindex="1" autofocus>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_surat" class="col-md-4 control-label">Tanggal Surat</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_surat" id="tanggal_surat" tabindex="2" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="pengirim" class="col-md-4 control-label">Di Tujukan Kepada</label>
                        <div class="col-md-8">
                            <input class="form-control" name="pengirim" id="pengirim" tabindex="4">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="isi_surat" class="col-md-4 control-label">Isi Surat </label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="isi_surat" id="isi_surat" style="resize: none" rows="" tabindex="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="keterangan" class="col-md-4 control-label">Keterangan</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="6"></textarea>
                            <input type="hidden" name="jenis_surat">
                            <input type="hidden" name="id">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" tabindex="7">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>