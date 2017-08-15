<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class PendudukSementara extends Model implements Transformable
{
    use TransformableTrait;


    protected $table = 'penduduk_sementara';
    protected $fillable = ['id', 'no_identitas', 'tipe_identitas', 'pekerjaan_id', 'tujuan', 'alamat_tujuan', 'daerah_asal', 'turunan', 'tanggal_datang', 'tanggal_pergi', 'keterangan', 'penduduk_id'];
    protected $visible = ['id', 'no_identitas', 'tipe_identitas', 'pekerjaan_id', 'tujuan', 'alamat_tujuan', 'daerah_asal', 'turunan', 'tanggal_datang', 'tanggal_pergi', 'keterangan', 'penduduk_id'];


    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id');
    }

}
