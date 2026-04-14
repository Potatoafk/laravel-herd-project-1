<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Friendship;
use App\Models\Message;

class Users extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users_table';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'created_at',
        'password',
    ];

    // public function posts()
    // {
    //     return $this->hasMany(Posts::class, 'user_id', 'user_id');
    // }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id', 'user_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id', 'user_id');
    }

    public function sentFriendRequests()
    {
        return $this->hasMany(Friendship::class, 'requester_id', 'user_id');
    }

    public function receivedFriendRequests()
    {
        return $this->hasMany(Friendship::class, 'requested_id', 'user_id');
    }

    public function friends()
    {
        $sentFriendIds = $this->sentFriendRequests()->where('status', 'accepted')->pluck('requested_id');
        $receivedFriendIds = $this->receivedFriendRequests()->where('status', 'accepted')->pluck('requester_id');

        return self::whereIn('user_id', $sentFriendIds->merge($receivedFriendIds)->unique());
    }

    public function hasPendingFriendRequestWith(int $otherUserId): bool
    {
        return Friendship::where(function ($query) use ($otherUserId) {
            $query->where('requester_id', $this->user_id)
                ->where('requested_id', $otherUserId);
        })->orWhere(function ($query) use ($otherUserId) {
            $query->where('requester_id', $otherUserId)
                ->where('requested_id', $this->user_id);
        })->where('status', 'pending')->exists();
    }

    public function isFriendsWith(int $otherUserId): bool
    {
        return Friendship::where(function ($query) use ($otherUserId) {
            $query->where('requester_id', $this->user_id)
                ->where('requested_id', $otherUserId);
        })->orWhere(function ($query) use ($otherUserId) {
            $query->where('requester_id', $otherUserId)
                ->where('requested_id', $this->user_id);
        })->where('status', 'accepted')->exists();
    }
}
