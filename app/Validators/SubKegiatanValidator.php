<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class SubKegiatanValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'sub_kegiatan'     => 'required',
            'kegiatan'         => 'required',
            'lokasi'           => '',
            'volume'           => '',
            'manfaat'          => '',
            'jumlah'           => 'required',
            'sumber_dana'      => 'required',
            'pola_pelaksanaan' => '',
        ],
        ValidatorInterface::RULE_UPDATE => [
//            'sub_kegiatan'     => 'required',
            'kegiatan'         => 'required',
            'lokasi'           => '',
            'volume'           => '',
            'manfaat'          => '',
            'jumlah'           => 'required',
            'sumber_dana'      => 'required',
            'pola_pelaksanaan' => '',
        ],
   ];
}
