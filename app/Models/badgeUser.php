<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadgeUser extends Model
{
    protected $table = 'badge_user';

    public $incrementing = true;

    protected $fillable = ['user_id', 'badge_id', 'earned_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function badge()
    {
        return $this->belongsTo(Badge::class, 'badge_id');
    }
}
