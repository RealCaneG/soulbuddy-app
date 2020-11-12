<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_type_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $articles
 * @property-read int|null $articles_count
 * @property-read \App\UserType|null $userType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserTypeId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Secret[] $secrets
 * @property-read int|null $secrets_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserUnlockSecret[] $unlockedSecrets
 * @property-read int|null $unlocked_secrets_count
 * @property-read \App\UserBalance|null $balance
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserTransaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SecretRating[] $secretRatings
 * @property-read int|null $secret_ratings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Message[] $messages
 * @property-read int|null $messages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Message[] $messagesReceived
 * @property-read int|null $messages_received_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Message[] $messagesSent
 * @property-read int|null $messages_sent_count
 * @property-read \App\UserBalance|null $userBalance
 * @property int $user_type
 * @property-read \App\CounsellingHelperRating|null $rating
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CounsellingRequestRatingRecord[] $ratingRecords
 * @property-read int|null $rating_records_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserType($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ApprovedUserChatContactRecord[] $contactList
 * @property-read int|null $contact_list_count
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var arrayØ
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rating()
    {
        return $this->hasOne('App\CounsellingHelperRating');
    }

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function userType()
    {
        return $this->hasOne('App\UserType');
    }

    public function unlockedSecrets()
    {
        return $this->hasMany('App\UserUnlockSecret');
    }

    public function userBalance()
    {
        return $this->hasOne('App\UserBalance');//FIXME
    }

    public function transactions()
    {
        return $this->hasMany('App\UserTransaction');
    }

    public function secrets()
    {
        return $this->hasMany('App\Secret');
    }

    public function secretRatings()
    {
        return $this->hasMany('App\SecretRating');
    }

    public function messagesSent() {
        return $this->hasMany('App\Message', 'user_id');
    }

    public function messagesReceived() {
        return $this->hasMany('App\Message', 'to_user_id');
    }

    public function ratingRecords() {
        return $this->hasMany('App\CounsellingRequestRatingRecord', 'helper_id');
    }

    public function contactList() {
        return $this->hasMany('App\ApprovedUserChatContactRecord');
    }
}
