<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class RPJM extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'rpjm';
    protected $fillable = ['id', 'periode', 'tahun_awal', 'tahun_akhir'];
    protected $visible = ['id', 'periode', 'tahun_awal', 'tahun_akhir'];

    public function Rkps()
    {
        return $this->hasMany(RKP::class, 'rpjm_id');
    }

    public function kerjas()
    {
        return $this->belongsToMany(KegiatanKerja::class, 'rkp', 'rpjm_id', 'kegiatan_kerja_id');
    }

}
