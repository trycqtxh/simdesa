<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class RKKValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'jumlah_laki_laki' => 'required',
            'jumlah_perempuan' => 'required',
            'jumlah_rt_m'      => 'required',
            'waktu_mulai'      => 'required',
            'waktu_selesai'    => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'jumlah_laki_laki' => 'required',
            'jumlah_perempuan' => 'required',
            'jumlah_rt_m'      => 'required',
            'waktu_mulai'      => 'required',
            'waktu_selesai'    => 'required',
        ],
   ];
}
