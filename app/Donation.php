<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $table = 'donation';

    protected $primaryKey = 'ID';

    protected $fillable = [
        'tanggal',
        'ponsel',
        'jumlah',
        'tanggal_kirim',
        'pengirim',
        'keperluan',
        'keterangan',
        'status'
    ];
}