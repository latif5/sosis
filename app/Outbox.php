<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outbox extends Model
{
    protected $table = 'outbox';

    protected $primaryKey = 'ID';

    public $timestamp = false;

    protected $fillable = [
        'SendBefore',
        'SendAfter',
        'DestinationNumber',
        'TextDecoded',
        'CreatorID'
    ];
}
