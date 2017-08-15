<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class AnggotaKeluarga extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'anggota_keluarga';
    protected $primaryKey = 'nomor_kk';
    public $incrementing = false;
    protected $fillable = ['nomor_kk','tanggal_dikeluarkan','tempat_dikeluarkan','tanggal_mulai_di_desa','keterangan'];
    protected $visible = ['nomor_kk','tanggal_dikeluarkan','tempat_dikeluarkan','tanggal_mulai_di_desa','keterangan'];

    public function induks()
    {
        return $this->hasMany(PendudukInduk::class, 'nomor_kk');
    }

}
