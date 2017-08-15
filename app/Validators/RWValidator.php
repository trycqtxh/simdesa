<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class RWValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'rw'      => 'required|unique:r_ws,nama',
            'petugas' => 'required|regex:/^[\pL\s\-]+$/u',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'rw'      => 'required',
            'petugas' => 'required|regex:/^[\pL\s\-]+$/u',
        ],
   ];
}
