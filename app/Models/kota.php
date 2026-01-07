<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kota extends Model
{
    protected $table = 'kota';
    protected $fillable = ['nama'];

    public function komunitas()
    {
        return $this->hasMany(komunitas::class, 'kota_id');
    }
}