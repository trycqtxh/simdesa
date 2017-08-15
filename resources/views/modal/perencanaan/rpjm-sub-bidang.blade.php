{{-- MODAL TAMBAH SUB BIDANG RPJM--}}
<div  id="modal-tambah-sub-bidang" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Sub Bidang</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-tambah-sub-bidang">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="bidang" class="col-md-4 control-label">Pilih Bidang</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" id="bidang" name="bidang">
                                <option value="">Pilih Bidang</option>
                                @foreach($bidang as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="sub_bidang" class="col-md-4 control-label">Sub Bidang</label>
                        <div class="col-md-8">
                            <input class="form-control" name="sub_bidang" id="sub_bidang">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{-- MODAL UBAH SUB BIDANG RPJM--}}
<div  id="modal-ubah-sub-bidang" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Sub Bidang</h4>
            </div>
            <form class="form-horizontal" role="form" id="form-ubah-sub-bidang">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="bidang" class="col-md-4 control-label">Pilih Bidang</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker show-tick" id="bidang" name="bidang">
                                <option value="">Pilih Bidang</option>
                                @php($bidang = App\Entities\Bidang::all() )
                                @foreach($bidang as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="sub_bidang" class="col-md-4 control-label">Sub Bidang</label>
                        <div class="col-md-8">
                            <input class="form-control" name="sub_bidang" id="sub_bidang">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


{{-- MODAL TAMBAH SUB BIDANG TABLE--}}
<div  id="modal-tambah-sub-bidang-tabel" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Sub Bidang</h4>
            </div>
            <form class="form-horizontal" role="form">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group form-group-sm">
                        <label for="sub_bidang" class="col-md-4 control-label">Sub Bidang</label>
                        <div class="col-md-8">
                            <input class="form-control" name="sub_bidang" id="sub_bidang">
                            <input type="hidden" name="bidang">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{-- VIEW MODAL SUB BIDANG--}}
<div id="modal-view-sub-bidang" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">SUB BIDANG</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th></th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>