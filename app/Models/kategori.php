<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['nama', 'icon_url'];

    public function komunitas()
    {
        return $this->hasMany(komunitas::class, 'kategori_id');
    }

    public function events()
    {
        return $this->hasMany(events::class, 'kategori_id');
    }
}