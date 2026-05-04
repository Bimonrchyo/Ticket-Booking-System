<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $booking->kode_booking }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f8f9fa; }
        .invoice-container { max-width: 700px; margin: 0 auto; background: white; border: 2px solid #ddd; }
        .invoice-header { background: #28a745; color: white; padding: 20px; text-align: center; }
        .invoice-header h1 { margin: 0; font-size: 24px; }
        .invoice-body { padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: bold; width: 30%; }
        .invoice-number { background: #f0f8ff; border: 2px solid #28a745; padding: 15px; text-align: center; margin: 15px 0; }
        .number { font-size: 22px; font-weight: bold; color: #28a745; }
        .booking-details { background: #e9ecef; padding: 15px; margin: 15px 0; }
        .payment-summary { background: #28a745; color: white; padding: 20px; text-align: center; margin: 15px 0; }
        .status-paid { background: #d4edda; color: #155724; padding: 5px 10px; border-radius: 10px; font-weight: bold; }
        .status-pending { background: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 10px; font-weight: bold; }
        .invoice-footer { background: #f8f9fa; padding: 15px; text-align: center; font-size: 12px; color: #666; }
        .payment-row { display: block; margin: 10px 0; }
        .payment-row.total { font-size: 18px; font-weight: bold; border-top: 2px solid white; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>INVOICE PEMBAYARAN [INVOICE]</h1>
            <p>PastiTravel</p>
        </div>

        <div class="invoice-body">
            <div class="invoice-number">
                <div style="font-size: 12px; color: #666; margin-bottom: 5px;">Nomor Invoice</div>
                <div class="number">{{ $booking->kode_booking }}</div>
            </div>

            <table>
                <tr><th>Nama</th><td>{{ $booking->user->name }}</td></tr>
                <tr><th>Email</th><td>{{ $booking->user->email }}</td></tr>
                <tr><th>NIK</th><td>{{ $booking->nik }}</td></tr>
            </table>

            <table>
                <tr><th>Metode Bayar</th><td>{{ $booking->payment->metode_bayar ?? 'Transfer Bank' }}</td></tr>
                <tr><th>Status</th><td>
                    @if ($booking->payment && $booking->payment->verified_at)
                        <span class="status-paid">Lunas</span>
                    @else
                        <span class="status-pending">Menunggu Verifikasi</span>
                    @endif
                </td></tr>
            </table>

            <div class="booking-details">
                <strong>Detail Pemesanan:</strong><br>
                Rute: {{ $booking->jadwal->asal->nama }} → {{ $booking->jadwal->tujuan->nama }}<br>
                Transportasi: {{ $booking->jadwal->transportasi->nama_brand }} ({{ ucfirst($booking->jadwal->transportasi->tipe) }})<br>
                Tanggal: {{ \Carbon\Carbon::parse($booking->jadwal->waktu_berangkat)->format('d F Y H:i') }}<br>
                Kursi: {{ $booking->nomor_kursi }}
            </div>

            <div class="payment-summary">
                <div style="font-size: 18px; font-weight: bold; margin-bottom: 15px;">Ringkasan Pembayaran</div>
                <div class="payment-row">Tiket {{ ucfirst($booking->jadwal->transportasi->tipe) }}</div>
                <div style="font-size: 16px;">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</div>
                <div class="payment-row total">
                    <span>Total Pembayaran</span> <span>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="invoice-footer">
            <div>Dicetak: {{ \Carbon\Carbon::now()->format('d F Y H:i') }} WIB</div>
            <div style="margin-top: 10px;">Simpan sebagai referensi pembayaran</div>
        </div>
    </div>
</body>
</html>

