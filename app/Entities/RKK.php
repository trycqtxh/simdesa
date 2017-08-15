<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class RKK extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'rkk';
    protected $fillable = ['id', 'sasaran_laki_laki', 'rkp_id', 'sasaran_perempuan', 'sasaran_a_rtm', 'mulai', 'selesai', 'detail_kegiatan_kerja_id'];
    protected $visible = ['id', 'sasaran_laki_laki', 'rkp_id', 'sasaran_perempuan', 'sasaran_a_rtm', 'mulai', 'selesai', 'detail_kegiatan_kerja_id'];

    public function rkp()
    {
        return $this->belongsTo(RKP::class, 'rkp_id');
    }

    public function DetailKegiatanKerja()
    {
        return $this->belongsTo(DetailKegiatanKerja::class, 'detail_kegiatan_kerja_id');
    }

}
