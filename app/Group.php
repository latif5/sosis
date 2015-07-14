<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'group';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'keterangan',
        'user_id'
    ];

    public function contact()
    {
        return $this->belongsToMany('App\Contact', 'contact_group', 'group_id', 'contact_id');
    }
}
