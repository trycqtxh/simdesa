<div class="modal" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Lembar dan Berita Desa</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="peraturan" class="col-md-4 control-label">Peraturan Desa</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" name="peraturan" id="peraturan">
                                <option value="">Pilih</option>
                                <optgroup label="Peraturan Desa">
                                    @php($peraturan_desa = App\Entities\PeraturanDesa::has('berita', '=', '0')->where('jenis_peraturan', 'Peraturan Desa')->get() )
                                    @foreach($peraturan_desa as $p)
                                        <option value="{{ $p->id }}"  data-subtext="{{ $p->uraian }}">{{ $p->tentang }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Peraturan Kepala Desa">
                                    @php($peraturan_kepala = App\Entities\PeraturanDesa::has('berita', '=', '0')->where('jenis_peraturan', 'Peraturan Kepala Desa')->get() )
                                    @foreach($peraturan_kepala as $p)
                                        <option value="{{ $p->id }}"  data-subtext="{{ substr($p->uraian, 0, 30) }}">{{ $p->tentang }}</option>
                                        <option value="{{ $p->id }}"  data-subtext="{{ $p->nomor_ditetapkan.'/'.Carbon\Carbon::parse($p->tanggal_ditetapkan)->format('d-m-Y') }}">{{ $p->tentang }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="nomor_diundangkan" class="col-md-4 control-label">Nomor Diundangkan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nomor_diundangkan" id="nomor_diundangkan" tabindex="5" autofocus>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_diundangkan" class="col-md-4 control-label">Tanggal Diundangkan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_diundangkan" id="tanggal_diundangkan" tabindex="6" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_diundangkan" class="col-md-4 control-label">Keterangan</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="7"></textarea>
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
                <h4 class="modal-title">Ubah Data Lembar dan Berita Desa</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group form-group-sm">
                        <label for="nomor_diundangkan" class="col-md-4 control-label">Nomor Diundangkan</label>
                        <div class="col-md-8">
                            <input class="form-control" name="nomor_diundangkan" id="nomor_diundangkan" tabindex="5" autofocus>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_diundangkan" class="col-md-4 control-label">Tanggal Diundangkan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="tanggal_diundangkan" id="tanggal_diundangkan" tabindex="6" readonly>
                                        <span class="input-group-addon">
                                             <i class="fa fa-calendar"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tanggal_diundangkan" class="col-md-4 control-label">Keterangan</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="keterangan" id="keterangan" style="resize: none" rows="" tabindex="7"></textarea>
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