<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'ponsel',
        'keterangan',
        'user_id'
    ];

    // Relasi many-to-many dengan tabel group
    public function group()
    {
        return $this->belongsToMany('App\Group', 'contact_group', 'contact_id', 'group_id');
    }
}
