<?php

namespace App\Entities;

use App\Role;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class AparatDesa extends Model implements Transformable, Authenticatable
{
    use TransformableTrait;
    use \Illuminate\Auth\Authenticatable;
    use EntrustUserTrait;

    protected $table = 'aparat_desa';
    protected $fillable = ['id','niap','nip','golongan','no_pengangkatan','tanggal_pengangkatan','no_pemberhentian','tanggal_pemberhentian','keterangan','jabatan_id','nik_penduduk', 'admin','password'];
    protected $visible = ['id','niap','nip','golongan','no_pengangkatan','tanggal_pengangkatan','no_pemberhentian','tanggal_pemberhentian','keterangan','jabatan_id','nik_penduduk', 'admin'];
    protected $hidden = ['password', 'remember_token'];

    protected $guard = 'aparat';

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function induk()
    {
        return $this->belongsTo(PendudukInduk::class, 'nik_penduduk');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function role_users()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

}
