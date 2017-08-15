<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class AdmSurat extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'adm_surat';
    protected $fillable = ['tanggal_pengirim_penerima','nomor_surat','tanggal_surat','pengirim_penerima','isi_surat','jenis', 'keterangan', 'penanggung_jawab_id'];
    protected $visible = ['id', 'tanggal_pengirim_penerima','nomor_surat','tanggal_surat','pengirim_penerima','isi_surat','jenis', 'keterangan', 'penanggung_jawab_id'];

}
