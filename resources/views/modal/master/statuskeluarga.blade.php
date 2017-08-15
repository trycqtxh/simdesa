<div class="modal" id="modal-tambah"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Status Keluarga</h4>
            </div>
            <form role="form" class="form-horizontal" id="form-tambah">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="kode" class="col-md-4 control-label">Kode</label>
                        <div class="col-md-8">
                            <input class="form-control" name="kode" id="kode">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="status" class="col-md-4 control-label">Status Keluarga</label>
                        <div class="col-md-8">
                            <input class="form-control" name="status" id="status">
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

<div class="modal" id="modal-ubah"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Data  Status Keluarga</h4>
            </div>
            <form role="form" class="form-horizontal" id="form-ubah">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="kode" class="col-md-4 control-label">Kode</label>
                        <div class="col-md-8">
                            <input class="form-control" name="kode" id="kode">
                            <input type="hidden" name="id" id="id">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="status" class="col-md-4 control-label">Status Keluarga</label>
                        <div class="col-md-8">
                            <input class="form-control" name="status" id="status">
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