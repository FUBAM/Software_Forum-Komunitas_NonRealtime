<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Events;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesertaKegiatan extends Model
{
    protected $table = 'peserta_kegiatan';

    protected $fillable = [
        'user_id',
        'events_id',
        'status',
        'bukti_url',
        'review_text',
    ];

    /**
     * Tabel ini menggunakan created_at & updated_at
     * (default Laravel = true, ditulis eksplisit untuk kejelasan)
     */
    public $timestamps = true;

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Events::class, 'events_id');
    }
}
