<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class PeraturanDesa extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'peraturan_desa';
    protected $fillable = ['id','jenis_peraturan','nomor_ditetapkan','tanggal_ditetapkan','tentang','uraian','nomor_kesepakatan','tanggal_kesepakatan','nomor_laporan','tanggal_laporan','keterangan'];
    protected $visible = ['id','jenis_peraturan','nomor_ditetapkan','tanggal_ditetapkan','tentang','uraian','nomor_kesepakatan','tanggal_kesepakatan','nomor_laporan','tanggal_laporan','keterangan'];


    public function berita()
    {
        return $this->hasOne(LembarBeritaDesa::class, 'peraturan_id');
    }
}
