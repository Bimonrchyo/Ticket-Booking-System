<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    protected $table = 'transportasi';
    protected $fillable = ['tipe', 'nama_brand', 'kode_identitas', 'kapasitas', 'admin_id'];

    // Relasi: Satu kendaraan punya banyak jadwal
    public function jadwals() {
        return $this->hasMany(Jadwal::class);
    }
}