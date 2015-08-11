<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $table = 'inbox';

    protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $fillable = ['Processed'];
}
