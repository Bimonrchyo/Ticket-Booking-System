<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Global - HubTrans Owner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans">

    <div class="flex">
  <aside class="w-64 bg-slate-900 min-h-screen text-gray-300 hidden lg:block fixed left-0 top-0 z-50 shadow-2xl">
    <div class="p-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-500/20">
                <i class="fas fa-shield-alt text-white text-xs"></i>
            </div>
            <h1 class="text-white text-xl font-black tracking-tighter uppercase italic">
                Hub<span class="text-indigo-500">Owner</span>
            </h1>
        </div>
        <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] px-1">Superadmin Panel</p>
    </div>

    <nav class="mt-4 px-4 space-y-8">
        
        <div>
            <div class="px-4 mb-3 text-[10px] font-black text-slate-600 uppercase tracking-widest">Main Overview</div>
            <div class="space-y-1">
                <a href="/laporan" class="flex items-center gap-3 hover:bg-slate-800 hover:text-white px-4 py-3 rounded-2xl font-bold transition text-sm group">
                    <i class="fas fa-chart-line w-5 text-indigo-500 group-hover:scale-110 transition"></i> 
                    Laporan Global
                </a>
            </div>
        </div>

        <div>
            <div class="px-4 mb-3 text-[10px] font-black text-slate-600 uppercase tracking-widest">Access Control</div>
            <div class="space-y-1">
                <a href="/daftar" class="flex items-center gap-3 hover:bg-slate-800 hover:text-white px-4 py-3 rounded-2xl font-bold transition text-sm group">
                    <i class="fas fa-users-cog w-5 text-indigo-500 group-hover:scale-110 transition"></i> 
                    Daftar Admin
                </a>
                <a href="/tambah" class="flex items-center gap-3 hover:bg-slate-800 hover:text-white px-4 py-3 rounded-2xl font-bold transition text-sm group">
                    <i class="fas fa-user-plus w-5 text-indigo-500 group-hover:scale-110 transition"></i> 
                    Tambah Admin
                </a>
            </div>
        </div>

    </nav>

    <div class="absolute bottom-0 left-0 w-full p-6 border-t border-slate-800 bg-slate-900/50 backdrop-blur-md">
        <div class="flex items-center gap-3 mb-6 px-2">
            <img src="https://ui-avatars.com/api/?name=Super+Admin&background=4f46e5&color=fff" class="w-10 h-10 rounded-xl border border-slate-700 shadow-sm" alt="Profile">
            <div class="overflow-hidden">
                <p class="text-xs font-black text-white truncate uppercase">Ahmad Owner</p>
                <p class="text-[9px] text-indigo-400 font-bold uppercase tracking-tighter">Chief Executive</p>
            </div>
        </div>
        <a href="../logout.php" class="flex items-center justify-center gap-2 w-full bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white py-3 rounded-xl font-black text-[10px] uppercase tracking-widest transition duration-300 active:scale-95">
            <i class="fas fa-power-off"></i> Keluar Sistem
        </a>
    </div>
</aside>

        <main class="ml-64 flex-1 p-10">
            
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tracking-tighter uppercase">Laporan Finansial Global</h2>
                    <p class="text-sm text-indigo-500 font-bold uppercase tracking-widest mt-1">Ringkasan Pendapatan Seluruh Moda</p>
                </div>
                <div class="flex gap-3">
                    <div class="bg-white px-4 py-2 rounded-xl border border-slate-200 flex items-center gap-3 shadow-sm">
                        <i class="fas fa-calendar-alt text-indigo-500"></i>
                        <span class="text-xs font-black text-slate-600 uppercase">Januari 2026</span>
                    </div>
                    <button onclick="window.print()" class="bg-slate-900 text-white px-6 py-3 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] shadow-lg hover:bg-slate-800 transition">
                        <i class="fas fa-file-export mr-2"></i> Ekspor PDF
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-50 rounded-full group-hover:scale-110 transition duration-500"></div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 relative z-10 text-indigo-500">Total Pendapatan</p>
                    <h3 class="text-2xl font-black text-slate-800 tracking-tighter relative z-10">IDR 1.25B</h3>
                    <p class="text-[10px] font-bold text-green-500 mt-2 relative z-10"><i class="fas fa-arrow-up mr-1"></i> 12% dari bulan lalu</p>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden group">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 text-emerald-500">Tiket Terjual</p>
                    <h3 class="text-2xl font-black text-slate-800 tracking-tighter">14,250 <span class="text-xs text-slate-300">Pcs</span></h3>
                    <div class="w-full bg-slate-100 h-1.5 rounded-full mt-4">
                        <div class="bg-emerald-500 h-1.5 rounded-full w-[75%]"></div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 text-blue-500">Moda Terlaris</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-plane"></i>
                        </div>
                        <h3 class="text-xl font-black text-slate-800 tracking-tight uppercase">Pesawat</h3>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 text-red-500">Batal / Refund</p>
                    <h3 class="text-2xl font-black text-slate-800 tracking-tighter">84 <span class="text-xs text-slate-300">Tiket</span></h3>
                    <p class="text-[9px] font-bold text-slate-400 mt-2 uppercase tracking-tighter">0.5% dari total penjualan</p>
                </div>
            </div>

            <div class="bg-white rounded-[3rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                    <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">Performansi Pendapatan per Moda</h3>
                    <span class="text-[9px] bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full font-black uppercase italic">Data Terverifikasi</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Moda</th>
                                <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Transaksi</th>
                                <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tiket Terjual</th>
                                <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Pendapatan Kotor</th>
                                <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Profit</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 font-bold text-sm">
                            <?php 
                            $data = [
                                ['name' => 'Pesawat', 'icon' => 'fa-plane', 'color' => 'blue', 'trx' => '4,120', 'tickets' => '6,200', 'rev' => '750,000,000', 'profit' => '+15%'],
                                ['name' => 'Kereta Api', 'icon' => 'fa-train', 'color' => 'orange', 'trx' => '2,850', 'tickets' => '4,100', 'rev' => '280,000,000', 'profit' => '+10%'],
                                ['name' => 'Bus (Travel)', 'icon' => 'fa-bus', 'color' => 'emerald', 'trx' => '1,450', 'tickets' => '2,450', 'rev' => '120,000,000', 'profit' => '+8%'],
                                ['name' => 'Kapal Laut', 'icon' => 'fa-ship', 'color' => 'indigo', 'trx' => '940', 'tickets' => '1,500', 'rev' => '100,000,000', 'profit' => '+5%'],
                            ];
                            foreach($data as $row): 
                            ?>
                            <tr class="hover:bg-slate-50 transition group">
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-<?php echo $row['color']; ?>-50 text-<?php echo $row['color']; ?>-600 rounded-2xl flex items-center justify-center transition group-hover:scale-110">
                                            <i class="fas <?php echo $row['icon']; ?>"></i>
                                        </div>
                                        <span class="uppercase tracking-tighter text-slate-800"><?php echo $row['name']; ?></span>
                                    </div>
                                </td>
                                <td class="p-6 text-slate-400 font-mono"><?php echo $row['trx']; ?></td>
                                <td class="p-6 text-slate-500"><?php echo $row['tickets']; ?></td>
                                <td class="p-6 text-right text-slate-800">IDR <?php echo $row['rev']; ?></td>
                                <td class="p-6 text-center">
                                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase italic"><?php echo $row['profit']; ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="bg-slate-900 text-white font-black">
                            <tr>
                                <td colspan="3" class="p-8 uppercase tracking-widest text-xs italic">Grand Total Pendapatan</td>
                                <td class="p-8 text-right text-xl tracking-tighter">IDR 1,250,000,000</td>
                                <td class="p-8 text-center text-[10px] text-slate-400 uppercase tracking-widest font-normal italic">Bulan Berjalan</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="mt-12 opacity-20 text-center grayscale">
                <h1 class="text-3xl font-black italic tracking-tighter">HUB<span class="text-indigo-600">TRANS</span></h1>
            </div>

        </main>
    </div>

</body>
</html>