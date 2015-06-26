<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentItem extends Model
{
    protected $table = 'sentitems';

    protected $primaryKey = 'ID';

    public $timestamps = false;
}
