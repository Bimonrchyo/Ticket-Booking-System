<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran - HubTrans</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans py-10 px-4">

    <div class="max-w-xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
        
        <div class="bg-blue-700 p-8 text-white text-center relative">
            <div class="absolute top-4 left-4 opacity-20 text-4xl">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <h1 class="text-2xl font-black uppercase tracking-widest mb-1">HubTrans</h1>
            <p class="text-[10px] font-bold opacity-70 uppercase tracking-widest">E-Receipt & Official Invoice</p>
            
            <div class="mt-6 inline-block bg-green-500 text-white text-[10px] font-bold px-4 py-1.5 rounded-full shadow-lg border border-green-400">
                <i class="fas fa-check-circle mr-1"></i> PEMBAYARAN BERHASIL
            </div>
        </div>

        <div class="p-8">
            <div class="flex justify-between items-start border-b border-dashed pb-6 mb-6">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Nomor Invoice</p>
                    <p class="font-black text-gray-800">INV/20260105/HT/99281</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tanggal Transaksi</p>
                    <p class="font-bold text-gray-800 text-sm">05 Jan 2026, 09:15 WIB</p>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <h3 class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-3">Detail Pelanggan</h3>
                    <div class="bg-gray-50 p-4 rounded-2xl">
                        <p class="text-xs font-black text-gray-800 uppercase">Budi Hermawan</p>
                        <p class="text-[10px] text-gray-500 font-bold">budi.hermawan@email.com • 081234567890</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-3">Rincian Perjalanan</h3>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                            <i class="fas fa-bus"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black text-gray-800">TransExpress (Eksekutif)</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">Jakarta &rarr; Bandung • Kursi 5A</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-dashed pt-6">
                    <h3 class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-4">Rincian Biaya</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bold italic">Harga Tiket (x1)</span>
                            <span class="font-black text-gray-800">Rp 125.000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bold italic">Biaya Layanan</span>
                            <span class="font-black text-gray-800">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bold italic">Pajak (PPN 11%)</span>
                            <span class="font-black text-gray-800 text-xs text-gray-400 uppercase italic">Termasuk</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-blue-50 p-6 rounded-3xl border border-blue-100 flex justify-between items-center">
                <span class="text-xs font-black text-blue-800 uppercase tracking-widest">Total Bayar</span>
                <span class="text-2xl font-black text-blue-700 tracking-tighter">IDR 125.000</span>
            </div>

            <div class="mt-10 text-center">
                <div class="inline-block p-4 bg-white border-2 border-gray-100 rounded-2xl mb-4">
                    <i class="fas fa-qrcode fa-4x text-gray-800"></i>
                </div>
                <p class="text-[9px] text-gray-400 font-bold leading-relaxed px-10">
                    Ini adalah bukti pembayaran yang sah. Simpan struk ini untuk keperluan verifikasi atau cetak ulang E-Tiket di terminal keberangkatan.
                </p>
            </div>
        </div>

        <div class="p-8 bg-gray-50 flex gap-4 print:hidden">
            <button onclick="window.print()" class="flex-1 bg-white border-2 border-blue-600 text-blue-600 py-3 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-50 transition">
                <i class="fas fa-print mr-2"></i> Cetak Struk
            </button>
            <button class="flex-1 bg-blue-700 text-white py-3 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-blue-100 hover:bg-blue-800 transition">
                <i class="fas fa-download mr-2"></i> Simpan PDF
            </button>
        </div>
    </div>

    <div class="mt-8 text-center print:hidden">
        <a href="history.php" class="text-xs font-black text-gray-400 hover:text-blue-600 transition uppercase tracking-widest">
            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Histori
        </a>
    </div>

</body>
</html>