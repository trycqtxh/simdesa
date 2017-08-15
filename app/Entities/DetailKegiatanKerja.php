<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class DetailKegiatanKerja extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'detail_kegiatan_kerja';
    protected $fillable = ['id', 'kegiatan_kerja_id', 'lokasi', 'volume', 'manfaat', 'jumlah_dana', 'sumber_dana_id', 'pola_pelaksanaan'];
    protected $visible = ['id', 'kegiatan_kerja_id', 'lokasi', 'volume', 'manfaat', 'jumlah_dana', 'sumber_dana_id', 'pola_pelaksanaan'];
    protected $appends = ['jumlahAnggaran'];

    public function rkks()
    {
        return $this->hasMany(RKK::class, 'detail_kegiatan_kerja_id');
    }

    public function kegiatanKerja()
    {
        return $this->belongsTo(KegiatanKerja::class, 'kegiatan_kerja_id');
    }

    public function sumberDana()
    {
        return $this->belongsTo(SumberDana::class, 'sumber_dana_id');
    }


    public function getJumlahAnggaranAttribute()
    {
        return $this->sum('jumlah_dana');
    }
}
