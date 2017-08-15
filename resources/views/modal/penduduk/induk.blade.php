{{-- TAMBAH INDUK --}}
<div class="modal" id="modal-tambah-induk" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Penduduk Induk</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-tambah-induk">
                <div class="modal-body" id="load-file-html-tambah">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-default">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Ubah INDUK --}}
<div class="modal" id="modal-ubah-induk" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Data Penduduk Induk</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-ubah-induk">
                <div class="modal-body" id="load-file-html">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-default">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Select KK--}}
<div class="modal" id="modal-select-kk" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Kartu Keluarga</h4>
            </div>
            <div class="modal-body" id="load-html">

            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL LIHAT INDUK --}}
<div class="modal" id="modal-lihat-induk"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail Penduduk Induk</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                    <tr>
                        <td style="width:20%">NIK</td>
                        <td style="width:2%">:</td>
                        <td induk="nik" style="width:70%"></td>
                    </tr>
                    <tr>
                        <td>No Kartu Keluarga</td>
                        <td>:</td>
                        <td induk="nomor_kk"></td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td induk="nama"></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td induk="jenis_kelamin"></td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>:</td>
                        <td induk="tempat_lahir"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td induk="tanggal_lahir"></td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>:</td>
                        <td induk="agama"></td>
                    </tr>
                    <tr>
                        <td>Status Perkawinan</td>
                        <td>:</td>
                        <td induk="status_perkawinan"></td>
                    </tr>
                    <tr>
                        <td>Status Keluarga</td>
                        <td>:</td>
                        <td induk="status_keluarga"></td>
                    </tr>
                    <tr>
                        <td>Warga Negara</td>
                        <td>:</td>
                        <td induk="kewarga_negaraan"></td>
                    </tr>
                    <tr>
                        <td>Pendidikan Terakhir</td>
                        <td>:</td>
                        <td induk="pendidikan"></td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td>:</td>
                        <td induk="pekerjaan"></td>
                    </tr>
                    <tr>
                        <td>Dapat Membaca</td>
                        <td>:</td>
                        <td induk="membaca"></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td induk="alamat"></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td induk="keterangan"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- MODAL MUTASI PINDAH --}}
<div class="modal" id="modal-tambah-mutasi" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Penduduk Mutasi</h4>
            </div>
            <form role="form" class="form-horizontal" id="form-tambah-mutasi">
                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="form-group form-group-sm">
                            <label for="nik" class="col-md-4 control-label">NIK</label>
                            <div class="col-md-8">
                                <input class="form-control" name="nik" id="nik" readonly>
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="jenis" id="jenis" value="KELUAR">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="nama" class="col-md-4 control-label">Nama Lengkap</label>
                            <div class="col-md-8">
                                <input class="form-control" name="nama" id="nama" readonly>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="jenis_kelamin" class="col-md-4 control-label">Jenis Kelamin</label>
                            <div class="col-md-8">
                                <input class="form-control" name="jenis_kelamin" id="jenis_kelamin" readonly>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="kewarga_negaraan" class="col-md-4 control-label">Kewarganegaraan</label>
                            <div class="col-md-8">
                                <input class="form-control" name="kewarga_negaraan" id="kewarga_negaraan" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-sm">
                            <label for="tempat_lahir" class="col-md-4 control-label">Tempat Lahir</label>
                            <div class="col-md-8">
                                <input class="form-control" name="tempat_lahir" id="tempat_lahir" readonly>
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
                            <label for="pindah_ke" class="col-md-4 control-label">Pindah Ke</label>
                            <div class="col-md-8">
                                <input class="form-control" name="pindah_ke" id="pindah_ke">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="tanggal_pindah" class="col-md-4 control-label">Tanggal Pindah</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input class="form-control" name="tanggal_pindah" id="tanggal_pindah" readonly>
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

{{-- MODAL MUTASI MATI --}}
<div class="modal" id="modal-mutasi-mati" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Penduduk Meninggal</h4>
            </div>
            <form role="form" class="form-horizontal" id="form-mutasi-mati">
                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="form-group form-group-sm">
                            <label for="nik" class="col-md-4 control-label">NIK</label>
                            <div class="col-md-8">
                                <input class="form-control" name="nik" id="nik" readonly>
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="jenis" id="jenis" value="MATI">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="nama" class="col-md-4 control-label">Nama Lengkap</label>
                            <div class="col-md-8">
                                <input class="form-control" name="nama" id="nama" readonly>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="jenis_kelamin" class="col-md-4 control-label">Jenis Kelamin</label>
                            <div class="col-md-8">
                                <input class="form-control" name="jenis_kelamin" id="jenis_kelamin" readonly>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="kewarga_negaraan" class="col-md-4 control-label">Kewarganegaraan</label>
                            <div class="col-md-8">
                                <input class="form-control" name="kewarga_negaraan" id="kewarga_negaraan" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-sm">
                            <label for="tempat_lahir" class="col-md-4 control-label">Tempat Lahir</label>
                            <div class="col-md-8">
                                <input class="form-control" name="tempat_lahir" id="tempat_lahir" disabled>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="tanggal_lahir" class="col-md-4 control-label">Tanggal Lahir</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input class="form-control" name="tanggal_lahir" id="tanggal_lahir" disabled>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="meninggal_di" class="col-md-4 control-label">Tempat Meninggal</label>
                            <div class="col-md-8">
                                <input class="form-control" name="meninggal_di" id="meninggal_di">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="tanggal_meninggal" class="col-md-4 control-label">Tanggal Meninggal</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input class="form-control" name="tanggal_meninggal" id="tanggal_meninggal" readonly>
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
