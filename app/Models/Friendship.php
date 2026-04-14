<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    protected $table = 'friendships_table';
    protected $primaryKey = 'friendship_id';
    protected $fillable = [
        'requester_id',
        'requested_id',
        'status',
    ];

    public function requester()
    {
        return $this->belongsTo(Users::class, 'requester_id', 'user_id');
    }

    public function requested()
    {
        return $this->belongsTo(Users::class, 'requested_id', 'user_id');
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isAccepted(): bool
    {
        return $this->status === 'accepted';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
