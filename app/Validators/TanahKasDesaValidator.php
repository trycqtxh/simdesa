<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class TanahKasDesaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'asal_tanah' => 'required',
            'nomor_sertifikat' => 'required',
            'kelas' => 'required',
            'luas' => 'required',
            'perolehan_tkd' => 'required',
            'tanggal_perolehan' => 'required',
            'luas_peroleh_tkd' => 'required',
            'jenis_tkd' => 'required',
            'luas_jenis_tkd' => 'required',
            'luas_patok_ada' => 'required',
            'luas_patok_tidak_ada' => 'required',
            'luas_papan_nama_ada' => 'required',
            'luas_papan_nama_tidak_ada' => 'required',
            'lokasi' => 'required',
            'peruntukan' => 'required',
            'mutasi' => 'required',
            'keterangan' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'asal_tanah' => 'required',
            'nomor_sertifikat' => 'required',
            'kelas' => 'required',
            'luas' => 'required',
            'perolehan_tkd' => 'required',
            'luas_peroleh_tkd' => 'required',
            'tanggal_perolehan' => 'required',
            'jenis_tkd' => 'required',
            'luas_jenis_tkd' => 'required',
            'luas_patok_ada' => 'required',
            'luas_patok_tidak_ada' => 'required',
            'luas_papan_nama_ada' => 'required',
            'luas_papan_nama_tidak_ada' => 'required',
            'lokasi' => 'required',
            'peruntukan' => 'required',
            'mutasi' => 'required',
            'keterangan' => 'required',
        ],
   ];
}
