<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    //
    protected $fillable = ['id', 'name', 'tampilan', 'display_name', 'description'];
}
