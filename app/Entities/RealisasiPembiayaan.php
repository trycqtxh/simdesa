<?php

namespace App\Entities;

use App\Entities\Pembiayaan;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class RealisasiPembiayaan extends Model  implements Transformable
{
    use TransformableTrait;

    protected $table = 'realisasi_pembiayaan';
    protected $fillable = ['id', 'nomor_bukti', 'tanggal', 'metode', 'uraian', 'jumlah', 'pembiayaan_id'];
    protected $visible = ['id', 'nomor_bukti', 'tanggal', 'metode', 'uraian', 'jumlah', 'pembiayaan_id'];

    public function pembiayaan()
    {
        return $this->belongsTo(Pembiayaan::class, 'pembiayaan_id');
    }
}
