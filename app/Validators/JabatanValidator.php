<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class JabatanValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'kode'    => 'required|regex:/^[\pL\s\-]+$/u',
            'jabatan' => 'required|regex:/^[\pL\s\-]+$/u'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'kode'    => 'required|regex:/^[\pL\s\-]+$/u',
            'jabatan' => 'required|regex:/^[\pL\s\-]+$/u'
        ],
   ];
}
