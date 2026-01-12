<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Bayar - HubTrans</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">
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

    <main class="ml-64 p-8">
        <div class="mb-10">
            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Verifikasi Transaksi</h2>
            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Validasi Bukti Transfer Pengguna</p>
        </div>

        <div class="space-y-4">
            <?php 
            $konfirmasi = [
                ['user' => 'Budi Hermawan', 'booking' => 'HT-88120', 'nominal' => '125.000', 'bank' => 'BCA'],
                ['user' => 'Siti Aminah', 'booking' => 'HT-99201', 'nominal' => '850.000', 'bank' => 'Mandiri'],
            ];
            foreach($konfirmasi as $row): 
            ?>
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex items-center justify-between group hover:border-blue-200 transition">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-gray-50 border border-gray-100 rounded-2xl flex items-center justify-center text-gray-300 overflow-hidden relative group cursor-zoom-in">
                        <i class="fas fa-image fa-2x"></i>
                        <span class="absolute inset-0 bg-blue-600/80 text-white text-[8px] font-black flex items-center justify-center opacity-0 group-hover:opacity-100 transition">LIHAT BUKTI</span>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-800 uppercase text-sm tracking-tight"><?php echo $row['user']; ?></h4>
                        <p class="text-[10px] font-bold text-gray-400 mb-1 tracking-widest">KODE BOOKING: <?php echo $row['booking']; ?></p>
                        <p class="text-orange-500 font-black text-lg">Rp <?php echo $row['nominal']; ?> <span class="text-[10px] text-gray-400 font-normal ml-1 italic tracking-normal">(via <?php echo $row['bank']; ?>)</span></p>
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <button class="bg-red-50 text-red-600 px-6 py-3 rounded-xl font-black text-[10px] uppercase hover:bg-red-600 hover:text-white transition tracking-widest">Tolak</button>
                    <button class="bg-green-500 text-white px-8 py-3 rounded-xl font-black text-[10px] uppercase shadow-lg shadow-green-100 hover:bg-green-600 transition tracking-widest">Konfirmasi</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>