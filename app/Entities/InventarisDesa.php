<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class InventarisDesa extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'inventaris_desa';
    protected $fillable = ['id','jenis_barang','di_beli_sendiri','di_beli_pemerintah','di_beli_provinsi','di_beli_kota','sumbangan','keadaan_baik','keadaan_rusak','rusak','dijual','disumbangkan','tanggal_penghapusan','akhir_baik','akhir_rusak','keterangan'];
    protected $visible = ['id','jenis_barang','di_beli_sendiri','di_beli_pemerintah','di_beli_provinsi','di_beli_kota','sumbangan','keadaan_baik','keadaan_rusak','rusak','dijual','disumbangkan','tanggal_penghapusan','akhir_baik','akhir_rusak','keterangan'];


}
