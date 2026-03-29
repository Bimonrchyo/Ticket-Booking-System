<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = [
        'pemesanan_id',
        'metode_bayar',
        'bukti_transfer',
        'nominal_bayar',
        'status',
        'payment_time',
        'verified_at'
    ];

    public const STATUS_UNPAID = 'unpaid';
    public const STATUS_PENDING = 'pending';
    public const STATUS_PAID = 'paid';
    public const STATUS_REJECTED = 'rejected';

    public static function availableStatuses(): array
    {
        return [
            self::STATUS_UNPAID,
            self::STATUS_PENDING,
            self::STATUS_PAID,
            self::STATUS_REJECTED,
        ];
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function pemesanan()
    {
        return $this->belongsTo(Booking::class, 'pemesanan_id');
    }
}

