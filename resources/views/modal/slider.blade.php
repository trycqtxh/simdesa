<div class="modal" id="modal-tambah"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" style="min-width: 360px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Slider</h4>
            </div>
            {!! Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'profil.slider.store']) !!}
            <div class="modal-body">
                <div class="form-group form-group-sm">
                    <label for="label" class="col-md-3 control-label">Judul</label>
                    <div class="col-md-8">
                        <textarea class="form-control" name="judul" id="judul" style="resize: none" rows="" ></textarea>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label for="label" class="col-md-3 control-label">Gambar</label>
                    <div class="col-md-8">
                        {!! Form::file('gambar', null) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal" id="modal-ubah"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" style="min-width: 360px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Slider</h4>
            </div>
            {!! Form::open(['class' => 'form-horizontal', 'files' => true]) !!}
            <div class="modal-body">
                <div class="form-group form-group-sm">
                    <label for="label" class="col-md-3 control-label">Judul</label>
                    <div class="col-md-8">
                        <textarea class="form-control" name="judul" id="judul" style="resize: none" rows="" ></textarea>
                        <input type="hidden" name="id" id="id">
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label for="label" class="col-md-3 control-label">Gambar</label>
                    <div class="col-md-8">
                        {!! Form::file('gambar', null) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>