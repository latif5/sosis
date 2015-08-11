<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutboxMultipart extends Model
{
    protected $table = 'outbox_multipart';

    protected $primaryKey = 'ID';

    public $timestamps = false;
}
