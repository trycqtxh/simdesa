<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PeraturanDesaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nomor_ditetapkan' => 'required',
            'tanggal_ditetapkan' => 'required',
            'tentang' => 'required',
            'uraian_singkat' => 'required',
            'tanggal_peraturan' => 'required',
            'no_kesepakatan' => 'required',
            'nomor_dilaporkan' => 'required',
            'tanggal_dilaporkan' => 'required',
            'keterangan' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nomor_ditetapkan' => 'required',
            'tanggal_ditetapkan' => 'required',
            'tentang' => 'required',
            'uraian_singkat' => 'required',
            'tanggal_peraturan' => 'required',
            'no_kesepakatan' => 'required',
            'nomor_dilaporkan' => 'required',
            'tanggal_dilaporkan' => 'required',
            'keterangan' => 'required',
        ],
   ];
}
