<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class LembarBeritaDesaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'peraturan' => 'required',
            'nomor_diundangkan' => 'required',
            'tanggal_diundangkan' => 'required',
            'keterangan' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nomor_diundangkan' => 'required',
            'tanggal_diundangkan' => 'required',
            'keterangan' => 'required'
        ],
   ];
}
