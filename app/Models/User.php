<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'xp_terkini',
        'level_terkini',
        'skor_kepercayaan',
        'terpercaya',
        'foto_profil_url',
        'bio'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'terpercaya' => 'boolean',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function communities(): BelongsToMany
    {
        return $this->belongsToMany(komunitas::class, 'anggota_komunitas', 'user_id', 'komunitas_id')
            ->withPivot('role', 'joined_at')
            ->withTimestamps();
    }

    public function isModeratorOf($communityId): bool
    {
        return $this->communities()
            ->where('komunitas_id', $communityId)
            ->wherePivot('role', 'moderator')
            ->exists();
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(events::class, 'peserta_kegiatan', 'user_id', 'kegiatan_id')
            ->withPivot('status', 'bukti_url', 'review_text')
            ->withTimestamps();
    }

    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(badge::class, 'badge_user', 'user_id', 'badge_id')
            ->withPivot('earned_at');
    }
}