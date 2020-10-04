<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 *
 * @package App
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $body
 * @property float $overall_rating
 * @property int $is_rated
 * @property int $is_free
 * @property int $is_locked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ArticleImage[] $articleImages
 * @property-read int|null $article_images_count
 * @property-read \App\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Rating[] $ratings
 * @property-read int|null $ratings_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereIsFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereIsLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereIsRated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereOverallRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereUserId($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id'];

    public function author() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function articleImages() {
        return $this->hasMany('App\ArticleImage');
    }

    public function ratings() {
        return $this->hasMany('App\Rating', 'article_id');
    }

    public function category() {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

}
