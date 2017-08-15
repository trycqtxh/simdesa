<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class KeputusanKepalaDesaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nomor_keputusan' => 'required',
            'tanggal_keputusan' => 'required',
            'tentang' => 'required',
            'uraian_singkat' => 'required',
            'nomor_dilaporkan' => 'required',
            'tanggal_dilaporkan' => 'required',
            'keterangan' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nomor_keputusan' => 'required',
            'tanggal_keputusan' => 'required',
            'tentang' => 'required',
            'uraian_singkat' => 'required',
            'nomor_dilaporkan' => 'required',
            'tanggal_dilaporkan' => 'required',
            'keterangan' => 'required',
        ],
   ];
}
