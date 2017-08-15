<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class KegiatanKerja extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'kegiatan_kerja';
    protected $fillable = ['id', 'uraian', 'bidang_id', 'kegiatan_kerja_id', 'jenis', 'lokasi', 'volume', 'manfaat', 'jumlah_dana', 'sumber_dana_id', 'pola_pelaksanaan', 'rpjm_id'];
    protected $visible = ['id', 'uraian', 'bidang_id', 'kegiatan_kerja_id', 'jenis', 'lokasi', 'volume', 'manfaat', 'jumlah_dana', 'sumber_dana_id', 'pola_pelaksanaan', 'rpjm_id'];


    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    public function Rpjms()
    {
        return $this->belongsToMany(RPJM::class, 'rkp', 'kegiatan_kerja_id', 'rpjm_id');
    }

    public function kerjas()
    {
        return $this->hasMany(KegiatanKerja::class, 'kegiatan_kerja_id');
    }


    public function rkps()
    {
        return $this->hasMany(RKP::class, 'kegiatan_kerja_id');
    }


    public function kerjasSubBidang()
    {
        return $this->hasMany(KegiatanKerja::class, 'kegiatan_kerja_id')->where('jenis', 'level_1');
    }

    public function kerjasKegiatan()
    {
        return $this->hasMany(KegiatanKerja::class, 'kegiatan_kerja_id')->where('jenis', 'level_2');
    }

    public function kerjasSubKegiatan()
    {
        return $this->hasMany(KegiatanKerja::class, 'kegiatan_kerja_id')->where('jenis', 'level_3');
    }

    public function detailKegiatanKerjas()
    {
        return $this->hasMany(DetailKegiatanKerja::class, 'kegiatan_kerja_id');
    }

}
