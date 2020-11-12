<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Notification
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $notification_type_id
 * @property int $is_read
 * @property int $is_deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereNotificationTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereUpdatedAt($value)
 * @property int $user_id
 * @property-read \App\User $owner
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereUserId($value)
 * @property int $from_user_id
 * @property int $payload_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification whereFromUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Notification wherePayloadId($value)
 */
class Notification extends Model
{
    protected $fillable = ['title', 'user_id', 'description', 'notification_type_id', 'is_read', 'is_deleted', 'from_user_id', 'payload_id'];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
