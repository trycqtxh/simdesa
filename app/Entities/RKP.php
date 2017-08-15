<?php

namespace App\Entities;


use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class RKP extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'rkp';
    protected $fillable = ['id', 'tahun', 'rpjm_id', 'kegiatan_kerja_id', 'rencana_kegiatan'];
    protected $visible = ['id', 'tahun', 'rpjm_id', 'kegiatan_kerja_id', 'rencana_kegiatan'];

    public function kerja()
    {
        return $this->belongsTo(KegiatanKerja::class, 'kegiatan_kerja_id');
    }

    public function Rpjm()
    {
        return $this->belongsTo(RPJM::class, 'rpjm_id');
    }

    public function rkks()
    {
        return $this->hasMany(RKP::class, 'rkp_id');
    }

    public function realisasi()
    {
        return $this->hasMany(RealisasiBelanja::class, 'belanja_id');
    }
}
