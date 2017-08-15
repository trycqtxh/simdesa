<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProfilDesaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'label' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'label' => 'required|min:2|max:2|numeric'
        ],
   ];
}
