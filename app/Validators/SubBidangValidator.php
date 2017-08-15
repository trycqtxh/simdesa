<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class SubBidangValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'bidang'     => 'required',
            'sub_bidang' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'bidang'     => 'required',
            'sub_bidang' => 'required',
        ],
   ];
}
