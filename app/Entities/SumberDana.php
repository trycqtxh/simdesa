<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class SumberDana extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'sumber_dana';
    public $timestamps = false;
    protected $fillable = ['id', 'nama'];
    protected $visible = ['id', 'nama'];

    public function kegitanKerjas()
    {
        return $this->hasMany(KegiatanKerja::class, 'sumber_dana_id');
    }

}
