<div class="modal" id="modal-tambah-pembiayaan" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">FORM TAMBAH</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="uraian" class="col-md-2 control-label">Uraian</label>
                        <div class="col-md-10">
                            <input class="form-control" name="uraian" id="uraian">
                            <input type="hidden" name="bidang">
                            <input type="hidden" name="jenis">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="anggaran" class="col-md-2 control-label">Anggaran (Rp.)</label>
                        <div class="col-md-10">
                            <input class="form-control" name="anggaran" id="anggaran">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="keterangan" class="col-md-2 control-label">Keterangan</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="5"></textarea>
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

<div class="modal" id="modal-ubah-pembiayaan" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">FORM UBAH</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="uraian" class="col-md-2 control-label">Uraian</label>
                        <div class="col-md-10">
                            <input class="form-control" name="uraian" id="uraian">
                            <input type="hidden" name="bidang">
                            <input type="hidden" name="jenis">
                            <input type="hidden" name="id">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="anggaran" class="col-md-2 control-label">Anggaran</label>
                        <div class="col-md-10">
                            <input class="form-control" name="anggaran" id="anggaran">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="keterangan" class="col-md-2 control-label">Keterangan</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="5"></textarea>
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