{{-- MODAL Tambah Sementara --}}
<div class="modal" id="modal-tambah-sementara" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Penduduk Sementara</h4>
            </div>
            <form role="form" class="form-horizontal" id="form-tambah-sementara">
                <div class="modal-body">
                    <div class="col-md-6">
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
                            <label for="jenis_identitas" class="col-md-4 control-label">Jenis Identitas</label>
                            <div class="col-md-8">
                                <select class="form-control selectpicker show-tick" name="jenis_identitas" id="jenis_identitas">
                                    <option value="">Pilih</option>
                                    <option value="KTP">KTP</option>
                                    <option value="PASPORT">PASPORT</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="no_identitas" class="col-md-4 control-label">No Identitas</label>
                            <div class="col-md-8">
                                <input class="form-control" name="no_identitas" id="no_identitas" autofocus>
                            </div>
                        </div>
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
                            <label for="pekerjaan" class="col-md-4 control-label">Pekerjaan</label>
                            <div class="col-md-8">
                                <select class="form-control selectpicker show-tick" name="pekerjaan" id="pekerjaan">
                                    @php($pekerjaan = \App\Entities\Pekerjaan::all())
                                    <option value="">Pilih</option>
                                    @foreach($pekerjaan as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                        <div class="form-group form-group-sm">
                            <label for="keturunan" class="col-md-4 control-label">Keturunan</label>
                            <div class="col-md-8">
                                <input class="form-control" name="keturunan" id="keturunan">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="datang_dari" class="col-md-4 control-label">Datang Dari</label>
                            <div class="col-md-8">
                                <input class="form-control" name="datang_dari" id="datang_dari">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="maksud_tujuan" class="col-md-4 control-label">Maksud dan Tujuan</label>
                            <div class="col-md-8">
                                <input class="form-control" name="maksud_tujuan" id="maksud_tujuan">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="alamat_tujuan" class="col-md-4 control-label">Alamat yang didatangi</label>
                            <div class="col-md-8">
                                <input class="form-control" name="alamat_tujuan" id="alamat_tujuan">
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
                        <div class="form-group form-group-sm">
                            <label for="tanggal_pergi" class="col-md-4 control-label">Tanggal Pergi</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input class="form-control" name="tanggal_pergi" id="tanggal_pergi" readonly>
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

{{-- LIHAT SEMENTARA --}}
<div class="modal" id="modal-lihat-sementara" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail Penduduk Sementara</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td style="width:20%">Nama Lengkap</td>
                        <td style="width:2%">:</td>
                        <td style="width:70%" sementara="nama"></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td sementara="jenis_kelamin"></td>
                    </tr>
                    <tr>
                        <td>No Identitas</td>
                        <td>:</td>
                        <td sementara="no_identitas"></td>
                    </tr>
                    <tr>
                        <td>Tempat Tanggal Lahir</td>
                        <td>:</td>
                        <td sementara="tempat_tanggal_lahir"></td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td>:</td>
                        <td sementara="pekerjaan"></td>
                    </tr>
                    <tr>
                        <td>Kewarganegaraan</td>
                        <td>:</td>
                        <td sementara="kewarga_negaraan"></td>
                    </tr>
                    <tr>
                        <td>Keturunan</td>
                        <td>:</td>
                        <td sementara="keturunan"></td>
                    </tr>
                    <tr>
                        <td>Datang Dari</td>
                        <td>:</td>
                        <td sementara="datang_dari"></td>
                    </tr>
                    <tr>
                        <td>Maksud & Tujuan Kedatangan</td>
                        <td>:</td>
                        <td sementara="maksud_tujuan"></td>
                    </tr>
                    <tr>
                        <td>Nama dan Alamat Didatangi</td>
                        <td>:</td>
                        <td sementara="alamat_tujuan"></td>
                    </tr>
                    <tr>
                        <td>Datang Tanggal</td>
                        <td>:</td>
                        <td sementara="datang_tanggal"></td>
                    </tr>
                    <tr>
                        <td>Pergi Tanggal</td>
                        <td>:</td>
                        <td sementara="pergi_tanggal"></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td sementara="keterangan"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>