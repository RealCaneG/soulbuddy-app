<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserBalance
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBalance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBalance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBalance query()
 * @property int $id
 * @property int $user_id
 * @property float $balance
 * @property int $is_locked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBalance whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBalance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBalance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBalance whereIsLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBalance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBalance whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\User $owner
 */
class UserBalance extends Model
{
    protected $fillable = ['user_id', 'balance', 'is_locked', 'created_at', 'updated_at'];
    public function owner() {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
