<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = ['transportasi_id', 'titik_asal', 'titik_tujuan', 'waktu_berangkat', 'waktu_tiba', 'harga', 'info_lokasi', 'stok_tersedia'];

    public function transportasi()
    {
        return $this->belongsTo(Transportasi::class);
    }
}
