<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = ['title', 'content', 'author'];

    // Forumは複数のReplyを持つ
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
