<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
}
