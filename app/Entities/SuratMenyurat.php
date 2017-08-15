<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class SuratMenyurat extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'surat_menyurat';
    protected $fillable = ['id', 'nomor_surat', 'jenis_surat', 'url', 'pemohon', 'tanggal_surat'];
    protected $visible = ['id', 'nomor_surat', 'jenis_surat', 'url', 'pemohon', 'tanggal_surat'];

}
