<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserCounsellingRecord
 *
 * @property-read \App\User $requestUser
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCounsellingRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCounsellingRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCounsellingRecord query()
 * @mixin \Eloquent
 */
class UserCounsellingRecord extends Model
{
    protected $fillable = ['applied_user_id', 'counselling_request_id', 'status'];

    public function requestUser() {
        return $this->belongsTo('App\User', 'applied_user_id', 'id');
    }
}
