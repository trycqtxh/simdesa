<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class AgendaMasukDesaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'tanggal_penerimaan' => 'required',
        	'nomor_surat'        => 'required',
        	'tanggal_surat'      => 'required',
        	'pengirim'           => 'required',
        	'isi_surat'          => 'required',
        	'keterangan'         => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
			'tanggal_penerimaan' => 'required',
			'nomor_surat'        => 'required',
			'tanggal_surat'      => 'required',
			'pengirim'           => 'required',
			'isi_surat'          => 'required',
			'keterangan'         => 'required'
		],
   ];
}
