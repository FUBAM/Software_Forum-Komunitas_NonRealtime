<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $table = 'badge';
    protected $fillable = ['nama', 'image_url', 'deskripsi', 'xp_bonus'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'badge_user', 'badge_id', 'user_id')
            ->withPivot('earned_at');
    }
}