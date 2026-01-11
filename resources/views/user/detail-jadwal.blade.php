<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Perjalanan & Pilih Kursi - HubTrans</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans" x-data="{ 
    selectedSeat: null,
    bookedSeats: ['1A', '2B', '5C'],
    selectSeat(seat) {
        if(!this.bookedSeats.includes(seat)) {
            this.selectedSeat = (this.selectedSeat === seat) ? null : seat;
        }
    }
}">

    <nav class="bg-blue-700 text-white p-4 shadow-md sticky top-0 z-40">
        <div class="max-w-6xl mx-auto flex items-center gap-4">
            <a href="javascript:history.back()" class="bg-blue-600/50 p-2 rounded-lg hover:bg-blue-500 transition">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-bold text-lg">Detail & Pilih Kursi</h1>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-8 flex flex-col lg:flex-row gap-8">
        
        <div class="flex-1 space-y-6">
            <div class="bg-white rounded-3xl p-6 shadow-2xl border border-gray-300 ring-1 ring-gray-100 transform hover:-translate-y-1 transition-all">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 text-2xl">
                        <i class="fas fa-bus"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-gray-800">TransExpress Eksekutif</h2>
                        <p class="text-sm text-gray-500 uppercase font-bold tracking-widest">H-99281 • Scania K410IB</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="p-4 bg-gray-50 rounded-2xl text-center">
                        <i class="fas fa-snowflake text-blue-400 mb-2"></i>
                        <p class="text-[10px] font-bold text-gray-500 uppercase">AC</p>
                        <p class="text-xs font-bold text-gray-700">Tersedia</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-2xl text-center">
                        <i class="fas fa-plug text-orange-400 mb-2"></i>
                        <p class="text-[10px] font-bold text-gray-500 uppercase">USB Port</p>
                        <p class="text-xs font-bold text-gray-700">Tiap Kursi</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-2xl text-center">
                        <i class="fas fa-couch text-green-400 mb-2"></i>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Konfigurasi</p>
                        <p class="text-xs font-bold text-gray-700">2 - 2</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-2xl text-center">
                        <i class="fas fa-restroom text-purple-400 mb-2"></i>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Toilet</p>
                        <p class="text-xs font-bold text-gray-700">Tersedia</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-2xl border border-gray-300 ring-1 ring-gray-100 transform hover:-translate-y-1 transition-all">
                <h3 class="font-black text-gray-800 mb-6 uppercase text-sm tracking-widest">Pilih Nomor Kursi</h3>
                
                <div class="flex flex-col items-center">
                    <div class="flex gap-4 mb-8 text-[10px] font-bold">
                        <div class="flex items-center gap-2"><div class="w-4 h-4 bg-gray-100 rounded"></div> Tersedia</div>
                        <div class="flex items-center gap-2"><div class="w-4 h-4 bg-blue-600 rounded"></div> Dipilih</div>
                        <div class="flex items-center gap-2"><div class="w-4 h-4 bg-gray-300 rounded"></div> Terisi</div>
                    </div>

                    <div class="border-4 border-gray-100 rounded-t-[50px] p-6 w-full max-w-[300px] relative">
                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 text-gray-300">
                            <i class="fas fa-steering-wheel fa-3x"></i>
                        </div>

                        <div class="grid grid-cols-4 gap-4 mt-4">
                            <?php 
                            $rows = ['1', '2', '3', '4', '5'];
                            $cols = ['A', 'B', 'C', 'D'];
                            foreach($rows as $row):
                                foreach($cols as $index => $col):
                                    $seatId = $row . $col;
                                    // Beri celah di tengah (Gang)
                                    if($index == 2) echo '<div></div>'; 
                            ?>
                                <button 
                                    @click="selectSeat('<?= $seatId ?>')"
                                    :class="{
                                        'bg-gray-100 text-gray-400 hover:bg-gray-200': !bookedSeats.includes('<?= $seatId ?>') && selectedSeat !== '<?= $seatId ?>',
                                        'bg-blue-600 text-white shadow-lg shadow-blue-200 scale-110': selectedSeat === '<?= $seatId ?>',
                                        'bg-gray-300 text-white cursor-not-allowed': bookedSeats.includes('<?= $seatId ?>')
                                    }"
                                    class="w-10 h-10 rounded-xl text-[10px] font-black transition-all duration-200">
                                    <?= $seatId ?>
                                </button>
                            <?php endforeach; endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:w-80">
            <div class="bg-white rounded-3xl p-6 shadow-2xl border border-gray-300 ring-1 ring-gray-100 sticky top-24 transform hover:-translate-y-1 transition-all">
                <h3 class="font-black text-gray-800 mb-4 uppercase text-sm">Ringkasan</h3>
                <div class="space-y-4 border-b pb-4 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Harga Tiket</span>
                        <span class="font-bold text-gray-700">Rp 125.000</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Nomor Kursi</span>
                        <span class="font-black text-blue-600" x-text="selectedSeat || '-'"></span>
                    </div>
                </div>
                <div class="flex justify-between items-center mb-6">
                    <span class="text-xs font-bold text-gray-400">Total Bayar</span>
                    <span class="text-xl font-black text-orange-500">Rp 125.000</span>
                </div>

                <button 
                    :disabled="!selectedSeat"
                    :class="selectedSeat ? 'bg-blue-600 hover:bg-blue-700 shadow-blue-100' : 'bg-gray-200 cursor-not-allowed'"
                    class="w-full text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg transition active:scale-95">
                    Lanjutkan Pembayaran
                </button>
                <p class="text-[9px] text-gray-400 mt-4 text-center">Dengan mengklik tombol, Anda menyetujui Syarat & Ketentuan HubTrans.</p>
            </div>
        </div>
    </div>

</body>
</html>