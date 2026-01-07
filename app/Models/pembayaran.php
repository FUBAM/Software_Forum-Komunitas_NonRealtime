<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = [
        'user_id',
        'event_id',
        'amount',
        'proof_url',
        'status', // 'pending', 'confirmed', 'rejected'
        'verified_by',
        'rejection_reason'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Events::class);
    }

    // Admin yang melakukan verifikasi
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
