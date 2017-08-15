<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Pekerjaan extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'pekerjaan';
    protected $fillable = ['id', 'nama'];
    protected $visible = ['id', 'nama'];
    public $timestamps = false;

    public function pendudukInduk()
    {
        return $this->hasMany(PendudukInduk::class, 'pekerjaan_id');
    }

    public function pendudukSementara()
    {
        return $this->hasMany(PendudukSementara::class, 'pekerjaan_id');
    }
}
