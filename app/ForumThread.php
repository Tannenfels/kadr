<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ForumThread extends Model
{
    /**
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\ForumPost');
    }
}
