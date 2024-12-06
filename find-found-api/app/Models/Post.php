<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\View;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
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

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function isLikedByUser($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function addView()
    {
        $ip = request()->ip();
        $userAgent = request()->userAgent();
        $userId = auth()->id();

        // Vérifie si l'utilisateur ou l'IP a déjà vu le post aujourd'hui
        $view = $this->views()
            ->where(function ($query) use ($ip, $userId) {
                $query->where('ip_address', $ip)
                    ->orWhere('user_id', $userId);
            })
            ->whereDate('created_at', today())
            ->first();

        if (!$view) {
            $this->views()->create([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'user_id' => $userId,
            ]);

            // Incrémente le compteur de vues
            $this->increment('views_count');
        }
    }

    public function isMissingPerson()
    {
        return $this->type === 'missing_person';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
                
                // Vérifier si le slug existe déjà
                $count = 2;
                while (static::where('slug', $post->slug)->exists()) {
                    $post->slug = Str::slug($post->title) . '-' . $count;
                    $count++;
                }
            }
        });

        static::saving(function ($post) {
            if (!in_array($post->type, ['lost', 'found', 'missing_person'])) {
                throw new \InvalidArgumentException('Invalid post type');
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
