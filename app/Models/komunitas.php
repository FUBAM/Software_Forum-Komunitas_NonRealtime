<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AnggotaKomunitas;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $members
 * @uses \App\Models\AnggotaKomunitas
 */
class Komunitas extends Model
{
    protected $table = 'komunitas';

    protected $fillable = [
        'kota_id',
        'kategori_id',
        'pembuat_id',
        'nama',
        'deskripsi',
        'icon_url'
    ];

    public function city()
    {
        return $this->belongsTo(Kota::class, 'kota_id');
    }

    public function category()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'anggota_komunitas', 'komunitas_id', 'user_id')
            ->using('App\\Models\\AnggotaKomunitas')
            ->withPivot('role', 'joined_at');
    }

    public function moderators()
    {
        return $this->members()->wherePivot('role', 'moderator');
    }

    public function groups()
    {
        return $this->hasMany(Grub::class, 'komunitas_id');
    }

    public function internalActivities()
    {
        return $this->hasMany(Events::class, 'komunitas_id')->where('type', 'kegiatan');
    }

    // Aliases for Indonesian relation names used in controllers/views
    public function kota()
    {
        return $this->city();
    }

    public function kategori()
    {
        return $this->category();
    }

    public function grup()
    {
        return $this->groups();
    }

    public function anggota()
    {
        return $this->members();
    }
}