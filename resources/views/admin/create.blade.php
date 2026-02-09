<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Armada Detail - HubTrans</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans" x-data="{ moda: 'pesawat' }">

   

    <div class="flex">
         <aside class="w-64 bg-slate-900 min-h-screen text-gray-300 hidden lg:block fixed left-0 top-0">
    <div class="p-6">
        <h1 class="text-white text-2xl font-black tracking-tighter uppercase italic">Hub<span class="text-blue-500">Admin</span></h1>
    </div>
    <nav class="mt-6 px-4 space-y-2">
        <a href="/dashboard" class="flex items-center gap-3 hover:bg-slate-800 px-4 py-3 rounded-xl font-bold transition text-sm">
            <i class="fas fa-chart-pie w-5"></i> Dashboard
        </a>
        <div class="pt-4 pb-2 px-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Manajemen</div>
        <a href="/create" class="flex items-center gap-3 hover:bg-slate-800 px-4 py-3 rounded-xl font-bold text-sm">
            <i class="fas fa-bus w-5"></i> Kelola Armada
        </a>
        <a href="/index" class="flex items-center gap-3 hover:bg-slate-800 px-4 py-3 rounded-xl font-bold text-sm">
            <i class="fas fa-calendar-alt w-5"></i> Kelola Jadwal
        </a>
        <a href="/verifikasi" class="flex items-center gap-3 hover:bg-slate-800 px-4 py-3 rounded-xl font-bold text-sm relative">
            <i class="fas fa-check-circle w-5"></i> Verifikasi Bayar
            <span class="absolute right-4 bg-red-500 text-[10px] text-white px-1.5 rounded-full">3</span>
        </a>
    </nav>
</aside>

        <main class="lg:ml-64 flex-1 p-8">
            <div class="max-w-4xl mx-auto">
                <header class="mb-8">
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Tambah Unit Armada</h2>
                    <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">Input spesifikasi detail kendaraan</p>
                </header>

                <form action="proses-tambah.php" method="POST" class="bg-white rounded-[2.5rem] p-10 shadow-xl shadow-gray-200/50 border border-gray-100">
                    
                    <div class="mb-10">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-[0.2em] block mb-4">Jenis Moda Transportasi</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <template x-for="item in ['pesawat', 'bus', 'kereta', 'kapal']">
                                <label class="cursor-pointer group">
                                    <input type="radio" name="moda" :value="item" x-model="moda" class="hidden">
                                    <div class="p-4 border-2 rounded-3xl text-center transition-all duration-300"
                                         :class="moda === item ? 'border-blue-600 bg-blue-50 ring-4 ring-blue-100' : 'border-gray-100 bg-gray-50 group-hover:border-blue-200'">
                                        <i class="fas fa-2x mb-2 transition-colors" 
                                           :class="[
                                                item === 'pesawat' ? 'fa-plane' : '',
                                                item === 'bus' ? 'fa-bus' : '',
                                                item === 'kereta' ? 'fa-train' : '',
                                                item === 'kapal' ? 'fa-ship' : '',
                                                moda === item ? 'text-blue-600' : 'text-gray-300'
                                           ]"></i>
                                        <p class="text-[10px] font-black uppercase tracking-widest" :class="moda === item ? 'text-blue-600' : 'text-gray-400'" x-text="item"></p>
                                    </div>
                                </label>
                            </template>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                        <div class="space-y-6">
                            <div>
                                <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest block mb-2">Nama Unit / Maskapai</label>
                                <input type="text" name="nama_unit" placeholder="Contoh: Garuda Indonesia / TransExpress" 
                                       class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500 outline-none transition">
                            </div>
                            <div>
                                <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest block mb-2">Kode / Nomor Registrasi</label>
                                <input type="text" name="kode_unit" placeholder="Contoh: PK-GAA / B 1234 TGC" 
                                       class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500 outline-none transition text-blue-600 uppercase">
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest block mb-2">Tipe Kelas</label>
                                <select name="kelas" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500 outline-none appearance-none cursor-pointer">
                                    <option value="Ekonomi">Ekonomi</option>
                                    <option value="Bisnis">Bisnis</option>
                                    <option value="Eksekutif">Eksekutif</option>
                                    <option value="LCC">LCC (Low Cost Carrier)</option>
                                    <option value="Full Service">Full Service</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest block mb-2">Total Kapasitas Kursi</label>
                                <div class="relative">
                                    <input type="number" name="kapasitas" placeholder="0" 
                                           class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-500 transition">
                                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-400 uppercase">Kursi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 bg-blue-50/50 rounded-[2rem] border border-blue-100 mb-10">
                        <label class="text-[11px] font-black text-blue-800 uppercase tracking-widest block mb-6 flex items-center gap-2">
                            <i class="fas fa-concierge-bell"></i> Fasilitas Armada
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="fasilitas[]" value="makan" class="w-5 h-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm font-bold text-slate-600 group-hover:text-blue-600 transition"><i class="fas fa-utensils w-5"></i> Makan</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="fasilitas[]" value="usb" class="w-5 h-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm font-bold text-slate-600 group-hover:text-blue-600 transition"><i class="fas fa-bolt w-5"></i> USB Port</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="fasilitas[]" value="wifi" class="w-5 h-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm font-bold text-slate-600 group-hover:text-blue-600 transition"><i class="fas fa-wifi w-5"></i> Wi-Fi</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="fasilitas[]" value="bagasi" class="w-5 h-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                                <span class="text-sm font-bold text-slate-600 group-hover:text-blue-600 transition"><i class="fas fa-suitcase w-5"></i> Bagasi (20kg)</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="fasilitas[]" value="hiburan" class="w-5 h-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm font-bold text-slate-600 group-hover:text-blue-600 transition"><i class="fas fa-tv w-5"></i> Hiburan</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="fasilitas[]" value="ac" class="w-5 h-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                                <span class="text-sm font-bold text-slate-600 group-hover:text-blue-600 transition"><i class="fas fa-snowflake w-5"></i> AC</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <button type="button" class="flex-1 border-2 border-gray-100 text-gray-400 py-5 rounded-2xl font-black uppercase tracking-widest hover:bg-gray-50 transition active:scale-95">
                            Batal
                        </button>
                        <button type="submit" class="flex-[2] bg-blue-600 text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] shadow-xl shadow-blue-100 hover:bg-blue-700 transition active:scale-95">
                            Simpan Unit Armada
                        </button>
                    </div>

                </form>
            </div>
        </main>
    </div>

</body>
</html>