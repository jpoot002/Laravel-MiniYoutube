<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    protected $table = 'video';

    public function comments()
    {
        return $this->hasMany('App\Comments')->orderBy('id', 'desc');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
