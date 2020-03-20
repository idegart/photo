<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'likeable_id',
        'likeable_type',
    ];

    protected static function boot()
    {
        parent::boot();

        parent::creating(function (self $like) {
            $like->user_id = $like->user_id ?: Auth::id();
        });
    }

    public function likeable()
    {
        return $this->morphTo();
    }

    public function isAuthor(User $user): bool
    {
        return (int)$this->user_id === (int)$user->getKey();
    }
}
