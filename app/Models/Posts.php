<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts_table';
    protected $primaryKey = 'post_id';
    protected $foreignKey = 'user_id';
    protected $fillable = [
        'user_id',
        'content',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }
}
