<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LembarBeritaDesa extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'lembar_berita_desa';
    protected $fillable = ['id','nomor_diundangkan','tanggal_diundangkan', 'keterangan', 'peraturan_id'];
    protected $visible = ['id','nomor_diundangkan','tanggal_diundangkan', 'keterangan', 'peraturan_id'];

    public function peraturanDesaBerita()
    {
        return $this->belongsTo(PeraturanDesa::class, 'peraturan_id');
    }

}
