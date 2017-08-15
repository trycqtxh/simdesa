<div class="modal-body">
    <div class="form-group form-group-sm">
        <label for="name" class="col-md-3 control-label">Nama</label>
        <div class="col-md-9">
            @php($aparat = App\Entities\AparatDesa::where('id', $id)->first())
            <input type="hidden" id="id" name="id" value="{{ $aparat->id }}">
            <input class="form-control" id="user" name="user" value="{{ ($aparat->induk) ? $aparat->induk->penduduk->nama: $aparat->nip }}" readonly>
        </div>
    </div>
    <div class="form-group form-group-sm">
        <label for="name" class="col-md-3 control-label">Role</label>
        <div class="col-md-9">
            <select name="role" class="form-control">
                <option value="">Pilih</option>
                @php($role_user = DB::table('role_user')->where('user_id', $aparat->id)->get() )
                @php($role = App\Role::all())
                @foreach($role as $a)
                    <option value="{{ $a->id }}" {{ ( ($a->id == $role_user->pluck('role_id')[0]) ? 'selected': '') }}>{{ $a->display_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-default">Simpan</button>
</div>