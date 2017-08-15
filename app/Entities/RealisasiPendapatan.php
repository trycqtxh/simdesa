<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class RealisasiPendapatan extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'realisasi_pendapatan';
    protected $fillable = ['id', 'nomor_bukti', 'tanggal', 'metode', 'uraian', 'jumlah', 'pendapatan_id'];
    protected $visible = ['id', 'nomor_bukti', 'tanggal', 'metode', 'uraian', 'jumlah', 'pendapatan_id'];

    public function pendapatan()
    {
        return $this->belongsTo(Pendapatan::class, 'pendapatan_id');
    }
}
