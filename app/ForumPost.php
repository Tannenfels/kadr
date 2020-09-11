<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
