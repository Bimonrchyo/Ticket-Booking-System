<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    protected $table = 'transportasi';
    protected $fillable = ['tipe', 'nama_brand', 'fasilitas', 'kode_identitas', 'kapasitas', 'user_id'];
    protected $casts = [
        'fasilitas' => 'array', // Ini penting agar bisa langsung simpan array checkbox
    ];
    // Relasi: Satu kendaraan punya banyak jadwal
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}