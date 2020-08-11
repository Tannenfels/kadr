<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * @var string
     */
    protected $table = 'comments';

    protected $with = ['user'];

    protected $fillable = ['text'];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
