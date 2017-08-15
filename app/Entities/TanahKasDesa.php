<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TanahKasDesa extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'tanah_kas_desa';
    protected $fillable = ['asal_tanah','nomor_sertifikat','kelas','luas','peroleh_tkd','luas_perolehan_tkd','tanggal_peroleh','luas_ada_patok','luas_tidak_patok','luas_ada_papan_nama','luas_tidak_papan_nama','lokasi','manfaat','mutasi','keterangan'];
    protected $visible = ['asal_tanah','nomor_sertifikat','kelas','luas','peroleh_tkd','luas_perolehan_tkd','tanggal_peroleh','luas_ada_patok','luas_tidak_patok','luas_ada_papan_nama','luas_tidak_papan_nama','lokasi','manfaat','mutasi','keterangan'];


    public function tanahDesas()
    {
        return $this->hasMany(TanahDesa::class, 'id_tanah_kas_desa');
    }
}
