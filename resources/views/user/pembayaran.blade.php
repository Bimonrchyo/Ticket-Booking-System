<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - HubTrans</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans" x-data="{ 
    payMethod: 'transfer', 
    copied: false,
    fileName: '',
    copyVA() {
        navigator.clipboard.writeText('8801234567890');
        this.copied = true;
        setTimeout(() => this.copied = false, 2000);
    }
}">

    <nav class="bg-blue-700 text-white p-4 shadow-md sticky top-0 z-40">
        <div class="max-w-6xl mx-auto flex items-center justify-between px-2">
            <div class="flex items-center gap-4">
                <a href="javascript:history.back()" class="bg-blue-600/50 p-2 rounded-lg hover:bg-blue-500 transition">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="font-bold text-lg">Instruksi Pembayaran</h1>
            </div>
            <div class="hidden md:flex items-center gap-3 text-[10px] font-bold uppercase tracking-widest">
                <span class="opacity-50">Pilih</span>
                <i class="fas fa-chevron-right opacity-30 text-[8px]"></i>
                <span class="opacity-50">Data</span>
                <i class="fas fa-chevron-right opacity-30 text-[8px]"></i>
                <span class="bg-white text-blue-700 px-3 py-1 rounded-full">Bayar</span>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-8 flex flex-col lg:flex-row gap-8">
        
        <div class="flex-1 space-y-6">
            
            <div class="bg-orange-50 border border-orange-100 rounded-3xl p-6 flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-orange-400 uppercase tracking-widest">Selesaikan dalam</p>
                    <h3 class="text-xl font-black text-orange-600">23:59:59</h3>
                </div>
                <i class="fas fa-clock text-orange-200 text-3xl"></i>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-2xl border border-gray-300 ring-1 ring-gray-100 transform hover:-translate-y-1 transition-all">
                <h3 class="font-black text-gray-800 uppercase text-sm tracking-widest mb-6">Transfer Ke</h3>
                
                <div class="flex items-center gap-6 p-6 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                    <div class="w-16 h-10 bg-white rounded-lg flex items-center justify-center font-bold text-blue-800 italic border border-gray-100 shadow-sm">
                        BCA
                    </div>
                    <div class="flex-1">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Nomor Rekening / VA</p>
                        <div class="flex items-center gap-3">
                            <span class="text-xl font-black text-gray-800 tracking-wider">8801 2345 6789 0</span>
                            <button @click="copyVA()" class="text-blue-600 text-xs font-bold hover:underline">
                                <span x-show="!copied">SALIN</span>
                                <span x-show="copied" class="text-green-600"><i class="fas fa-check"></i> TERSALIN</span>
                            </button>
                        </div>
                        <p class="text-xs font-bold text-gray-500 mt-1 uppercase">Atas Nama: PT HUBTRANS INDONESIA</p>
                    </div>
                </div>

                <div class="mt-8 space-y-4">
                    <h4 class="font-black text-gray-800 text-xs uppercase tracking-widest">Instruksi Pembayaran:</h4>
                    <ul class="space-y-3">
                        <li class="flex gap-3 text-sm text-gray-600">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-[10px] font-bold flex-shrink-0">1</span>
                            Masukkan kartu ATM dan PIN Anda atau buka aplikasi M-Banking.
                        </li>
                        <li class="flex gap-3 text-sm text-gray-600">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-[10px] font-bold flex-shrink-0">2</span>
                            Pilih menu Transfer ke Rekening Bank Lain / Virtual Account.
                        </li>
                        <li class="flex gap-3 text-sm text-gray-600">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-[10px] font-bold flex-shrink-0">3</span>
                            Masukkan jumlah yang sesuai: <strong class="text-orange-600">Rp 125.000</strong>.
                        </li>
                    </ul>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-2xl border border-gray-300 ring-1 ring-gray-100 transform hover:-translate-y-1 transition-all">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center text-green-600">
                        <i class="fas fa-upload"></i>
                    </div>
                    <h3 class="font-black text-gray-800 uppercase text-sm tracking-wider">Upload Bukti Transfer</h3>
                </div>

                <div class="border-2 border-dashed border-gray-200 rounded-2xl p-8 text-center hover:border-blue-400 transition-colors cursor-pointer relative">
                    <input type="file" class="absolute inset-0 opacity-0 cursor-pointer" @change="fileName = $event.target.files[0].name">
                    <div x-show="!fileName">
                        <i class="fas fa-image text-gray-300 text-4xl mb-4"></i>
                        <p class="text-sm font-bold text-gray-500">Klik atau seret foto bukti transfer di sini</p>
                        <p class="text-[10px] text-gray-400 mt-1 uppercase">Format: JPG, PNG, PDF (Maks. 2MB)</p>
                    </div>
                    <div x-show="fileName" class="flex items-center justify-center gap-3">
                        <i class="fas fa-file-alt text-blue-600"></i>
                        <p class="text-sm font-black text-gray-800" x-text="fileName"></p>
                        <button @click="fileName = ''" class="text-red-500 text-xs font-bold ml-2">HAPUS</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:w-80">
            <div class="bg-white rounded-3xl p-6 shadow-2xl border border-gray-300 ring-1 ring-gray-100 sticky top-24 transform hover:-translate-y-1 transition-all">
                <h3 class="font-black text-gray-800 mb-4 uppercase text-sm">Ringkasan Pembayaran</h3>
                
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400 font-bold uppercase">Kode Booking</span>
                        <span class="font-black text-gray-800">HT-88120</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400 font-bold uppercase">Harga Tiket</span>
                        <span class="font-bold text-gray-800">Rp 125.000</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400 font-bold uppercase">Biaya Layanan</span>
                        <span class="font-bold text-gray-800">Rp 0</span>
                    </div>
                    <div class="border-t pt-3 flex justify-between items-center">
                        <span class="text-[10px] font-black text-gray-400 uppercase">Total Bayar</span>
                        <span class="text-xl font-black text-orange-500 tracking-tighter">Rp 125.000</span>
                    </div>
                </div>

                <button class="w-full bg-green-600 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-green-100 hover:bg-green-700 transition transform active:scale-95">
                    Konfirmasi Pembayaran
                </button>
                
                <div class="mt-6 p-4 bg-blue-50 rounded-xl">
                    <div class="flex gap-3">
                        <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                        <p class="text-[9px] text-blue-700 leading-relaxed font-bold uppercase">Proses verifikasi manual membutuhkan waktu sekitar 5-15 menit setelah bukti diunggah.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>