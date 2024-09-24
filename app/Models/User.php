<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'avatar',
        'email',
        'password',
    ];

    protected function username(): Attribute
    {
        return Attribute::make(
            get: fn($value) => strtolower($value),
            set: fn($value) => strtolower($value),
        );
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn($value) => "/storage/avatars/{$value}",
        );
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'user_id');
    }

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_id');
    }

    public function feedPosts(): HasManyThrough
    {
        return $this->hasManyThrough(Post::class, Follow::class, 'user_id', 'user_id', 'id', 'following_id');
    }

    public function toSearchableArray()
    {
        return [
            'username' => $this->username,
            'email' => $this->email
        ];
    }
}
