<div class="modal" id="modal-tambah"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data RW</h4>
            </div>
            <form role="form" class="form-horizontal" id="form-tambah">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="rw" class="col-md-4 control-label">RW</label>
                        <div class="col-md-8">
                            <input class="form-control" name="rw" id="rw" oninput="this.value=this.value.replace(/[^0-9]/g,'');" >
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="petugas" class="col-md-4 control-label">Petugas RW</label>
                        <div class="col-md-8">
                            <input class="form-control" name="petugas" id="petugas">
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
                <h4 class="modal-title">Ubah Data RW</h4>
            </div>
            <form role="form" class="form-horizontal" id="form-ubah">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="rw" class="col-md-4 control-label">RW</label>
                        <div class="col-md-8">
                            <input class="form-control" name="rw" id="rw" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                            <input type="hidden" name="id" id="id">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="petugas" class="col-md-4 control-label">Petugas RW</label>
                        <div class="col-md-8">
                            <input class="form-control" name="petugas" id="petugas">
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