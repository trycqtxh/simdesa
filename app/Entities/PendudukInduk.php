<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class PendudukInduk extends Model implements Transformable
{
    use TransformableTrait;
//    use SoftDeletes;

    protected $table = 'penduduk_induk';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $fillable = ['nik', 'nama', 'agama', 'status_perkawinan', 'pendidikan', 'pekerjaan_id', 'membaca', 'alamat', 'keterangan', 'dusun', 'rt_id', 'rw_id', 'penduduk_id', 'status_keluarga_id', 'nik_ayah', 'nik_ibu', 'golongan_darah', 'ayah', 'ibu', 'nomor_kk'];
    protected $visible = ['nik', 'nama', 'agama', 'status_perkawinan', 'pendidikan', 'pekerjaan_id', 'membaca', 'alamat', 'keterangan', 'dusun', 'rt_id', 'rw_id', 'penduduk_id', 'status_keluarga_id', 'nik_ayah', 'nik_ibu', 'golongan_darah', 'ayah', 'ibu', 'nomor_kk'];

    public function statusKeluarga()
    {
        return $this->belongsTo(StatusKeluarga::class, 'status_keluarga_id');
    }
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, "penduduk_id");
    }
    public function anggotaKeluarga()
    {
        return $this->belongsTo(AnggotaKeluarga::class, 'nomor_kk');
    }
    public function rt()
    {
        return $this->belongsTo(RT::class, 'rt_id');
    }
    public function rw()
    {
        return $this->belongsTo(RW::class, 'rw_id');
    }
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id');
    }
    public function ktp()
    {
        return $this->hasOne(KTP::class, 'nik');
    }
    public function relasiAyah()
    {
        return $this->belongsTo(PendudukInduk::class, 'nik_ayah');
    }
    public function relasiIbu()
    {
        return $this->belongsTo(PendudukInduk::class, 'nik_ibu');
    }
}
