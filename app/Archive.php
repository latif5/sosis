<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $table = 'archives';

    protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $fillable = [
        'SendingDateTime',
        'DestinationNumber',
        'Class',
        'TextDecoded',
        'CreatorID'
    ];

}
