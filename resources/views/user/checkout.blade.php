<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Detail Penumpang | HubTrans</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans" x-data="{ 
    sameAsBooker: false,
    bookerName: '',
    passengerName: '',
    passengerID: '',
    updatePassenger() {
        if(this.sameAsBooker) {
            this.passengerName = this.bookerName;
        }
    }
}">

    <nav class="bg-blue-700 text-white p-4 shadow-md sticky top-0 z-40">
        <div class="max-w-6xl mx-auto flex items-center justify-between px-2">
            <div class="flex items-center gap-4">
                <a href="javascript:history.back()" class="bg-blue-600/50 p-2 rounded-lg hover:bg-blue-500 transition">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="font-bold text-lg">Checkout</h1>
            </div>
            <div class="hidden md:flex items-center gap-3 text-[10px] font-bold uppercase tracking-widest">
                <span class="opacity-50">Pilih</span>
                <i class="fas fa-chevron-right opacity-30 text-[8px]"></i>
                <span class="bg-white text-blue-700 px-3 py-1 rounded-full">Data</span>
                <i class="fas fa-chevron-right opacity-30 text-[8px]"></i>
                <span class="opacity-50">Bayar</span>
            </div>
        </div>
    </nav>

    

    <div class="max-w-6xl mx-auto px-4 py-8 flex flex-col lg:flex-row gap-8">
        
        <div class="flex-1 space-y-6">
            
            <div class="bg-white rounded-3xl p-6 shadow-2xl border border-gray-300 ring-1 ring-gray-100 transform hover:-translate-y-1 transition-all">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-blue-600">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3 class="font-black text-gray-800 uppercase text-sm tracking-wider">Informasi Kontak</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-2">Nama Lengkap</label>
                        <input type="text" x-model="bookerName" @input="updatePassenger" placeholder="Sesuai KTP/Paspor" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-2">Nomor WhatsApp</label>
                        <input type="tel" placeholder="0812xxxx" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-2">Email</label>
                        <input type="email" placeholder="contoh@email.com" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
                        <p class="text-[9px] text-gray-400 mt-2 italic">* E-Tiket akan dikirimkan ke email ini</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-2xl border border-gray-300 ring-1 ring-gray-100 transform hover:-translate-y-1 transition-all">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-orange-50 rounded-full flex items-center justify-center text-orange-600">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3 class="font-black text-gray-800 uppercase text-sm tracking-wider">Detail Penumpang 1</h3>
                    </div>
                    <label class="flex items-center cursor-pointer gap-2">
                        <span class="text-[11px] font-bold text-gray-500 uppercase">Sama dengan pemesan?</span>
                        <div class="relative">
                            <input type="checkbox" x-model="sameAsBooker" @change="updatePassenger" class="sr-only">
                            <div class="w-12 h-6 bg-gray-300 rounded-full transition-colors duration-200 ease-in-out shadow-lg" :class="sameAsBooker ? 'bg-blue-600' : 'bg-gray-300'"></div>
                            <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform duration-200 ease-in-out transform shadow-2xl ring-1 ring-gray-200" :class="sameAsBooker ? 'translate-x-6' : ''"></div>
                        </div>
                    </label>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-2">Nama Lengkap (Sesuai ID)</label>
                        <input type="text" x-model="passengerName" :disabled="sameAsBooker" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition" :class="sameAsBooker ? 'bg-gray-100 text-gray-500' : 'bg-gray-50'">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-2">NIK / Nomor Paspor</label>
                        <div class="relative">
                            <i class="fas fa-id-card absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                            <input type="text" x-model="passengerID" placeholder="Masukkan 16 digit NIK" class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-12 pr-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:w-80">
            <div class="bg-white rounded-3xl p-6 shadow-2xl border border-gray-300 ring-1 ring-gray-100 sticky top-24 transform hover:-translate-y-1 transition-all">
                <h3 class="font-black text-gray-800 mb-4 uppercase text-sm">Ringkasan Pesanan</h3>
                
                <div class="space-y-4 mb-6">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-bus text-blue-600 mt-1"></i>
                        <div>
                            <p class="text-xs font-black text-gray-800">TransExpress</p>
                            <p class="text-[10px] text-gray-400 uppercase font-bold">Eksekutif • Kursi 5A</p>
                        </div>
                    </div>
                    <div class="border-l-2 border-dashed border-gray-100 ml-2 pl-4 space-y-3">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase">Pergi</p>
                            <p class="text-xs font-bold text-gray-700">Jakarta (HLP)</p>
                            <p class="text-[9px] text-gray-400">Senin, 5 Jan • 08:00</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase">Tiba</p>
                            <p class="text-xs font-bold text-gray-700">Bandung (BDG)</p>
                            <p class="text-[9px] text-gray-400">Senin, 5 Jan • 10:30</p>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-4 space-y-2 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-gray-500 uppercase">Total Bayar</span>
                        <span class="text-xl font-black text-orange-500 tracking-tighter">Rp 125.000</span>
                    </div>
                </div>

                <button class="w-full bg-blue-700 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-blue-100 hover:bg-blue-800 transition transform active:scale-95">
                    Lanjutkan Pembayaran
                </button>
                
                <div class="mt-4 flex items-start gap-2 text-[9px] text-gray-400 leading-relaxed">
                    <i class="fas fa-shield-alt text-green-500 mt-0.5"></i>
                    <p>Data Anda aman dan terenkripsi. E-Tiket akan diterbitkan segera setelah pembayaran dikonfirmasi.</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>