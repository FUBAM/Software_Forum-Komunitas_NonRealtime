<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pesanGrup extends Model
{
    protected $table = 'pesan_grup';

    protected $fillable = ['grup_id', 'user_id', 'pesan', 'lampiran_url', 'is_pinned'];

    protected $casts = [
        'is_pinned' => 'boolean',
    ];

    public function grub()
    {
        return $this->belongsTo(grub::class, 'grup_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}