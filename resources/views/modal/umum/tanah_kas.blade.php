<div class="modal" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Tanah Kas Desa</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="asal_tanah" class="col-md-4 control-label">Asal Tanah</label>
                        <div class="col-md-8">
                            <input class="form-control" name="asal_tanah" id="asal_tanah" autofocus>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="nomor_sertifikat" class="col-md-4 control-label">Nomor Sertifikat</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nomor_sertifikat" id="nomor_sertifikat">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="kelas" class="col-md-4 control-label">Kelas</label>
                        <div class="col-md-8">
                            <input class="form-control" name="kelas" id="kelas">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas" class="col-md-4 control-label">Luas (M2)</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas" id="luas">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="perolehan_tkd" class="col-md-4 control-label">Perolehan TKD</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" name="perolehan_tkd" id="perolehan_tkd">
                                <option value="">Pilih</option>
                                <option value="Asli Milik Desa">ASLI MILIK DESA</option>
                                <option value="Pemerintah">PEMERINTAH</option>
                                <option value="Provinsi">PROVINSI</option>
                                <option value="Kabupaten">KAB/KOTA</option>
                                <option value="Lain-lain">LAIN-LAIN</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_peroleh_tkd" class="col-md-4 control-label">Luas Perolehan TKD (M2)</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_peroleh_tkd" id="luas_peroleh_tkd">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_perolehan" class="col-md-4 control-label">Tanggal Perolehan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_perolehan" id="tanggal_perolehan" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jenis_tkd" class="col-md-4 control-label">Jenis TKD</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" name="jenis_tkd" id="jenis_tkd">
                                <option value="">Pilih</option>
                                <option value="Sawah">SAWAH</option>
                                <option value="Tegalan">TEGAL</option>
                                <option value="Kebun">KEBUN</option>
                                <option value="Ternak / Tambak / Kolam">TAMBAK/KOLAM</option>
                                <option value="Tanah Kering / Darat">TANAH KERING/DARAT</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_jenis_tkd" class="col-md-4 control-label">Luas Jenis TKD</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_jenis_tkd" id="luas_jenis_tkd">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_patok_ada" class="col-md-4 control-label">Luas Patokan Tanda Batas Ada</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_patok_ada" id="luas_patok_ada">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_patok_tidak_ada" class="col-md-4 control-label">Luas Patokan Tanda Batas Tidak Ada</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_patok_tidak_ada" id="luas_patok_tidak_ada">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_papan_nama_ada" class="col-md-4 control-label">Luas Papan Nama Ada</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_papan_nama_ada" id="luas_papan_nama_ada">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_papan_nama_tidak_ada" class="col-md-4 control-label">Luas Papan Nama Tidak Ada</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_papan_nama_tidak_ada" id="luas_papan_nama_tidak_ada">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="lokasi" class="col-md-4 control-label">Lokasi</label>
                        <div class="col-md-8">
                            <input class="form-control" name="lokasi" id="lokasi">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="peruntukan" class="col-md-4 control-label">Peruntukan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="peruntukan" id="peruntukan">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="mutasi" class="col-md-4 control-label">Mutasi</label>
                        <div class="col-md-8">
                            <input class="form-control" name="mutasi" id="mutasi">
                        </div>
                    </div>
                    <div class="form-group form-group-sm"  style="margin-bottom: 0px">
                        <label for="keterangan" class="control-label col-md-4">Keterangan</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows=""></textarea>
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

<div class="modal" id="modal-ubah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Tanah Kas Desa</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="asal_tanah" class="col-md-4 control-label">Asal Tanah</label>
                        <div class="col-md-8">
                            <input class="form-control" name="asal_tanah" id="asal_tanah" autofocus>
                            <input type="hidden" name="id" id="id">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="nomor_sertifikat" class="col-md-4 control-label">Nomor Sertifikat</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nomor_sertifikat" id="nomor_sertifikat">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="kelas" class="col-md-4 control-label">Kelas</label>
                        <div class="col-md-8">
                            <input class="form-control" name="kelas" id="kelas">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas" class="col-md-4 control-label">Luas (M2)</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas" id="luas">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="perolehan_tkd" class="col-md-4 control-label">Perolehan TKD</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" name="perolehan_tkd" id="perolehan_tkd">
                                <option value="">Pilih</option>
                                <option value="Asli Milik Desa">ASLI MILIK DESA</option>
                                <option value="Pemerintah">PEMERINTAH</option>
                                <option value="Provinsi">PROVINSI</option>
                                <option value="Kabupaten">KAB/KOTA</option>
                                <option value="Lain-lain">LAIN-LAIN</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_peroleh_tkd" class="col-md-4 control-label">Luas Perolehan TKD (M2)</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_peroleh_tkd" id="luas_peroleh_tkd">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_perolehan" class="col-md-4 control-label">Tanggal Perolehan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_perolehan" id="tanggal_perolehan" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jenis_tkd" class="col-md-4 control-label">Jenis TKD</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" name="jenis_tkd" id="jenis_tkd">
                                <option value="">Pilih</option>
                                <option value="Sawah">SAWAH</option>
                                <option value="Tegalan">TEGAL</option>
                                <option value="Kebun">KEBUN</option>
                                <option value="Ternak / Tambak / Kolam">TAMBAK/KOLAM</option>
                                <option value="Tanah Kering / Darat">TANAH KERING/DARAT</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_jenis_tkd" class="col-md-4 control-label">Luas Jenis TKD</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_jenis_tkd" id="luas_jenis_tkd">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_patok_ada" class="col-md-4 control-label">Luas Patokan Tanda Batas Ada</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_patok_ada" id="luas_patok_ada">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_patok_tidak_ada" class="col-md-4 control-label">Luas Patokan Tanda Batas Tidak Ada</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_patok_tidak_ada" id="luas_patok_tidak_ada">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_papan_nama_ada" class="col-md-4 control-label">Luas Papan Nama Ada</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_papan_nama_ada" id="luas_papan_nama_ada">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="luas_papan_nama_tidak_ada" class="col-md-4 control-label">Luas Papan Nama Tidak Ada</label>
                        <div class="col-md-8">
                            <input class="form-control" name="luas_papan_nama_tidak_ada" id="luas_papan_nama_tidak_ada">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="lokasi" class="col-md-4 control-label">Lokasi</label>
                        <div class="col-md-8">
                            <input class="form-control" name="lokasi" id="lokasi">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="peruntukan" class="col-md-4 control-label">Peruntukan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="peruntukan" id="peruntukan">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="mutasi" class="col-md-4 control-label">Mutasi</label>
                        <div class="col-md-8">
                            <input class="form-control" name="mutasi" id="mutasi">
                        </div>
                    </div>
                    <div class="form-group form-group-sm"  style="margin-bottom: 0px">
                        <label for="keterangan" class="control-label col-md-4">Keterangan</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows=""></textarea>
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