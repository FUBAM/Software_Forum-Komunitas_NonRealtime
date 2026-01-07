<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class anggotaKomunitas extends Model
{
    protected $table = 'anggota_komunitas';
    
    // Karena tabel pivot ini punya ID sendiri (id_anggota), 
    // kita set incrementing = true.
    public $incrementing = true;

    protected $fillable = ['user_id', 'komunitas_id', 'role', 'joined_at'];

    // Jika ingin relasi balik ke User/Komunitas dari model pivot ini
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function komunitas() {
        return $this->belongsTo(Komunitas::class, 'komunitas_id');
    }
}
