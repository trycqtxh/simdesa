<div class="modal" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data inventaris</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-tambah-inventaris">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-sm">
                                <label for="hasil" class="col-md-4 control-label">Hasil Pembangunan</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="hasil" id="hasil" tabindex="1" autofocus>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="volume" class="col-md-4 control-label">Volume</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="volume" id="volume" tabindex="2">
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group form-group-sm">
                                <label for="biaya" class="col-md-4 control-label">Biaya</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="biaya" id="biaya" tabindex="3">
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="lokasi" class="col-md-4 control-label">Lokasi</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="lokasi" id="lokasi" tabindex="4">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="form-group form-group-sm"  style="margin-bottom: 0px">
                                    <label for="keterangan" class="control-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" tabindex="6">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>