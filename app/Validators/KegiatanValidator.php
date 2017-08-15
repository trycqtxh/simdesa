<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class KegiatanValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'sub_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'sub_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
        ],
   ];
}
