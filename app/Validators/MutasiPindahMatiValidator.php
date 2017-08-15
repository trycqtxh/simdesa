<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class MutasiPindahMatiValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nik' => 'required',
            'tanggal_pindah' => 'required',
            'pindah_ke' => 'required',
            'jenis' => 'required',
            'keterangan' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nik' => 'required',
            'tanggal_meninggal' => 'required',
            'meninggal_di' => 'required',
            'jenis' => 'required',
            'keterangan' => 'required',
        ],
   ];
}
