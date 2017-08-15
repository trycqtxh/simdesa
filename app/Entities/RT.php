<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class RT extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'r_ts';
    public $timestamps = false;
    protected $fillable = ['id', 'nama', 'rw_id', 'petugas'];
    protected $visible = ['id', 'nama', 'rw_id', 'petugas'];

    public function rw()
    {
        return $this->belongsTo(RW::class, 'rw_id');
    }

    public function anggotaKeluargas()
    {
        return $this->hasMany(AnggotaKeluarga::class, 'rt_id');
    }

    public function pendudukInduks()
    {
        return $this->hasMany(PendudukInduk::class, 'rt_id');
    }

}
