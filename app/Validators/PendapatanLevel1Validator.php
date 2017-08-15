<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PendapatanLevel1Validator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'uraian' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'uraian' => 'required'
        ],
   ];
}
