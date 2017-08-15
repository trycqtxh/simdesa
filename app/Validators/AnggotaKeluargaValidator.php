<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class AnggotaKeluargaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nomor_kk' => 'required',
            'tempat_dikeluarkan' => 'required',
            'tanggal_dikeluarkan' => 'required',
            'tanggal_mulai_didesa' => 'required',
            'keterangan' => '',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nomor_kk' => 'required',
            'tempat_dikeluarkan' => 'required',
            'tanggal_dikeluarkan' => 'required',
            'tanggal_mulai_didesa' => 'required',
            'keterangan' => '',
        ],
   ];
}
