<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CounsellingRequestRatingRecord
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequestRatingRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequestRatingRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequestRatingRecord query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $helper_id
 * @property string $client_id
 * @property float $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequestRatingRecord whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequestRatingRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequestRatingRecord whereHelperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequestRatingRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequestRatingRecord whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequestRatingRecord whereUpdatedAt($value)
 */
class CounsellingRequestRatingRecord extends Model
{
    protected $fillable = ['helper_id', 'client_id', 'rating'];

    public function user() {
        $this->belongsTo('App\User', 'helper_id', 'id');
    }
}
