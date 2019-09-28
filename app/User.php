<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return bool
     */
    public function isAdmin(User $user){
        return in_array('admin', explode(',', Auth::user()->user_groups));
    }

    public function isChiefEditor(){
        if (Auth::user() && in_array('admin', explode(',', Auth::user()->user_groups))){
            return true;
        }
        return in_array('chief_editor', explode(',', Auth::user()->user_groups));
    }

    public function isAuthor(){

    }

    public function isEditor(){

    }
}
