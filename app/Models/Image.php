<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'title', 'path',
    ];

    protected static function boot()
    {
        parent::boot();

        parent::creating(function (self $image) {
            $image->user_id = $image->user_id ?: Auth::id();
        });
    }

    public function isAuthor(User $user): bool
    {
        return (int)$this->user_id === (int)$user->getKey();
    }

    public function likes()
    {
        return $this->morphToMany(Like::class, 'likeable');
    }
}
