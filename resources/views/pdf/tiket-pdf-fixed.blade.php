<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Tiket - {{ $booking->kode_booking }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f8f9fa; }
        .ticket-container { max-width: 600px; margin: 0 auto; background: white; border: 2px solid #ddd; }
        .ticket-header { background: #667eea; color: white; padding: 20px; text-align: center; }
        .ticket-header h1 { margin: 0; font-size: 24px; }
        .ticket-body { padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: bold; width: 30%; }
        .booking-code { background: #f0f8ff; border: 2px dashed #667eea; padding: 15px; text-align: center; margin: 15px 0; }
        .code { font-size: 22px; font-weight: bold; color: #333; }
        .route-info { background: #667eea; color: white; padding: 15px; text-align: center; margin: 15px 0; }
        .passenger-info { background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; margin: 15px 0; }
        .qr-placeholder { width: 100px; height: 100px; background: #f8f9fa; border: 2px solid #ddd; margin: 10px auto; text-align: center; padding: 20px 10px; font-size: 12px; }
        .ticket-footer { background: #f8f9fa; padding: 15px; text-align: center; font-size: 12px; color: #666; }
        .validity { color: #d32f2f; font-weight: bold; }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="ticket-header">
            <h1>E-TIKET PERJALANAN</h1>
            <p>PastiTravel</p>
        </div>

        <div class="ticket-body">
            <div class="booking-code">
                <div style="font-size: 12px; color: #666; margin-bottom: 5px;">Kode Booking</div>
                <div class="code">{{ $booking->kode_booking }}</div>
            </div>

            <div class="route-info">
                <div style="font-size: 18px; font-weight: bold;">{{ $booking->jadwal->asal->nama }} → {{ $booking->jadwal->tujuan->nama }}</div>
                <div>{{ $booking->jadwal->transportasi->nama_brand }} - {{ \Carbon\Carbon::parse($booking->jadwal->waktu_berangkat)->format('d/m/Y H:i') }}</div>
            </div>

            <table>
                <tr><th>Tanggal</th><td>{{ \Carbon\Carbon::parse($booking->jadwal->waktu_berangkat)->format('d F Y') }}</td></tr>
                <tr><th>Waktu</th><td>{{ \Carbon\Carbon::parse($booking->jadwal->waktu_berangkat)->format('H:i') }} WIB</td></tr>
                <tr><th>Kursi</th><td>{{ $booking->nomor_kursi }}</td></tr>
                <tr><th>Total</th><td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td></tr>
            </table>

            <div class="passenger-info">
                <strong>Nama Penumpang:</strong> {{ $booking->nama_penumpang }}
            </div>

            <div style="text-align: center; margin: 20px 0;">
                <div class="qr-placeholder">QR CODE<br>{{ $booking->qr_code_data }}</div>
                <div style="font-size: 12px; margin-top: 5px;">Tunjukkan saat check-in</div>
            </div>
        </div>

        <div class="ticket-footer">
            <div>Bukti pembayaran sah. Berlaku sampai: <span class="validity">{{ \Carbon\Carbon::parse($booking->jadwal->waktu_berangkat)->format('d F Y H:i') }} WIB</span></div>
        </div>
    </div>
</body>
</html>

