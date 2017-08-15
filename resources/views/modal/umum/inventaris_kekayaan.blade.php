<div class="modal" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data inventaris dan Kekayaan Desa</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-tambah-inventaris">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-sm">
                                <label for="jenis_barang" class="col-md-4 control-label">Jenis Barang dan Bangunan</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="jenis_barang" id="jenis_barang" tabindex="1" autofocus>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="asal_barang" class="col-md-4 control-label">Asal Barang dan Bangunan</label>
                                <div class="col-md-8">
                                    <select class="form-control selectpicker show-tick" name="asal_barang" id="asal_barang" tabindex="2">
                                        <option value="">Pilih</option>
                                        <option value="dibeli">Dibeli Sendiri</option>
                                        <option value="pemerintah">Pemerintah</option>
                                        <option value="provinsi">Provinsi</option>
                                        <option value="kabkota">Kab/Kota</option>
                                        <option value="sumbangan">Sumbangan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="keadaan_awal" class="col-md-4 control-label">Keadaan Barang dan Bangunan Awal Tahun</label>
                                <div class="col-md-8">
                                    <select class="form-control selectpicker show-tick" name="keadaan_awal" id="keadaan_awal" tabindex="3">
                                        <option value="">Pilih</option>
                                        <option value="baik">Baik</option>
                                        <option value="rusak">Rusak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-group form-group-sm">
                                <label for="penghapusan_barang" class="col-md-4 control-label">Penghapusan Barang dan Bangunan</label>
                                <div class="col-md-8">
                                    <select class="form-control selectpicker show-tick" name="penghapusan_barang" id="penghapusan_barang" tabindex="4">
                                        <option value="">Pilih</option>
                                        <option value="rusak">Rusak</option>
                                        <option value="dijual">Dijual</option>
                                        <option value="disumbangkan">Disumbangkan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="tanggal_penghapusan" class="col-md-4 control-label">Tanggal Penghapusan</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input class="form-control" name="tanggal_penghapusan" id="tanggal_penghapusan" tabindex="5" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="keadaan_akhir" class="col-md-4 control-label">Keadaan barang Akhir Tahun</label>
                                <div class="col-md-8">
                                    <select class="form-control selectpicker show-tick" name="keadaan_akhir" id="keadaan_akhir" tabindex="6">
                                        <option value="">Pilih</option>
                                        <option value="baik">Baik</option>
                                        <option value="rusak">Rusak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="form-group form-group-sm"  style="margin-bottom: 0px">
                                    <label for="keterangan" class="control-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="7"></textarea>
                                </div>
                            </div>
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