<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Penduduk extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'penduduk';
    protected $fillable = ['id', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'kewarga_negaraan', ];
    protected $visible = ['id', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'kewarga_negaraan', 'jumlah_laki', 'jumlah_perempuan', 'total', 'label', 'value'];

    public function pendudukInduks()
    {
        return $this->hasMany(PendudukInduk::class, 'penduduk_id');
    }
    public function pendudukSementaras()
    {
        return $this->hasMany(PendudukSementara::class, 'penduduk_id');
    }
    public function pendudukMutasis()
    {
        return $this->hasMany(PendudukMutasi::class, 'penduduk_id');
    }

    public function mutasiMasuks()
    {
        return $this->hasMany(PendudukMutasi::class, 'penduduk_id')->where('jenis', 'MASUK');
    }

    public function mutasiKeluars()
    {
        return $this->hasMany(PendudukMutasi::class, 'penduduk_id')->where('jenis', 'KELUAR');
    }

    public function mutasiMatis()
    {
        return $this->hasMany(PendudukMutasi::class, 'penduduk_id')->where('jenis', 'MATI');
    }

}
