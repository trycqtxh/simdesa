<div class="modal" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">TAMBAH RINCIAN</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="nomor_bukti" class="col-md-2 control-label">Nomor Bukti</label>
                        <div class="col-md-10">
                            <input class="form-control" name="nomor_bukti" id="nomor_bukti">
                            <input type="hidden" name="pendapatan_id" id="pendapatan_id" value="{{ $id }}">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="metode" class="col-md-2 control-label">Metode</label>
                        <div class="col-md-10">
                            <select class="form-control" name="metode" id="metode">
                                <option value="Tunai">Tunai</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal" class="col-md-2 control-label">Tanggal</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input class="form-control" name="tanggal" id="tanggal" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="uraian" class="col-md-2 control-label">Uraian</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="uraian" id="uraian" style="resize: none" rows="" tabindex="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jumlah" class="col-md-2 control-label">Jumlah</label>
                        <div class="col-md-10">
                            <input class="form-control" name="jumlah" id="jumlah">
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
                <h4 class="modal-title">UBAH RINCIAN</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="nomor_bukti" class="col-md-2 control-label">Nomor Bukti</label>
                        <div class="col-md-10">
                            <input class="form-control" name="nomor_bukti" id="nomor_bukti">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="pendapatan_id" id="pendapatan_id" value="{{ $id }}">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="metode" class="col-md-2 control-label">Metode</label>
                        <div class="col-md-10">
                            <select class="form-control" name="metode" id="metode">
                                <option value="Tunai">Tunai</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal" class="col-md-2 control-label">Tanggal</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input class="form-control" name="tanggal" id="tanggal" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="uraian" class="col-md-2 control-label">Uraian</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="uraian" id="uraian" style="resize: none" rows="" tabindex="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="jumlah" class="col-md-2 control-label">Jumlah</label>
                        <div class="col-md-10">
                            <input class="form-control" name="jumlah" id="jumlah">
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