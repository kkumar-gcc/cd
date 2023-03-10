<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use QCod\Gamify\Gamify;
use Spatie\Permission\Traits\HasRoles;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, HasFactory, HasRoles, HasSEO, Gamify;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'username',
        'first_name',
        'last_name',
        'password',
        'about_me',
        'short_bio',
        'profile_image',
        'background_image',
        "website_url",
        'twitter_url',
        'github_url',
        'facebook_url'
    ];
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function id(): int
    {
        return $this->id;
    }
    public function emailAddress(): string
    {
        return $this->email;
    }
    public function firstName(): ?string
    {
        return $this->first_name;
    }
    public function lastName(): ?string
    {
        return $this->last_name;
    }

    public function username(): string
    {
        return $this->username;
    }
    public function shortBio(): ?string
    {
        return $this->short_bio;
    }
    public function aboutMe()
    {
        return $this->about_me;
    }
    public function location(): ?string
    {
        return $this->location;
    }
    public function twitterUrl(): ?string
    {
        return $this->twitter_url;
    }
    public function websiteUrl(): ?string
    {
        return $this->website_url;
    }
    public function isBanned(): bool
    {
        return !is_null($this->banned_at);
    }
    public function isLoggedInUser(): bool
    {
        return $this->id() === Auth::id();
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    public function funs()
    {
        return $this->hasMany(Fun::class);
    }
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }
    // public function friendships()
    // {
    //     return $this->hasMany(Friendship::class);
    // }
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
    public function pins()
    {
        return $this->hasMany(BlogPin::class);
    }
    public function backgroundImage(): string
    {
        return $this->background_image ?? 'https://live.staticflickr.com/65535/52391254003_99ade44739_h.jpg';
    }
    public function avatarUrl(): string
    {
        return $this->profile_image ?? 'https://www.gravatar.com/avatar/' . md5(Str::lower(trim('krishkumar9352@gmail.com')));
    }

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->username,
            image: $this->avatarUrl(),
            description: $this->shortBio(),
            author: $this->username,
        );
    }
}
