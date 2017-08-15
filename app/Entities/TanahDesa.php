<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TanahDesa extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'tanah_desa';

    protected $fillable = ['id','nama', 'jumlah', 'status_tanah','luas_status','penggunaan_tanah','luas_penggunaan','lain','id_tanah_kas_desa','keterangan',];
    protected $visible = ['id','nama', 'jumlah', 'status_tanah','luas_status','penggunaan_tanah','luas_penggunaan','lain','id_tanah_kas_desa','keterangan',];

    public function tanahKasDesa()
    {
        return $this->belongsTo(TanahKasDesa::class, 'id_tanah_kas_desa');
    }

}
