<div class="modal" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Aparat Pemerintah Desa</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-sm">
                                <label for="nik" class="col-md-4 control-label">NIK</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input class="form-control" name="nik" id="nik" tabindex="1">
                                        <span class="input-group-btn">
                                             <button type='button' class='btn btn-info btn-flat btn-sm' id='cari'><i class='fa fa-search'></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="nama" class="col-md-4 control-label">Nama</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="nama" id="nama" readonly>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="jenis_kelamin" class="col-md-4 control-label">Jenis Kelamin</label>
                                <div class="col-md-8">
                                    <input name="jenis_kelamin" id="jenis_kelamin" class="form-control" readonly>
                                </div>
                            </div>
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
                                <label for="agama" class="col-md-4 control-label">Agama</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="agama" id="agama" readonly>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="pendidikan" class="col-md-4 control-label">Pendidikan Terakhir</label>
                                <div class="col-md-8">
                                    <input name="pendidikan" id="pendidikan" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                             <div class="form-group form-group-sm">
                                 <label for="niap" class="col-md-4 control-label">NIAP</label>
                                 <div class="col-md-8">
                                     <input class="form-control" name="niap" id="niap" tabindex="2">
                                 </div>
                             </div>
                             <div class="form-group form-group-sm">
                                 <label for="nip" class="col-md-4 control-label">NIP</label>
                                 <div class="col-md-8">
                                     <input class="form-control" name="nip" id="nip" tabindex="3">
                                 </div>
                             </div>
                             <div class="form-group form-group-sm">
                                 <label for="golongan" class="col-md-4 control-label">Pangkat Golongan</label>
                                 <div class="col-md-8">
                                     <select class="form-control  selectpicker show-tick" name="golongan" id="golongan" tabindex="4">
                                         <option value="">Pilih</option>
                                         <option value="I/a">I/a</option>
                                         <option value="I/b">I/b</option>
                                         <option value="I/c">I/c</option>
                                         <option value="I/d">I/d</option>
                                         <option value="II/a">II/a</option>
                                         <option value="II/b">II/b</option>
                                         <option value="II/c">II/c</option>
                                         <option value="II/d">II/d</option>
                                         <option value="III/a">III/a</option>
                                         <option value="III/b">III/b</option>
                                         <option value="III/c">III/c</option>
                                         <option value="III/d">III/d</option>
                                         <option value="IV/a">IV/a</option>
                                         <option value="IV/b">IV/b</option>
                                         <option value="IV/c">IV/c</option>
                                         <option value="IV/d">IV/d</option>
                                     </select>
                                 </div>
                             </div>

                            <div class="form-group form-group-sm">
                                <label for="jabatan" class="col-md-4 control-label">Jabatan</label>
                                <div class="col-md-8">
                                    <select name="jabatan" id="jabatan" class="form-control selectpicker show-tick" tabindex="5">
                                        <option value="">Pilih</option>
                                        @php($jabatan = App\Entities\Jabatan::all())
                                        @foreach($jabatan as $jd)
                                            <option value="{{ $jd->id }}">{{ $jd->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="nomor_pengangkatan" class="col-md-4 control-label">Nomor Pengangkatan</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="nomor_pengangkatan" id="nomor_pengangkatan" tabindex="6">
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="tanggal_pengangkatan" class="col-md-4 control-label">Tanggal Pengangkatan</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input class="form-control" name="tanggal_pengangkatan" id="tanggal_pengangkatan" tabindex="7" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="password" class="col-md-4 control-label">Password</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="password" id="password" tabindex="8" type="password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="form-group form-group-sm"  style="margin-bottom: 0px">
                                    <label for="keterangan" class="control-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="8"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" tabindex="16">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
