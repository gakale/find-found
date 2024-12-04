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
        'status',
        // Champs pour les personnes disparues
        'person_name',
        'person_age',
        'person_gender',
        'person_height',
        'person_weight',
        'person_description',
        'last_seen_location',
        'last_seen_date',
        'distinctive_features',
        'clothes_worn',
        'is_urgent',
        'police_report_number'
    ];

    protected $casts = [
        'has_reward' => 'boolean',
        'reward_amount' => 'decimal:2',
        'views_count' => 'integer',
        'images' => 'array',
        'is_urgent' => 'boolean',
        'last_seen_date' => 'datetime',
        'person_age' => 'integer'
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

    public function isMissingPerson()
    {
        return $this->type === 'missing_person';
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            if (!in_array($post->type, ['lost', 'found', 'missing_person'])) {
                throw new \InvalidArgumentException('Invalid post type');
            }
        });
    }
}
