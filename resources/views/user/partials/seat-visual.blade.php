@php
    $seatLayout = $jadwal->transportasi->seat_layout ?? ['seats_per_row' => 4];
    $kapasitas = $jadwal->transportasi->kapasitas;
    $tipe = strtolower($jadwal->transportasi->tipe);
    $jumlahBaris = ceil($kapasitas / $seatLayout['seats_per_row']);
    $seatImagePath = asset('images/seatmaps/' . $tipe . '.svg') ?: asset('images/seatmaps/' . $tipe . '.png');
    $imageHeight = min(560, $jumlahBaris * 20); // 2x taller
$fallbackUrls = [
        'bus' => 'https://via.placeholder.com/500x400/e74c3c/ffffff?text=Bus+Seatmap',
        'kereta' => 'https://panjiwinatha.wordpress.com/wp-content/uploads/2014/03/denah-kelas-ekonomi.jpg?w=500',
        'kapal' => 'https://via.placeholder.com/500x400/27ae60/ffffff?text=Ferry+Kapal+Seatmap',
        'pesawat' => 'https://www.ana.co.jp/www2/travel-information/seat-map/a320neo-map.png',
        'default' => 'https://via.placeholder.com/500x400/3498db/ffffff?text={{ ucfirst($tipe) }}+Seatmap'
    ];
    $fallbackUrl = $fallbackUrls[$tipe] ?? $fallbackUrls['default'];

@endphp
<div class="mx-auto w-full">
    <img src="{{ $seatImagePath }}" alt="Denah Kursi {{ ucfirst($tipe) }} ({{ $jumlahBaris }} baris)"
        class="w-full rounded-3xl shadow-2xl object-contain bg-gradient-to-br from-gray-50 to-slate-50 p-4 border border-gray-200"
        loading="lazy" onerror="this.src='{{ $fallbackUrl }}'; this.alt='{{ ucfirst($tipe) }} seat map';"
        style="height: {{ $imageHeight }}px; max-height: 500px;">
</div>