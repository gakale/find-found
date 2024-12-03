<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'location',
        'contact_phone',
        'contact_email',
        'has_reward',
        'reward_amount',
        'images',
        'user_id',
        'status'
    ];

    protected $casts = [
        'has_reward' => 'boolean',
        'reward_amount' => 'decimal:2',
        'views_count' => 'integer',
        'images' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
}
