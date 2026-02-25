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
    public function asal()
    {
        return $this->belongsTo(Lokasi::class, 'asal_id');
    }

    public function tujuan()
    {
        return $this->belongsTo(Lokasi::class, 'tujuan_id');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'jadwal_id');
    }
    public function getDurasiAttribute()
    {
        $berangkat = \Carbon\Carbon::parse($this->waktu_berangkat);
        $tiba = \Carbon\Carbon::parse($this->waktu_tiba);
        $menit = $berangkat->diffInMinutes($tiba);

        $jam = floor($menit / 60);
        $sisa = $menit % 60;

        return "{$jam}j {$sisa}m";
    }
}