<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $table = 'inbox';

    protected $primaryKey = 'ID';

    public $timestamp = false;

    protected $fillable = ['Processed'];
}
