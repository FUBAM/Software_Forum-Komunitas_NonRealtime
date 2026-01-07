<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pesertaKegiatan extends Model
{
    protected $table = 'peserta_kegiatan';
    
    public $incrementing = true;

    protected $fillable = ['user_id', 'events_id', 'status', 'bukti_url', 'review_text'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event() {
        return $this->belongsTo(Events::class, 'events_id');
    }
}
