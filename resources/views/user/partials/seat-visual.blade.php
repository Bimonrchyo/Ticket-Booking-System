@php
    $seatLayout = $jadwal->transportasi->seat_layout ?? ['seats_per_row' => 4];
    $kapasitas = $jadwal->transportasi->kapasitas;
    $tipe = strtolower($jadwal->transportasi->tipe);
    $jumlahBaris = ceil($kapasitas / $seatLayout['seats_per_row']);

    $imageHeight = min(560, $jumlahBaris * 20); // 2x taller

    // Lokasi gambar lokal: coba SVG dulu, kalau tidak ada fallback ke PNG, lalu JPG, lalu URL eksternal.
    $seatSvgPath = asset('images/seatmaps/' . $tipe . '.svg');
    $seatPngPath = asset('images/seatmaps/' . $tipe . '.png');
    $seatJpgPath = asset('images/seatmaps/' . $tipe . '.jpg');


    $fallbackUrls = [
        'bus' => 'https://via.placeholder.com/500x400/e74c3c/ffffff?text=Bus+Seatmap',
        'kereta' => 'https://panjiwinatha.wordpress.com/wp-content/uploads/2014/03/denah-kelas-ekonomi.jpg?w=500',
        'kapal' => 'https://via.placeholder.com/500x400/27ae60/ffffff?text=Ferry+Kapal+Seatmap',
        'pesawat' => 'https://www.ana.co.jp/www2/travel-information/seat-map/a320neo-map.png',
        'default' => 'https://via.placeholder.com/500x400/3498db/ffffff?text={{ ucfirst($tipe) }}+Seatmap',
    ];

    $fallbackUrl = $fallbackUrls[$tipe] ?? $fallbackUrls['default'];
@endphp
<div class="mx-auto w-full">
    <img
        src="{{ $seatSvgPath }}"
        alt="Denah Kursi {{ ucfirst($tipe) }} ({{ $jumlahBaris }} baris)"
        class="w-full rounded-3xl shadow-2xl object-contain bg-gradient-to-br from-gray-50 to-slate-50 p-4 border border-gray-200"
        loading="lazy"
        style="height: {{ $imageHeight }}px; max-height: 500px;"
        onerror="this.onerror=null; this.src='{{ $seatPngPath }}'; this.alt='{{ ucfirst($tipe) }} seat map (png)'; this.onerror=function(){ this.onerror=null; this.src='{{ $seatJpgPath }}'; this.alt='{{ ucfirst($tipe) }} seat map (jpg)'; this.onerror=function(){ this.onerror=null; this.src='{{ $fallbackUrl }}'; this.alt='{{ ucfirst($tipe) }} seat map (fallback)'; }; };"
    >
</div>


    <script>
        // Fallback kedua: kalau PNG gagal, coba JPG.
        // Fallback ketiga: kalau JPG gagal, baru pakai URL eksternal.
        (function () {
            var imgs = document.querySelectorAll('img[data-fallback-external]');
            imgs.forEach(function(img){
                if (img.dataset.bound) return;
                img.dataset.bound = '1';

                img.addEventListener('error', function handler(e){
                    // 1) kalau baru gagal dari SVG, sekarang PNG gagal -> coba JPG
                    if (img.dataset.triedJpg !== '1' && img.src && img.src.indexOf('.png') !== -1) {
                        img.dataset.triedJpg = '1';
                        var jpg = img.src.replace(/\.png(\?.*)?$/, '.jpg$1');
                        img.src = jpg;
                        return;
                    }

                    // 2) kalau JPG gagal -> fallback eksternal
                    if (img.dataset.triedExternal !== '1') {
                        img.dataset.triedExternal = '1';
                        var next = img.getAttribute('data-fallback-external');
                        if (next) {
                            img.src = next;
                            img.alt = img.alt + ' (fallback)';
                        }
                    }

                    img.removeEventListener('error', handler);
                });
            });
        })();
    </script>

</div>
