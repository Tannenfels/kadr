<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CommentThread extends Model
{
    protected $fillable = ['text'];

    protected $with = ['comments', 'user'];

    public function comments()
    {
        return $this->hasMany('App\Comment', 'thread_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
