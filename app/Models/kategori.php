<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['nama', 'icon_url'];

    public function komunitas()
    {
        return $this->hasMany(Komunitas::class, 'kategori_id');
    }

    public function events()
    {
        return $this->hasMany(Events::class, 'kategori_id');
    }
}