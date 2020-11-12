<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NotificationType
 *
 * @property int $id
 * @property string $type
 * @property int $is_valid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationType whereIsValid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NotificationType extends Model
{
    protected $fillable = ['type'];
}
