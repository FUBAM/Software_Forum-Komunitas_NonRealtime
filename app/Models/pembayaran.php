<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = [
        'user_id',
        'events_id',
        'jumlah_bayar',
        'bukti_url',
        'status', // 'pending', 'lunas', 'ditolak'
        'diverifikasi_oleh',
        'alasan_penolakan'
    ];

    protected $casts = [
        'jumlah_bayar' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event()
    {
        return $this->belongsTo(Events::class, 'events_id');
    }

    // Admin yang melakukan verifikasi
    public function verifier()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }
}
