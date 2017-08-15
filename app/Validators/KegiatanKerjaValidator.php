<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class KegiatanKerjaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'bidang' => '',
            'jenis' => '',
            'sub_bidang' => 'required',
            'jenis_kegiatan' => 'required',
            'lokasi' => 'required',
            'volume' => 'required',
            'manfaat' => 'required',
            'jumlah' => 'required',
            'sumber_dana' => 'required',
            'pola_pelaksanaan' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'bidang' => 'required',
            'sub_bidang' => '',
            'jenis_kegiatan' => 'required',
            'lokasi' => 'required',
            'volume' => 'required',
            'manfaat' => 'required',
            'jumlah' => 'required',
            'sumber_dana' => 'required',
            'pola_pelaksanaan' => 'required',
        ],
   ];
}
