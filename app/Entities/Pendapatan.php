<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Pendapatan extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'pendapatan';
    protected $fillable = ['id', 'uraian', 'level', 'bidang_id', 'jumlah_dana', 'pendapatan_id', 'tahun', 'keterangan'];
    protected $visible = ['id', 'uraian', 'level', 'bidang_id', 'jumlah_dana', 'pendapatan_id', 'tahun', 'keterangan'];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    public function pendapatans()
    {
        return $this->hasMany(Pendapatan::class, 'pendapatan_id');
    }

    public function realisasi()
    {
        return $this->hasMany(RealisasiPendapatan::class, 'pendapatan_id');
    }

}
