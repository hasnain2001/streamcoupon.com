<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

        public function getAvatarUrlAttribute()
    {
        if (empty($this->avatar)) {
            return asset('assets/img/no-image-found.png');
        }

        // Using Laravel's public disk (storage/app/public/avatars/)
        if (Storage::disk('public')->exists('storage/avatars/' . $this->avatar)) {
            return Storage::disk('public')->url('storage/avatars/' . $this->avatar);
        }

        // Fallback: maybe you stored directly in public/avatars/ (without symlink)
        if (file_exists(public_path('storage/avatars/' . $this->avatar))) {
            return asset('storage/avatars/' . $this->avatar);
        }

        return asset('assets/img/no-image-found.png');
    }
     protected static function booted()
    {
        static::deleting(function ($user) {
            $folder = "avatars/{$user->id}";
            if (Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->deleteDirectory($folder);
            }
        });
    }
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

}
