<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'content',
    ];

    public function author() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function post() {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
