<?php

namespace App\Entities;

use App\Entities\RKP;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class RealisasiBelanja extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'realisasi_belanja';
    protected $fillable = ['id', 'nomor_bukti', 'tanggal', 'metode', 'uraian', 'jumlah', 'belanja_id'];
    protected $visible = ['id', 'nomor_bukti', 'tanggal', 'metode', 'uraian', 'jumlah', 'belanja_id'];

    public function belanja()
    {
        return $this->belongsTo(RKP::class, 'belanja_id');
    }
}
