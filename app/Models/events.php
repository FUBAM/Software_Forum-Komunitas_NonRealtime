<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read \App\Models\User $pengusul
 * @property-read \App\Models\Komunitas|null $komunitas
 * @property-read \App\Models\Kategori $kategori
 */
class Events extends Model
{
    protected $table = 'events';
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
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function community()
    {
        return $this->belongsTo(Komunitas::class, 'komunitas_id');
    }

    public function proposer()
    {
        return $this->belongsTo(User::class, 'diusulkan_oleh');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'peserta_kegiatan', 'events_id', 'user_id')
            ->using(PesertaKegiatan::class)
            ->withPivot('status', 'bukti_url', 'review_text')
            ->withTimestamps();
    }

    // Aliases for Indonesian relation names used by controllers/views
    public function pengusul()
    {
        return $this->proposer();
    }

    public function komunitas()
    {
        return $this->community();
    }

    public function kategori()
    {
        return $this->category();
    }
}
