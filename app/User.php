<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
     * @var string
     */
    protected $table = 'users';

    /**
     * @var array
     */
    protected $with = ['roles', 'currentBan'];

    /**
     * @param int $id
     * @return bool
     * @deprecated
     */
    public function isAdmin(){
        return in_array('admin', explode(',', Auth::user()->user_groups));
    }

    /**
     * @deprecated
     * @return bool
     */
    public function isChiefEditor(){
        if (Auth::user() && in_array('admin', explode(',', Auth::user()->user_groups))){
            return true;
        }
        return in_array('chief_editor', explode(',', Auth::user()->user_groups));
    }

    /**
     * @return bool
     */
    public function isBanned(){
        $ban = Ban::findOrFail($this->id);

        if ((empty($ban) || (Carbon::createFromTimeString($ban->expires)->greaterThanOrEqualTo(Carbon::now()) && $ban->expires === 0))) {
            return false;
        } elseif ($ban->is_permanent === 1 || Carbon::createFromTimeString($ban->expires)->lessThan(Carbon::now())) {
            return true;
        }
        return false;
    }

    /**
     * @return BelongsToMany
     */
    public function roles(){
        return $this->belongsToMany('App\Role', 'roles_users', 'user_id', 'role_id');
    }

    /**
     * @return HasMany
     */
    public function currentBan(){
        return $this->hasMany('App\Ban')->whereTime('expires', '>', Carbon::now())->orWhere('is_permanent', 1);
    }

    /**
     * @return HasOne
     */
    public function profile()
    {
        return $this->hasOne('App\Profile', 'user_id', 'id');
    }
}
