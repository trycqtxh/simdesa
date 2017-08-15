<div class="modal" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Kegiatan Pembangunan</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-tambah-inventaris">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-sm">
                                <label for="nama" class="col-md-4 control-label">Nama Proyek</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="nama" id="nama" tabindex="1" autofocus>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="volume" class="col-md-4 control-label">Volume</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="volume" id="volume" tabindex="2">
                                </div>
                            </div>
                             <div class="form-group form-group-sm">
                                <label for="pemerintah" class="col-md-4 control-label">Pemerintah</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="pemerintah" id="pemerintah" tabindex="3">
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="provinsi" class="col-md-4 control-label">Provinsi</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="provinsi" id="provinsi" tabindex="4">
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="kabkota" class="col-md-4 control-label">Kab / Kota</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="kabkota" id="kabkota" tabindex="5">
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="swadaya" class="col-md-4 control-label">Swadaya</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="swadaya" id="swadaya" tabindex="6">
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group form-group-sm">
                                <label for="jiji" class="col-md-4 control-label">Jiji</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="jiji" id="jiji" tabindex="7">
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="waktu" class="col-md-4 control-label">Waktu</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="waktu" id="waktu" tabindex="8">
                                </div>
                            </div>
                             <div class="form-group form-group-sm">
                                <label for="sifat" class="col-md-4 control-label">Sifat Proyek</label>
                                <div class="col-md-8">
                                    <select class="form-control selectpicker show-tick" name="sifat" id="sifat" tabindex="9">
                                        <option value="">Pilih</option>
                                        <option value="BARU">BARU</option>
                                        <option value="LANJUTAN">LANJUTAN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="pelaksana" class="col-md-4 control-label">Pelaksana</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="pelaksana" id="pelaksana" tabindex="10">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="form-group form-group-sm"  style="margin-bottom: 0px">
                                    <label for="keterangan" class="control-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="11"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" tabindex="12">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>