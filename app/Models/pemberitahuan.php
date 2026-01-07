<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pemberitahuan extends Model
{
    protected $table = 'pemberitahuan';
    protected $fillable = ['user_id', 'judul', 'pesan', 'is_read'];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}