<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grub extends Model
{
    protected $table = 'grup'; // Paksa ke tabel 'grup'

    protected $fillable = ['komunitas_id', 'nama', 'type', 'is_read_only'];

    protected $casts = [
        'is_read_only' => 'boolean',
    ];

    public function komunitas()
    {
        return $this->belongsTo(Komunitas::class, 'komunitas_id');
    }

    public function pesan_grup()
    {
        return $this->hasMany(PesanGrup::class, 'grup_id');
    }

    // Alias untuk konsistensi nama relasi pada controller
    public function pesan()
    {
        return $this->pesan_grup();
    }
}
