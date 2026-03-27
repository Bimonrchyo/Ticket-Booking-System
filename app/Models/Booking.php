<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'pemesanan';

    protected $casts = [
        'expired_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'kode_booking',
        'user_id',
        'jadwal_id',
        'nomor_kursi',
        'nama_penumpang',
        'nik',
        'total_harga',
        'status',
        'qr_code_data',
        'expired_at'
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'pemesanan_id');
    }
}
