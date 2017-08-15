<div class="modal" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">FORM TAMBAH</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="uraian" class="col-md-4 control-label">Uraian</label>
                        <div class="col-md-8">
                            <input class="form-control" name="uraian" id="uraian" readonly>
                            <input type="hidden" name="rkp_id">
                            <input type="hidden" name="detail_kegiatan_kerja_id">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jumlah_laki_laki" class="col-md-4 control-label">Jumlah Laki-laki</label>
                        <div class="col-md-8">
                            <input class="form-control" name="jumlah_laki_laki" id="jumlah_laki_laki">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jumlah_perempuan" class="col-md-4 control-label">Jumlah Perempuan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="jumlah_perempuan" id="jumlah_perempuan">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jumlah_rt_m" class="col-md-4 control-label">Jumlah A RT M</label>
                        <div class="col-md-8">
                            <input class="form-control" name="jumlah_rt_m" id="jumlah_rt_m">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="waktu_mulai" class="col-md-4 control-label">Waktu Mulai</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="waktu_mulai" id="waktu_mulai" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="waktu_selesai" class="col-md-4 control-label">Waktu Selesai</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="waktu_selesai" id="waktu_selesai" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
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

<div class="modal" id="modal-ubah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">FORM UBAH</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="uraian" class="col-md-4 control-label">Uraian</label>
                        <div class="col-md-8">
                            <input class="form-control" name="uraian" id="uraian" readonly>
                            <input type="hidden" name="id">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jumlah_laki_laki" class="col-md-4 control-label">Jumlah Laki-laki</label>
                        <div class="col-md-8">
                            <input class="form-control" name="jumlah_laki_laki" id="jumlah_laki_laki">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jumlah_perempuan" class="col-md-4 control-label">Jumlah Perempuan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="jumlah_perempuan" id="jumlah_perempuan">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jumlah_rt_m" class="col-md-4 control-label">Jumlah A RT M</label>
                        <div class="col-md-8">
                            <input class="form-control" name="jumlah_rt_m" id="jumlah_rt_m">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="waktu_mulai" class="col-md-4 control-label">Waktu Mulai</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="waktu_mulai" id="waktu_mulai" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="waktu_selesai" class="col-md-4 control-label">Waktu Selesai</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="waktu_selesai" id="waktu_selesai" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
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