<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments_table';
    protected $primaryKey = 'comment_id';
    protected $foreignKey = 'post_id';
    protected $fillable = [
        'post_id',
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
