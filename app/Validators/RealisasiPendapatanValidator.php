<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class RealisasiPendapatanValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'file'        => 'mimies:jpg,png,jpeg',
            'nomor_bukti' => 'required',
            'tanggal'     => 'required',
            'metode'      => 'required',
            'uraian'      => 'required',
            'jumlah'      => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'file'        => 'mimies:jpg,png,jpeg',
            'nomor_bukti' => 'required',
            'tanggal'     => 'required',
            'metode'      => 'required',
            'uraian'      => 'required',
            'jumlah'      => 'required'
        ],
   ];
}
