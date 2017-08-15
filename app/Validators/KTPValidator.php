<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class KTPValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'tanggal_mulai_didesa' => 'required',
            'tanggal_dikeluarkan' => 'required',
            'tempat_dikeluarkan' => 'required',
            'keterangan' => 'required',
            'nik' => 'required|unique:ktp',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'tanggal_mulai_didesa' => 'required',
            'tanggal_dikeluarkan' => 'required',
            'tempat_dikeluarkan' => 'required',
            'keterangan' => 'required',
            'nik' => 'required',
        ],
   ];
}
