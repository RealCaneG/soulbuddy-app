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
 * @property int $id
 * @property int $applied_user_id
 * @property int $counselling_request_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $userRequested
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCounsellingRecord whereAppliedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCounsellingRecord whereCounsellingRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCounsellingRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCounsellingRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCounsellingRecord whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCounsellingRecord whereUpdatedAt($value)
 */
class UserCounsellingRecord extends Model
{
    protected $fillable = ['applied_user_id', 'counselling_request_id', 'status'];

    public function userRequested() {
        return $this->belongsTo('App\User', 'applied_user_id', 'id');
    }
}
