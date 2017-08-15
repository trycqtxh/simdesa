<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PendudukMutasiValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nama'              => 'required|regex:/^[\pL\s\-]+$/u',
            'tempat_lahir'      => 'required|regex:/^[\pL\s\-]+$/u',
            'tanggal_lahir'     => 'required',
            'jenis_kelamin'     => 'required',
            'kewarga_negaraan'  => 'required',
            'nik'               => 'required|unique:penduduk_induk,nik|digits:16|numeric',
            'tanggal_datang'    => 'required',
            'jenis'             => 'required',
            'datang_dari'       => 'required|regex:/^[\pL\s\-]+$/u',
            'keterangan'        => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nama'              => 'required|regex:/^[\pL\s\-]+$/u',
            'tempat_lahir'      => 'required|regex:/^[\pL\s\-]+$/u',
            'tanggal_lahir'     => 'required',
            'jenis_kelamin'     => 'required',
            'kewarga_negaraan'  => 'required',
            'nik'               => 'required|unique:penduduk_induk,nik|digits:16|numeric',
            'tanggal_datang'    => 'required',
            'jenis'             => 'required',
            'datang_dari'       => 'required|regex:/^[\pL\s\-]+$/u',
            'keterangan'        => 'required'
        ],
   ];
}
