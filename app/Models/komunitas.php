<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class komunitas extends Model
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
        return $this->belongsTo(kota::class, 'kota_id');
    }

    public function category()
    {
        return $this->belongsTo(kategori::class, 'kategori_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'anggota_komunitas', 'komunitas_id', 'user_id')
            ->using(anggotaKomunitas::class)
            ->withPivot('role', 'joined_at');
    }

    public function moderators()
    {
        return $this->members()->wherePivot('role', 'moderator');
    }

    public function groups()
    {
        return $this->hasMany(grub::class, 'komunitas_id');
    }

    public function internalActivities()
    {
        return $this->hasMany(events::class, 'komunitas_id')->where('type', 'kegiatan');
    }
}