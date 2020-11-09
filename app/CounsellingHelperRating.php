<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CounsellingHelperRating
 *
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingHelperRating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingHelperRating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingHelperRating query()
 * @mixin \Eloquent
 */
class CounsellingHelperRating extends Model
{
    protected $fillable = ['user_id', 'rating'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
