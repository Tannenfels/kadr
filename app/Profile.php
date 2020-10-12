<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    protected $table = 'user_profiles';

    /**
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    /**
     * @param int $userId
     * @return bool
     */
    public static function createNewProfile(int $userId)
    {
        $profile = new self;
        $profile->user_id = $userId;

        $profile->save();

        return true;
    }
}
