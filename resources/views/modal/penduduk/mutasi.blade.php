{{-- MODAL TAMBAH MUTASI --}}
<div class="modal" id="modal-tambah-mutasi" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Penduduk Mutasi</h4>
            </div>
            <form role="form" class="form-horizontal" id="form-tambah-mutasi">
                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="form-group form-group-sm">
                            <label for="nik" class="col-md-4 control-label">NIK</label>
                            <div class="col-md-8">
                                <input class="form-control" name="nik" id="nik" autofocus>
                                <input type="hidden" name="jenis" id="jenis" value="MASUK">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="nama" class="col-md-4 control-label">Nama Lengkap</label>
                            <div class="col-md-8">
                                <input class="form-control" name="nama" id="nama">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="jenis_kelamin" class="col-md-4 control-label">Jenis Kelamin</label>
                            <div class="col-md-8">
                                <select class="form-control selectpicker show-tick" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="">Pilih</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="kewarga_negaraan" class="col-md-4 control-label">Kewarganegaraan</label>
                            <div class="col-md-8">
                                <select class="form-control selectpicker show-tick" name="kewarga_negaraan" id="kewarga_negaraan">
                                    <option value="">Pilih</option>
                                    <option value="WNI">Warga Negara Indonesia</option>
                                    <option value="WNA">Warga Negara Asing</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-sm">
                            <label for="tempat_lahir" class="col-md-4 control-label">Tempat Lahir</label>
                            <div class="col-md-8">
                                <input class="form-control" name="tempat_lahir" id="tempat_lahir">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="tanggal_lahir" class="col-md-4 control-label">Tanggal Lahir</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input class="form-control" name="tanggal_lahir" id="tanggal_lahir" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="datang_dari" class="col-md-4 control-label">Datang dari</label>
                            <div class="col-md-8">
                                <input class="form-control" name="datang_dari" id="datang_dari">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="tanggal_datang" class="col-md-4 control-label">Tanggal Datang</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input class="form-control" name="tanggal_datang" id="tanggal_datang" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group form-group-sm">
                                <label for="keterangan" class="control-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="15"></textarea>
                            </div>
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

{{-- MODAL LIHAT MUTASI --}}
<div class="modal" id="modal-lihat-mutasi" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail Penduduk Mutasi</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="tabel-lihat">
                    <tbody>
                    <tr>
                        <td style="width:20%">Nama Lengkap</td>
                        <td style="width:2%">:</td>
                        <td style="width:70%" mutasi="nama"></td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>:</td>
                        <td mutasi="tempat_lahir"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td mutasi="tanggal_lahir"></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td mutasi="jenis_kelamin"></td>
                    </tr>
                    <tr>
                        <td>Kewarganegaraan</td>
                        <td>:</td>
                        <td mutasi="kewarga_negaraan"></td>
                    </tr>
                    <tr>
                        <td mutasi="text_daerah"></td>
                        <td>:</td>
                        <td mutasi="daerah"></td>
                    </tr>
                    <tr>
                        <td>Pada Tanggal</td>
                        <td>:</td>
                        <td mutasi="tanggal"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>