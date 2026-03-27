<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>E-Tiket - {{ $booking->kode_booking }}</title>
		<style>
			body {
				font-family: 'Arial', sans-serif;
				margin: 0;
				padding: 20px;
				background-color: #f8f9fa;
			}

			.ticket-container {
				max-width: 600px;
				margin: 0 auto;
				background: white;
				border-radius: 15px;
				box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
				overflow: hidden;
			}

			.ticket-header {
				background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
				color: white;
				padding: 30px;
				text-align: center;
			}

			.ticket-header h1 {
				margin: 0;
				font-size: 28px;
				font-weight: bold;
			}

			.ticket-header p {
				margin: 5px 0 0 0;
				opacity: 0.9;
				font-size: 14px;
			}

			.ticket-body {
				padding: 30px;
			}

			.booking-code {
				background: #f8f9fa;
				border: 2px dashed #dee2e6;
				border-radius: 10px;
				padding: 15px;
				text-align: center;
				margin-bottom: 25px;
			}

			.booking-code .code {
				font-size: 24px;
				font-weight: bold;
				color: #495057;
				letter-spacing: 2px;
			}

			.booking-code .label {
				font-size: 12px;
				color: #6c757d;
				text-transform: uppercase;
				letter-spacing: 1px;
			}

			.info-grid {
				display: grid;
				grid-template-columns: 1fr 1fr;
				gap: 20px;
				margin-bottom: 25px;
			}

			.info-item {
				background: #f8f9fa;
				padding: 15px;
				border-radius: 8px;
				border-left: 4px solid #667eea;
			}

			.info-item .label {
				font-size: 11px;
				color: #6c757d;
				text-transform: uppercase;
				letter-spacing: 0.5px;
				margin-bottom: 5px;
				font-weight: bold;
			}

			.info-item .value {
				font-size: 14px;
				color: #495057;
				font-weight: 600;
			}

			.route-info {
				background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
				color: white;
				padding: 20px;
				border-radius: 10px;
				margin-bottom: 25px;
				text-align: center;
			}

			.route-info .route {
				font-size: 20px;
				font-weight: bold;
				margin-bottom: 10px;
			}

			.route-info .details {
				font-size: 14px;
				opacity: 0.9;
			}

			.passenger-info {
				background: #fff3cd;
				border: 1px solid #ffeaa7;
				border-radius: 8px;
				padding: 15px;
				margin-bottom: 25px;
			}

			.passenger-info .label {
				font-size: 12px;
				color: #856404;
				text-transform: uppercase;
				letter-spacing: 0.5px;
				margin-bottom: 5px;
				font-weight: bold;
			}

			.passenger-info .value {
				font-size: 16px;
				color: #495057;
				font-weight: 600;
			}

			.qr-section {
				text-align: center;
				margin-bottom: 25px;
			}

			.qr-placeholder {
				width: 120px;
				height: 120px;
				background: #f8f9fa;
				border: 2px solid #dee2e6;
				border-radius: 8px;
				margin: 0 auto 10px;
				display: flex;
				align-items: center;
				justify-content: center;
				font-size: 12px;
				color: #6c757d;
			}

			.ticket-footer {
				background: #f8f9fa;
				padding: 20px;
				text-align: center;
				border-top: 1px solid #dee2e6;
			}

			.ticket-footer .note {
				font-size: 12px;
				color: #6c757d;
				margin-bottom: 10px;
			}

			.ticket-footer .validity {
				font-size: 11px;
				color: #dc3545;
				font-weight: bold;
			}

			.transport-icon {
				font-size: 18px;
				margin-right: 5px;
			}
		</style>
	</head>

	<body>
		<div class="ticket-container">
			<div class="ticket-header">
				<h1>🎫 E-TIKET PERJALANAN</h1>
				<p>HubTrans - Sistem Pemesanan Tiket Online</p>
			</div>

			<div class="ticket-body">
				<div class="booking-code">
					<div class="label">Kode Booking</div>
					<div class="code">{{ $booking->kode_booking }}</div>
				</div>

				<div class="route-info">
					<div class="route">
						{{ $booking->jadwal->asal->nama }} → {{ $booking->jadwal->tujuan->nama }}
					</div>
					<div class="details">
						@if ($booking->jadwal->transportasi->tipe === 'pesawat')
							✈️ {{ $booking->jadwal->transportasi->nama_brand }}
						@elseif($booking->jadwal->transportasi->tipe === 'kereta')
							🚂 {{ $booking->jadwal->transportasi->nama_brand }}
						@elseif($booking->jadwal->transportasi->tipe === 'bus')
							🚌 {{ $booking->jadwal->transportasi->nama_brand }}
						@else
							⛴️ {{ $booking->jadwal->transportasi->nama_brand }}
						@endif
						• {{ \Carbon\Carbon::parse($booking->jadwal->waktu_berangkat)->format('d/m/Y H:i') }}
					</div>
				</div>

				<div class="info-grid">
					<div class="info-item">
						<div class="label">Tanggal Keberangkatan</div>
						<div class="value">{{ \Carbon\Carbon::parse($booking->jadwal->waktu_berangkat)->format('d F Y') }}</div>
					</div>
					<div class="info-item">
						<div class="label">Waktu Keberangkatan</div>
						<div class="value">{{ \Carbon\Carbon::parse($booking->jadwal->waktu_berangkat)->format('H:i') }} WIB</div>
					</div>
					<div class="info-item">
						<div class="label">Nomor Kursi</div>
						<div class="value">{{ $booking->nomor_kursi }}</div>
					</div>
					<div class="info-item">
						<div class="label">Total Pembayaran</div>
						<div class="value">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</div>
					</div>
				</div>

				<div class="passenger-info">
					<div class="label">Nama Penumpang</div>
					<div class="value">{{ $booking->nama_penumpang }}</div>
				</div>

				<div class="qr-section">
					<div class="qr-placeholder">
						QR CODE<br />{{ $booking->qr_code_data }}
					</div>
					<div style="font-size: 11px; color: #6c757d; margin-top: 5px;">
						Tunjukkan kode QR ini saat check-in
					</div>
				</div>
			</div>

			<div class="ticket-footer">
				<div class="note">
					E-tiket ini merupakan bukti pembayaran yang sah. Harap simpan dan tunjukkan saat check-in.
				</div>
				<div class="validity">
					Berlaku sampai: {{ \Carbon\Carbon::parse($booking->jadwal->waktu_berangkat)->format('d F Y H:i') }} WIB
				</div>
			</div>
		</div>
	</body>

</html>
