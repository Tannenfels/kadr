<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ForumCategory extends Model
{
    /**
     * @return HasMany
     */
    public function threads()
    {
        return $this->hasMany('App\ForumThread');
    }
}
