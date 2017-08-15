<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Jabatan extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'jabatan';
    public $timestamps = false;
    protected $fillable = ['id', 'nama', 'kode'];
    protected $visible = ['id', 'nama', 'kode'];

}
