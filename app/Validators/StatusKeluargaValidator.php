<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class StatusKeluargaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'kode'   => 'required|regex:/^[\pL\s\-]+$/u',
            'status' => 'required|regex:/^[\pL\s\-]+$/u',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'kode'   => 'required|regex:/^[\pL\s\-]+$/u',
            'status' => 'required|regex:/^[\pL\s\-]+$/u',
        ],
   ];
}
