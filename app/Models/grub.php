<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class grub extends Model
{
    protected $table = 'grup'; // Paksa ke tabel 'grup'

    protected $fillable = ['komunitas_id', 'nama', 'type', 'is_read_only'];

    protected $casts = [
        'is_read_only' => 'boolean',
    ];

    public function komunitas()
    {
        return $this->belongsTo(komunitas::class, 'komunitas_id');
    }

    public function pesan_grup()
    {
        return $this->hasMany(pesanGrup::class, 'grup_id');
    }
}