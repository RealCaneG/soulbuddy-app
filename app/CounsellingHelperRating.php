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
 * @property int $id
 * @property string $user_id
 * @property float $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingHelperRating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingHelperRating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingHelperRating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingHelperRating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingHelperRating whereUserId($value)
 */
class CounsellingHelperRating extends Model
{
    protected $fillable = ['user_id', 'rating'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
