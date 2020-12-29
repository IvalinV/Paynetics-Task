<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function client()
    {
        return $this->belongsTo('App\User', 'client_id');
    }
}
