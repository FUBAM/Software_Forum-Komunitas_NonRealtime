<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'kota';
    protected $fillable = ['nama'];

    public function komunitas()
    {
        return $this->hasMany(Komunitas::class, 'kota_id');
    }
}
