<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Bidang extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'bidang';
    protected $fillable = ['id', 'nama'];
    protected $visible = ['id', 'nama'];
    public $timestamps = false;

    public function kerjas()
    {
        return $this->hasMany(KegiatanKerja::class, 'bidang_id');
    }

    public function Pendapatans()
    {
        return $this->hasMany(Pendapatan::class, 'bidang_id');
    }

    public function Pembiayaans()
    {
        return $this->hasMany(Pembiayaan::class, 'bidang_id');
    }

}
