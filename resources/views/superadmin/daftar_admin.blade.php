<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Admin - HubTrans Superadmin</title>
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

        <main class="ml-64 flex-1 p-8">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tracking-tighter">MANAJEMEN ADMIN</h2>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.3em]">Otoritas & Hak Akses Pengguna</p>
                </div>
                <a href="create.php" class="bg-indigo-600 text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition shadow-xl shadow-indigo-100">
                    <i class="fas fa-user-plus mr-2"></i> Tambah Admin Baru
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="p-6 text-[10px] font-black uppercase tracking-widest opacity-60">Nama Admin</th>
                            <th class="p-6 text-[10px] font-black uppercase tracking-widest opacity-60">Username/Email</th>
                            <th class="p-6 text-[10px] font-black uppercase tracking-widest opacity-60">Terakhir Login</th>
                            <th class="p-6 text-[10px] font-black uppercase tracking-widest opacity-60 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 font-bold text-sm">
                        <tr class="hover:bg-indigo-50/30 transition">
                            <td class="p-6 flex items-center gap-4">
                                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-black">R</div>
                                <div>
                                    <p class="text-slate-800">Rizky Ramadhan</p>
                                    <span class="text-[9px] bg-green-100 text-green-600 px-2 py-0.5 rounded uppercase">Active</span>
                                </div>
                            </td>
                            <td class="p-6 text-slate-500 italic">rizky_admin@hubtrans.com</td>
                            <td class="p-6 text-slate-400">2 Jam yang lalu</td>
                            <td class="p-6 text-center">
                                <button class="text-slate-300 hover:text-indigo-600 mr-3"><i class="fas fa-key"></i></button>
                                <button class="text-slate-300 hover:text-red-500"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>