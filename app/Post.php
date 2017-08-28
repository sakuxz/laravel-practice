<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title', 'type', 'content',
    ];

    public function auther() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function postType() {
        return $this->hasOne(PostType::class, 'id', 'type');
    }
}
