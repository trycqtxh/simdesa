<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PendudukIndukValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nik'               => 'required|unique:penduduk_induk,nik|digits:16|numeric',
            'nomor_kk'          => '',
            'nama'              => 'required|regex:/^[\pL\s\-]+$/u',
            'jenis_kelamin'     => 'required',
            'tempat_lahir'      => 'required|regex:/^[\pL\s\-]+$/u',
            'tanggal_lahir'     => 'required',
            'agama'             => 'required',
            'status_perkawinan' => 'required',
            'status_keluarga'   => 'required',
            'kewarga_negaraan'  => 'required',
            'pendidikan'        => 'required',
            'pekerjaan'         => 'required',
            'membaca'           => 'required',
            'alamat'            => 'required',
            'dusun'             => 'required',
            'rw'                => 'required',
            'rt'                => 'required',
            'keterangan'        => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nik'               => 'required',
            'no_kk'             => '',
            'nama'              => 'required|regex:/^[\pL\s\-]+$/u',
            'jenis_kelamin'     => 'required',
            'tempat_lahir'      => 'required|regex:/^[\pL\s\-]+$/u',
            'tanggal_lahir'     => 'required',
            'agama'             => 'required',
            'status_perkawinan' => 'required',
            'status_keluarga'   => 'required',
            'kewarga_negaraan'  => 'required',
            'pendidikan'        => 'required',
            'pekerjaan'         => 'required',
            'membaca'           => 'required',
            'alamat'            => 'required',
            'dusun'             => 'required',
            'rw'                => 'required',
            'rt'                => 'required',
            'keterangan'        => 'required',
        ],
   ];
}
