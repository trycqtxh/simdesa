<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class RW extends Model implements Transformable
{
    use TransformableTrait;

    public $table = 'r_ws';
    public $timestamps = false;
    protected $fillable = ['id', 'nama', 'petugas'];
    protected $visible = ['id', 'nama', 'petugas'];

    public function rts()
    {
        return $this->hasMany(RT::class, 'rw_id');
    }

    public function anggotaKeluargas()
    {
        return $this->hasMany(AnggotaKeluarga::class, 'rt_id');
    }

    public function penduduks()
    {
        return $this->hasMany(Penduduk::class, 'rt_id');
    }
}
