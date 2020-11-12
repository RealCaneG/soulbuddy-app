<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ApprovedUserChatContactRecord
 *
 * @property int $id
 * @property int $user_id
 * @property int $contact_user_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovedUserChatContactRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovedUserChatContactRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovedUserChatContactRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovedUserChatContactRecord whereContactUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovedUserChatContactRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovedUserChatContactRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovedUserChatContactRecord whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovedUserChatContactRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApprovedUserChatContactRecord whereUserId($value)
 * @mixin \Eloquent
 */
class ApprovedUserChatContactRecord extends Model
{
    protected $fillable = ['user_id', 'contact_user_id', 'status'];

    public function owner() {
        return $this->belongsTo('App\User');
    }

    public function contactUser() {
        return $this->belongsTo('App\User', 'contact_user_id', 'id');
    }
}
