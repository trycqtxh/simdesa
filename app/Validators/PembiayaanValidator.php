<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PembiayaanValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'uraian'   => 'required',
            'anggaran' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'uraian'   => 'required',
            'anggaran' => 'required'
        ],
   ];
}
