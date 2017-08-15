<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProfilDesa extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'profil_desa';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $fillable = ['kode', 'index','value'];
    protected $visible = ['kode', 'index','value'];

}
