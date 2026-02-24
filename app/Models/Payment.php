<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = ['pemesanan_id', 'metode_bayar', 'bukti_transfer', 'nominal_bayar', 'verified_at'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    public function pemesanan()
    {
        return $this->belongsTo(Booking::class, 'pemesanan_id');
    }
}
