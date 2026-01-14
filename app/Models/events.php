<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read \App\Models\User $pengusul
 * @property-read \App\Models\Komunitas|null $komunitas
 * @property-read \App\Models\Kategori $kategori
 *
 * @property-read string $jenis
 * @property-read bool $is_berbayar
 * @property-read string|null $poster
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
        'start_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'berbayar'   => 'boolean',
        'harga'      => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS (ADAPTER UNTUK BLADE & CONTROLLER)
    |--------------------------------------------------------------------------
    */

    // Untuk Blade: $event->jenis
    public function getJenisAttribute(): string
    {
        return $this->type;
    }

    // Untuk Blade: $event->is_berbayar
    public function getIsBerbayarAttribute(): bool
    {
        return (bool) $this->berbayar;
    }

    // Untuk Blade: $event->poster
    public function getPosterAttribute(): ?string
    {
        return $this->poster_url;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS (ENGLISH)
    |--------------------------------------------------------------------------
    */

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
        return $this->belongsToMany(
            User::class,
            'peserta_kegiatan',
            'events_id',
            'user_id'
        )
        ->using(PesertaKegiatan::class)
        ->withPivot('status', 'bukti_url', 'review_text')
        ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS (INDONESIAN ALIAS)
    |--------------------------------------------------------------------------
    */

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
