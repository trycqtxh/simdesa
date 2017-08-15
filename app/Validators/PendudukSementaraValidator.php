<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PendudukSementaraValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nama'             => 'required|regex:/^[\pL\s\-]+$/u',
            'jenis_kelamin'    => 'required',
            'jenis_identitas'  => 'required',
            'no_identitas'     => 'required',
            'tempat_lahir'     => 'required|regex:/^[\pL\s\-]+$/u',
            'tanggal_lahir'    => 'required',
            'pekerjaan'        => 'required',
            'kewarga_negaraan' => 'required',
            'keturunan'        => 'required|regex:/^[\pL\s\-]+$/u',
            'datang_dari'      => 'required|regex:/^[\pL\s\-]+$/u',
            'maksud_tujuan'    => 'required',
            'alamat_tujuan'    => 'required',
            'tanggal_datang'   => 'required',
            'tanggal_pergi'    => 'required',
            'keterangan'       => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nama'             => 'required|regex:/^[\pL\s\-]+$/u',
            'jenis_kelamin'    => 'required',
            'jenis_identitas'  => 'required',
            'no_identitas'     => 'required',
            'tempat_lahir'     => 'required|regex:/^[\pL\s\-]+$/u',
            'tanggal_lahir'    => 'required',
            'pekerjaan'        => 'required',
            'kewarga_negaraan' => 'required|',
            'keturunan'        => 'required|regex:/^[\pL\s\-]+$/u',
            'datang_dari'      => 'required|regex:/^[\pL\s\-]+$/u',
            'maksud_tujuan'    => 'required',
            'alamat_tujuan'    => 'required',
            'tanggal_datang'   => 'required',
            'tanggal_pergi'    => 'required',
            'keterangan'       => 'required',
        ],
   ];
}
