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
 */
class CounsellingRequestRatingRecord extends Model
{
    protected $fillable = ['helper_id', 'client_id', 'rating'];

    public function user() {
        $this->belongsTo('App\User', 'helper_id', 'id');
    }
}
