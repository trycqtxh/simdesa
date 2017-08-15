<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Pembiayaan extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'pembiayaan';
    protected $fillable = ['id', 'uraian', 'level', 'jumlah_dana', 'bidang_id', 'pembiayaan_id', 'tahun', 'keterangan'];
    protected $visible = ['id', 'uraian', 'level', 'jumlah_dana', 'bidang_id', 'pembiayaan_id', 'tahun', 'keterangan'];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    public function realisasi()
    {
        return $this->hasMany(RealisasiPembiayaan::class, 'pembiayaan_id');
    }
}
