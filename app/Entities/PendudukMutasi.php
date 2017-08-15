<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class PendudukMutasi extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'penduduk_mutasi';
    protected $fillable = ['id', 'nik', 'tanggal', 'jenis', 'daerah', 'keterangan', 'penduduk_id'];
    protected $visible = ['id', 'nik', 'tanggal', 'jenis', 'daerah', 'keterangan', 'penduduk_id'];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }
}
