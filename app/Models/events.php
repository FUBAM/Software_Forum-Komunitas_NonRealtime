<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    protected $fillable = [
        'kategori_id',
        'komunitas_id',
        'diusulkan_oleh',
        'type',
        'judul',
        'deskripsi',
        'berbayar',
        'harga',
        'poster_url',
        'status',
        'start_date'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'berbayar' => 'boolean',
        'harga' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(kategori::class, 'kategori_id');
    }

    public function community()
    {
        return $this->belongsTo(komunitas::class, 'komunitas_id');
    }

    public function proposer()
    {
        return $this->belongsTo(User::class, 'diusulkan_oleh');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'peserta_kegiatan', 'kegiatan_id', 'user_id')
            ->withPivot('status', 'bukti_url', 'review_text')
            ->withTimestamps();
    }
}