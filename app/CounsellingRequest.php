<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CounsellingRequest
 *
 * @property int $id
 * @property int $category_id
 * @property string $expiry_date
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Category|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequest whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequest whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequest whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $is_closed
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequest whereIsClosed($value)
 * @property int $maker_id
 * @property int $solver_id
 * @property string $time_solved
 * @property-read \App\User $owner
 * @property-read \App\User $solver
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequest whereMakerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequest whereSolverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequest whereTimeSolved($value)
 * @property string $subject
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CounsellingRequest whereSubject($value)
 */
class CounsellingRequest extends Model
{
    protected $fillable = ['subject', 'category_id', 'expiry_date', 'description', 'maker_id', 'solver_id', 'time_solved', 'is_closed'];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'maker_id', 'id');
    }

    public function solver()
    {
        return $this->belongsTo('App\User', 'solver_id', 'id');
    }
}
