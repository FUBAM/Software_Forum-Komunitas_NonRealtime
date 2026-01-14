<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Events;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'user_id',
        'events_id',
        'jumlah_bayar',
        'bukti_url',
        'status', // pending, lunas, ditolak
        'diverifikasi_oleh',
        'alasan_penolakan',
    ];

    protected $casts = [
        'jumlah_bayar' => 'decimal:2',
    ];

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

    /**
     * Admin yang memverifikasi pembayaran
     */
    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }
}
