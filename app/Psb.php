<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Psb extends Model
{
    protected $table = 'psb';

    protected $primaryKey = 'id';

    protected $fillable = [
        'tanggal',
        'ponsel',
        'santri',
        'jenjang',
        'no_pendaftaran',
        'jumlah',
        'tanggal_kirim',
        'pengirim',
        'keperluan',
        'status'
    ];
}
