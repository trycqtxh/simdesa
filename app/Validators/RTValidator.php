<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class RTValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'rw'      => 'required',
        	'rt'      => 'required|unique:r_ts,nama',
        	'petugas' => 'required|regex:/^[\pL\s\-]+$/u',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'rw'      => 'required',
        	'rt'      => 'required',
        	'petugas' => 'required|regex:/^[\pL\s\-]+$/u',
        ],
   ];
}
