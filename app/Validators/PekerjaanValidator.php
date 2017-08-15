<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PekerjaanValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'pekerjaan' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'pekerjaan' => 'required'
        ],
   ];
}
