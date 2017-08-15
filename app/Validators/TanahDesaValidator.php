<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class TanahDesaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nama' => 'required',
            'jumlah' => 'required',
            'status_tanah' => 'required',
            'luas_status_tanah' => 'required',
            'penggunaan_tanah' => 'required',
            'luas_penggunaan_tanah' => 'required',
            'keterangan' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nama' => 'required',
            'jumlah' => 'required',
            'status_tanah' => 'required',
            'luas_status_tanah' => 'required',
            'penggunaan_tanah' => 'required',
            'luas_penggunaan_tanah' => 'required',
            'keterangan' => 'required'
        ],
   ];
}
