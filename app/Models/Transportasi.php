<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    protected $table = 'transportasi';
    protected $fillable = ['tipe', 'nama_brand', 'fasilitas', 'kode_identitas', 'kapasitas', 'seat_layout', 'user_id'];
    protected $casts = [
        'fasilitas' => 'array',
        'seat_layout' => 'array',
    ];
    // Relasi: Satu kendaraan punya banyak jadwal
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}