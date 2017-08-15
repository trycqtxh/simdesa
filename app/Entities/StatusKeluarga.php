<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class StatusKeluarga extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'status_keluarga';
    //protected $primaryKey = 'status_keluarga_id';
    //public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id', 'kode', 'nama'];
    protected $visible = ['id', 'kode', 'nama'];

    public function penduduks()
    {
        return $this->hasMany(Penduduk::class, 'status_keluarga_id');
    }

}
