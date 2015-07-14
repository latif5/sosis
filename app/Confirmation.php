<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    protected $table = 'confirmation';

    protected $primaryKey = 'id';

    protected $fillable = [
        'tanggal',
        'ponsel',
        'santri',
        'kelas',
        'jumlah',
        'tanggal_kirim',
        'pengirim',
        'keperluan',
        'status'
    ];
}