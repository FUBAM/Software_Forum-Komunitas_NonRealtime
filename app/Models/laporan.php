<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Events;
use App\Models\PesanGrup;
use App\Models\PesertaKegiatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'laporan';

    protected $fillable = [
        'pelapor_id',
        'tipe_target',
        'target_id',
        'alasan',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR: TARGET YANG DILAPORKAN
    |--------------------------------------------------------------------------
    | Relasi manual karena target bersifat dinamis
    */

    public function getTargetAttribute()
    {
        switch ($this->tipe_target) {
            case 'kegiatan':
                return Events::find($this->target_id);

            case 'pesan':
                return PesanGrup::find($this->target_id);

            case 'peserta':
                return PesertaKegiatan::find($this->target_id);

            default:
                return null;
        }
    }
}
