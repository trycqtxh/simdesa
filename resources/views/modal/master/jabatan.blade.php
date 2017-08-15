<div class="modal" id="modal-tambah"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Jabatan</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="kode" class="col-md-4 control-label">Kode</label>
                        <div class="col-md-8">
                            <input class="form-control" name="kode" id="kode">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jabatan" class="col-md-4 control-label">Jabatan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="jabatan" id="jabatan">
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
            <form class="form-horizontal" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ubah Data Jabatan</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="kode" class="col-md-4 control-label">Kode</label>
                        <div class="col-md-8">
                            <input class="form-control" name="kode" id="kode">
                            <input type="hidden" name="id" id="id">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jabatan" class="col-md-4 control-label">Jabatan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="jabatan" id="jabatan">
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