<div class="modal" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Tanah di Desa</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-tambah-inventaris">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="nama" class="col-md-4 control-label">Nama Perorang / Badan Hukum</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nama" id="nama" autofocus>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jumlah" class="col-md-4 control-label">Jumlah (M2)</label>
                        <div class="col-md-8">
                            <input class="form-control" name="jumlah" id="jumlah">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="status_tanah" class="col-md-4 control-label">Status Hak Tanah</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" name="status_tanah" id="status_tanah">
                                <option value="">Pilih</option>
                                <optgroup label="Sudah Bersertifikat">
                                    <option value="hm">Hak Milik</option>
                                    <option value="hgb">Hak Guna Bangunan</option>
                                    <option value="hp">Hak Pakai</option>
                                    <option value="hgu">Hak Guna Usaha</option>
                                    <option value="hpl">Hak Pengolahan</option>
                                </optgroup>
                                <optgroup label="Belum Bersertifikat">
                                    <option value="ma">Hak Milik Adat</option>
                                    <option value="vi">Hak Verponding Indonesia</option>
                                    <option value="tn">Tanah Negara</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_status_tanah" class="col-md-4 control-label">Luas Status Hak Tanah (M2)</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_status_tanah" id="luas_status_tanah">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="penggunaan_tanah" class="col-md-4 control-label">Penggunaan Tanah</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" name="penggunaan_tanah" id="penggunaan_tanah">
                                <option value="">Pilih</option>
                                <optgroup label="Non Pertanian">
                                    <option value="Perumahan">PERUMAHAN</option>
                                    <option value="Perdagangan dan Jasa">PERDAGANGAN DAN JASA</option>
                                    <option value="Perkantoran">PERKANTORAN</option>
                                    <option value="Industri">INDUSTRI</option>
                                    <option value="Fasilitas Umum">FASILITAS UMUM</option>
                                </optgroup>
                                <optgroup label="Pertanian">
                                    <option value="Sawah">SAWAH</option>
                                    <option value="Tegalan">TEGALAN</option>
                                    <option value="Kebun">PERKEBUNAN</option>
                                    <option value="Ternak / Tambak / Kolam">PETERNAKAN / PERIKANAN</option>
                                    <option value="Hutan Belukar">HUTAN BELUKAR</option>
                                    <option value="Hutan Lebat / Lindung">HUTAN LEBAT / LINDUNG</option>
                                    <option value="Mutasi Tanah Di Desa">MUTASI TANAH di DESA</option>
                                    <option value="Tanah Kosong">TANAH KOSONG</option>
                                    <option value="Lain">LAIN-LAIN</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_penggunaan_tanah" class="col-md-4 control-label">Luas Penggunaan Tanah</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_penggunaan_tanah" id="luas_penggunaan_tanah">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="keterangan" class="control-label col-md-4">Keterangan</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows=""></textarea>
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
                <h4 class="modal-title">Ubah Data Tanah di Desa</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-tambah-inventaris">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="nama" class="col-md-4 control-label">Nama Perorang / Badan Hukum</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nama" id="nama" autofocus>
                            <input type="hidden" name="id" id="id">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jumlah" class="col-md-4 control-label">Jumlah (M2)</label>
                        <div class="col-md-8">
                            <input class="form-control" name="jumlah" id="jumlah">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="status_tanah" class="col-md-4 control-label">Status Hak Tanah</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" name="status_tanah" id="status_tanah">
                                <option value="">Pilih</option>
                                <optgroup label="Sudah Bersertifikat">
                                    <option value="hm">Hak Milik</option>
                                    <option value="hgb">Hak Guna Bangunan</option>
                                    <option value="hp">Hak Pakai</option>
                                    <option value="hgu">Hak Guna Usaha</option>
                                    <option value="hpl">Hak Pengolahan</option>
                                </optgroup>
                                <optgroup label="Belum Bersertifikat">
                                    <option value="ma">Hak Milik Adat</option>
                                    <option value="vi">Hak Verponding Indonesia</option>
                                    <option value="tn">Tanah Negara</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_status_tanah" class="col-md-4 control-label">Luas Status Hak Tanah (M2)</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_status_tanah" id="luas_status_tanah">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="penggunaan_tanah" class="col-md-4 control-label">Penggunaan Tanah</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" name="penggunaan_tanah" id="penggunaan_tanah">
                                <option value="">Pilih</option>
                                <optgroup label="Non Pertanian">
                                    <option value="Perumahan">PERUMAHAN</option>
                                    <option value="Perdagangan dan Jasa">PERDAGANGAN DAN JASA</option>
                                    <option value="Perkantoran">PERKANTORAN</option>
                                    <option value="Industri">INDUSTRI</option>
                                    <option value="Fasilitas Umum">FASILITAS UMUM</option>
                                </optgroup>
                                <optgroup label="Pertanian">
                                    <option value="Sawah">SAWAH</option>
                                    <option value="Tegalan">TEGALAN</option>
                                    <option value="Kebun">PERKEBUNAN</option>
                                    <option value="Ternak / Tambak / Kolam">PETERNAKAN / PERIKANAN</option>
                                    <option value="Hutan Belukar">HUTAN BELUKAR</option>
                                    <option value="Hutan Lebat / Lindung">HUTAN LEBAT / LINDUNG</option>
                                    <option value="Mutasi Tanah Di Desa">MUTASI TANAH di DESA</option>
                                    <option value="Tanah Kosong">TANAH KOSONG</option>
                                    <option value="Lain">LAIN-LAIN</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_penggunaan_tanah" class="col-md-4 control-label">Luas Penggunaan Tanah</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_penggunaan_tanah" id="luas_penggunaan_tanah">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="keterangan" class="control-label col-md-4">Keterangan</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows=""></textarea>
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