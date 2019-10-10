<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $table = 'roles';

    /**
     * @var array
     */
    protected $with = ['users'];

    /**
     * @return BelongsToMany
     */
    public function users(){
        return $this->belongsToMany('App\User', 'roles_users', 'role_id', 'user_id');
    }
}
