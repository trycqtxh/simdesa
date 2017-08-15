<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class AparatDesaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nik' => 'required',
            'nama' => 'required',
            'niap' => '',
            'nip' => '',
            'golongan' => 'required',
            'jabatan' => 'required',
            'nomor_pengangkatan' => 'required',
            'tanggal_pengangkatan' => 'required',
            'keterangan' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];
}
