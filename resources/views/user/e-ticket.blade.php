<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Tiket #HT-88120 | HubTrans</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .ticket-card { box-shadow: none; border: 1px solid #e5e7eb; }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-900 pb-10">

    <nav class="bg-blue-700 p-4 shadow-md no-print mb-8">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a href="/checkorder" class="text-white font-bold flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Cek Pesanan
            </a>
            <div class="flex gap-4">
                <button onclick="window.print()" class="bg-white text-blue-700 px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2">
                    <i class="fas fa-print"></i> Cetak Tiket
                </button>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 max-w-2xl">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 ticket-card">
            
            <div class="bg-blue-600 p-6 text-white flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <i class="fas fa-route text-2xl"></i>
                    <span class="text-xl font-black tracking-tighter italic">HubTrans</span>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-bold uppercase opacity-80">Status Pembayaran</p>
                    <p class="text-xs font-black bg-green-500 px-3 py-1 rounded-full uppercase">Lunas</p>
                </div>
            </div>

            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <div class="text-left">
                        <h2 class="text-4xl font-black text-blue-700">CGK</h2>
                        <p class="text-xs font-bold text-gray-400">Jakarta (HLP)</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <i class="fas fa-plane text-gray-200 text-2xl mb-1"></i>
                        <div class="w-24 h-[2px] bg-dashed border-t-2 border-dashed border-gray-200"></div>
                    </div>
                    <div class="text-right">
                        <h2 class="text-4xl font-black text-blue-700">SUB</h2>
                        <p class="text-xs font-bold text-gray-400">Surabaya (SUB)</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-y-6 gap-x-4 border-t border-b border-gray-50 py-8">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Penumpang</p>
                        <p class="font-bold text-gray-800">Budi Santoso</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Nomor Kursi</p>
                        <p class="font-bold text-gray-800">12A (Window)</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Tanggal Keberangkatan</p>
                        <p class="font-bold text-gray-800">Senin, 25 Jan 2024</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Waktu (WIB)</p>
                        <p class="font-bold text-gray-800">08:00 - 09:30</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Maskapai / Armada</p>
                        <p class="font-bold text-gray-800 italic">Garuda Indonesia (GA-123)</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Kode Booking</p>
                        <p class="font-black text-blue-600 text-lg">HT-88120</p>
                    </div>
                </div>

                <div class="mt-8 flex flex-col items-center justify-center p-6 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                    <div class="w-32 h-32 bg-white p-2 border border-gray-200 mb-3">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=HT-88120" alt="QR Code">
                    </div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Scan QR Code ini saat Check-in di Terminal</p>
                </div>
            </div>

            <div class="bg-gray-800 p-6 text-white text-center">
                <p class="text-[10px] font-medium opacity-70 mb-2 italic">Pastikan hadir 60 menit sebelum keberangkatan untuk proses validasi data.</p>
                <div class="flex justify-center gap-4 text-xs font-bold">
                    <span><i class="fas fa-suitcase-rolling mr-1"></i> Bagasi 20kg</span>
                    <span><i class="fas fa-utensils mr-1"></i> Snack</span>
                </div>
            </div>
        </div>

        <div class="mt-6 md:hidden no-print">
            <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-2xl shadow-lg transition flex items-center justify-center gap-3">
                <i class="fas fa-file-download"></i> Simpan Sebagai Gambar
            </button>
        </div>
    </main>

</body>
</html>