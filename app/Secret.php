<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Secret
 *
 * @property int $id
 * @property string|null $description
 * @property int $user_id
 * @property string $title
 * @property string $body
 * @property string $category_id
 * @property float $price
 * @property float $overall_rating
 * @property int $is_rated
 * @property int $is_free
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Secret newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Secret newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Secret query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Secret whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Secret whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Secret whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Secret whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Secret whereIsFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Secret whereIsRated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Secret whereOverallRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Secret wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Secret whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Secret whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Secret whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Rating[] $ratings
 * @property-read int|null $ratings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserUnlockSecret[] $userUnlockSecret
 * @property-read int|null $user_unlock_secret_count
 */
class Secret extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'price', 'description', 'is_rated', 'is_free', 'overall_rating', 'user_id'];
    public function author() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function userUnlockSecret()
    {
        return $this->hasMany('App\UserUnlockSecret');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating', 'secret_id');
    }

    public function category() {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }
}
