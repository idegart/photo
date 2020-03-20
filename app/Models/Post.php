<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'text'
    ];

    protected static function boot()
    {
        parent::boot();

        parent::creating(function (self $post) {
            $post->user_id = $post->user_id ?: Auth::id();
        });
    }

    public function isAuthor(User $user): bool
    {
        return (int)$this->user_id === (int)$user->getKey();
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
