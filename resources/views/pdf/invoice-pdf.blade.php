<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Invoice - {{ $booking->kode_booking }}</title>
		<style>
			body {
				font-family: 'Arial', sans-serif;
				margin: 0;
				padding: 20px;
				background-color: #f8f9fa;
			}

			.invoice-container {
				max-width: 700px;
				margin: 0 auto;
				background: white;
				border-radius: 15px;
				box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
				overflow: hidden;
			}

			.invoice-header {
				background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
				color: white;
				padding: 30px;
				text-align: center;
			}

			.invoice-header h1 {
				margin: 0;
				font-size: 28px;
				font-weight: bold;
			}

			.invoice-header p {
				margin: 5px 0 0 0;
				opacity: 0.9;
				font-size: 14px;
			}

			.invoice-body {
				padding: 30px;
			}

			.invoice-number {
				background: #f8f9fa;
				border: 2px solid #28a745;
				border-radius: 10px;
				padding: 15px;
				text-align: center;
				margin-bottom: 25px;
			}

			.invoice-number .number {
				font-size: 24px;
				font-weight: bold;
				color: #28a745;
				letter-spacing: 2px;
			}

			.invoice-number .label {
				font-size: 12px;
				color: #6c757d;
				text-transform: uppercase;
				letter-spacing: 1px;
			}

			.info-section {
				display: grid;
				grid-template-columns: 1fr 1fr;
				gap: 20px;
				margin-bottom: 25px;
			}

			.info-box {
				background: #f8f9fa;
				padding: 20px;
				border-radius: 8px;
				border-left: 4px solid #28a745;
			}

			.info-box .title {
				font-size: 14px;
				color: #495057;
				font-weight: bold;
				margin-bottom: 10px;
				text-transform: uppercase;
				letter-spacing: 0.5px;
			}

			.info-box .detail {
				margin-bottom: 8px;
			}

			.info-box .label {
				font-size: 11px;
				color: #6c757d;
				text-transform: uppercase;
				letter-spacing: 0.5px;
				font-weight: bold;
			}

			.info-box .value {
				font-size: 13px;
				color: #495057;
				font-weight: 600;
			}

			.booking-details {
				background: #e9ecef;
				border-radius: 10px;
				padding: 20px;
				margin-bottom: 25px;
			}

			.booking-details .title {
				font-size: 16px;
				color: #495057;
				font-weight: bold;
				margin-bottom: 15px;
				text-align: center;
			}

			.payment-summary {
				background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
				color: white;
				padding: 25px;
				border-radius: 10px;
				margin-bottom: 25px;
			}

			.payment-summary .title {
				font-size: 18px;
				font-weight: bold;
				text-align: center;
				margin-bottom: 20px;
			}

			.payment-row {
				display: flex;
				justify-content: space-between;
				align-items: center;
				margin-bottom: 10px;
			}

			.payment-row.total {
				border-top: 2px solid rgba(255, 255, 255, 0.3);
				padding-top: 15px;
				margin-top: 15px;
				font-size: 18px;
				font-weight: bold;
			}

			.status-badge {
				display: inline-block;
				padding: 8px 16px;
				border-radius: 20px;
				font-size: 12px;
				font-weight: bold;
				text-transform: uppercase;
				letter-spacing: 0.5px;
			}

			.status-paid {
				background: #d4edda;
				color: #155724;
			}

			.status-pending {
				background: #fff3cd;
				color: #856404;
			}

			.invoice-footer {
				background: #f8f9fa;
				padding: 20px;
				text-align: center;
				border-top: 1px solid #dee2e6;
			}

			.invoice-footer .note {
				font-size: 12px;
				color: #6c757d;
				margin-bottom: 10px;
			}

			.invoice-footer .date {
				font-size: 11px;
				color: #495057;
				font-weight: bold;
			}
		</style>
	</head>

	<body>
		<div class="invoice-container">
			<div class="invoice-header">
				<h1>🧾 INVOICE PEMBAYARAN</h1>
				<p>PastiTravel - Sistem Pemesanan Tiket Online</p>
			</div>

			<div class="invoice-body">
				<div class="invoice-number">
					<div class="label">Nomor Invoice</div>
					<div class="number">{{ $booking->kode_booking }}</div>
				</div>

				<div class="info-section">
					<div class="info-box">
						<div class="title">Informasi Pelanggan</div>
						<div class="detail">
							<div class="label">Nama</div>
							<div class="value">{{ $booking->user->name }}</div>
						</div>
						<div class="detail">
							<div class="label">Email</div>
							<div class="value">{{ $booking->user->email }}</div>
						</div>
						<div class="detail">
							<div class="label">NIK</div>
							<div class="value">{{ $booking->nik }}</div>
						</div>
					</div>

					<div class="info-box">
						<div class="title">Informasi Pembayaran</div>
						<div class="detail">
							<div class="label">Metode Pembayaran</div>
							<div class="value">{{ $booking->payment->metode_bayar ?? 'Transfer Bank' }}</div>
						</div>
						<div class="detail">
							<div class="label">Status Pembayaran</div>
							<div class="value">
								@if ($booking->payment && $booking->payment->verified_at)
									<span class="status-badge status-paid">Lunas</span>
								@else
									<span class="status-badge status-pending">Menunggu Verifikasi</span>
								@endif
							</div>
						</div>
						<div class="detail">
							<div class="label">Tanggal Pembayaran</div>
							<div class="value">
								{{ $booking->payment ? \Carbon\Carbon::parse($booking->payment->created_at)->format('d F Y H:i') : '-' }}</div>
						</div>
					</div>
				</div>

				<div class="booking-details">
					<div class="title">Detail Pemesanan Tiket</div>

					<div class="info-section">
						<div class="info-box">
							<div class="detail">
								<div class="label">Rute Perjalanan</div>
								<div class="value">{{ $booking->jadwal->asal->nama }} → {{ $booking->jadwal->tujuan->nama }}</div>
							</div>
							<div class="detail">
								<div class="label">Transportasi</div>
								<div class="value">
									@if ($booking->jadwal->transportasi->tipe === 'pesawat')
										✈️ {{ $booking->jadwal->transportasi->nama_brand }}
									@elseif($booking->jadwal->transportasi->tipe === 'kereta')
										🚂 {{ $booking->jadwal->transportasi->nama_brand }}
									@elseif($booking->jadwal->transportasi->tipe === 'bus')
										🚌 {{ $booking->jadwal->transportasi->nama_brand }}
									@else
										⛴️ {{ $booking->jadwal->transportasi->nama_brand }}
									@endif
								</div>
							</div>
							<div class="detail">
								<div class="label">Kode Identitas</div>
								<div class="value">{{ $booking->jadwal->transportasi->kode_identitas }}</div>
							</div>
						</div>

						<div class="info-box">
							<div class="detail">
								<div class="label">Tanggal Keberangkatan</div>
								<div class="value">{{ \Carbon\Carbon::parse($booking->jadwal->waktu_berangkat)->format('d F Y') }}</div>
							</div>
							<div class="detail">
								<div class="label">Waktu Keberangkatan</div>
								<div class="value">{{ \Carbon\Carbon::parse($booking->jadwal->waktu_berangkat)->format('H:i') }} WIB</div>
							</div>
							<div class="detail">
								<div class="label">Nomor Kursi</div>
								<div class="value">{{ $booking->nomor_kursi }}</div>
							</div>
						</div>
					</div>
				</div>

				<div class="payment-summary">
					<div class="title">Ringkasan Pembayaran</div>

					<div class="payment-row">
						<span>Tiket {{ ucfirst($booking->jadwal->transportasi->tipe) }}</span>
						<span>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
					</div>

					<div class="payment-row total">
						<span>Total Pembayaran</span>
						<span>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
					</div>
				</div>
			</div>

			<div class="invoice-footer">
				<div class="note">
					Invoice ini merupakan bukti pembayaran yang sah untuk pemesanan tiket PastiTravel.
					Simpan invoice ini sebagai referensi pembayaran Anda.
				</div>
				<div class="date">
					Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }} WIB
				</div>
			</div>
		</div>
	</body>

</html>
