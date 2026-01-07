<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = ['pelapor_id', 'tipe_target', 'target_id', 'alasan', 'status'];

    public function pelapor()
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }

    // Karena di migration pakai ENUM, relasi target dilakukan manual di Controller
    public function getTargetAttribute()
    {
        if ($this->tipe_target === 'kegiatan') return events::find($this->target_id);
        if ($this->tipe_target === 'pesan') return pesanGrup::find($this->target_id);
        return null;
    }
}