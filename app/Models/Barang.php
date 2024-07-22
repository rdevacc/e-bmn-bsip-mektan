<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_id',
        'uraian_id',
        'kode_barang',
        'nup',
        'nama',
        'tahun',
        'kuantitas',
        'lokasi',
        'nilai',
        'keterangan',
    ];

    /**
     * * Relationship Jenis Barang*
     */
    public function jenis(): BelongsTo
    {
        return $this->belongsTo(JenisBarang::class);
    }

    /**
     * * Relationship Uraian Barang*
     */
    public function uraian(): BelongsTo
    {
        return $this->belongsTo(UraianBarang::class);
    }
}
