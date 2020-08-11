<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'text', 'author', 'created_at', 'updated_at', 'deleted_at',
    ];

    /**
     * @var string
     */
    protected $table = 'articles';

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function commentThreads()
    {
        return $this->hasMany('App\CommentThreads');
    }
}
