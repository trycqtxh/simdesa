<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class KTP extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'ktp';
    protected $fillable = ['id','tanggal_mulai_di_desa','tanggal_dikeluarkan','tempat_dikeluarkan','keterangan', 'nik'];
    protected $visible = ['id','tanggal_mulai_di_desa','tanggal_dikeluarkan','tempat_dikeluarkan','keterangan', 'nik'];

    public function induks()
    {
        return $this->belongsTo(PendudukInduk::class, 'nik');
    }

}
