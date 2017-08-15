<div class="modal-body">
    <div class="form-group form-group-sm">
        <label for="name" class="col-md-3 control-label">Nama</label>
        <div class="col-md-9">
            <select name="user" class="form-control">
                <option value="">Pilih</option>
                @php($aparat = App\Entities\AparatDesa::has('role_users', '=', 0)->get())
                @foreach($aparat as $a)
                    <option value="{{ $a->id }}">{{ $a->induk->penduduk->nama }}</option>
                 @endforeach
            </select>
        </div>
    </div>
    <div class="form-group form-group-sm">
        <label for="name" class="col-md-3 control-label">Role</label>
        <div class="col-md-9">
            <select name="role" class="form-control">
                <option value="">Pilih</option>
                @php($role = App\Role::all())
                @foreach($role as $a)
                    @if(Auth()->user()->admin)
                        <option value="{{ $a->id }}">{{ $a->display_name }}</option>
                    @else
                        @if($a->name !== 'admin')
                        <option value="{{ $a->id }}">{{ $a->display_name }}</option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-default">Simpan</button>
</div>