<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class EkspedisiDesaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'tanggal_pengiriman' => 'required',
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required',
            'ditujukan_kepada' => 'required',
            'isi_surat' => 'required',
            'keterangan' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'tanggal_pengiriman' => 'required',
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required',
            'ditujukan_kepada' => 'required',
            'isi_surat' => 'required',
            'keterangan' => 'required',
        ],
   ];
}
