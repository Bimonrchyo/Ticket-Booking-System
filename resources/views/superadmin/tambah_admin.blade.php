<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin - HubTrans Superadmin</title>
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
            <div class="max-w-4xl mx-auto mb-10 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tracking-tighter uppercase">Registrasi Admin</h2>
                    <p class="text-sm text-indigo-500 font-bold uppercase tracking-widest mt-1">Menambah Otoritas Baru ke Sistem</p>
                </div>
                <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-indigo-200">
                    <i class="fas fa-user-shield fa-2x"></i>
                </div>
            </div>

            <div class="max-w-4xl mx-auto bg-white rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                <div class="bg-indigo-600 p-1"></div> <form action="proses-tambah-admin.php" method="POST" class="p-12">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <div class="col-span-2 md:col-span-1">
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest block mb-3">Nama Lengkap</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-5 flex items-center text-slate-300">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" name="nama" placeholder="Contoh: Rizky Ramadhan" 
                                    class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-6 py-4 font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500 transition outline-none">
                            </div>
                        </div>

                        <div class="col-span-2 md:col-span-1">
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest block mb-3">Email Instansi</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-5 flex items-center text-slate-300">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" name="email" placeholder="admin@hubtrans.com" 
                                    class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-6 py-4 font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500 transition outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest block mb-3">ID Username</label>
                            <input type="text" name="username" placeholder="rizky_admin" 
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500 transition outline-none">
                        </div>

                        <div>
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest block mb-3">Level Akses</label>
                            <div class="w-full bg-indigo-50 border border-indigo-100 rounded-2xl px-6 py-4 font-black text-indigo-600 text-sm uppercase">
                                <i class="fas fa-check-circle mr-2"></i> Regular Admin
                            </div>
                        </div>

                        <div class="col-span-2">
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest block mb-3">Password Sementara</label>
                            <div class="relative" x-data="{ show: false }">
                                <input :type="show ? 'text' : 'password'" name="password" placeholder="••••••••" 
                                    class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500 transition outline-none">
                                <button type="button" @click="show = !show" class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 hover:text-indigo-500 transition">
                                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                            <p class="mt-4 text-[10px] text-slate-400 font-bold italic uppercase leading-relaxed">
                                <i class="fas fa-info-circle mr-1 text-indigo-400"></i> Password ini hanya berlaku sementara. Admin baru wajib melakukan pembaruan keamanan pada login pertama.
                            </p>
                        </div>

                        <div class="col-span-2 pt-10 flex flex-col md:flex-row gap-4">
                            <button type="submit" class="flex-[2] bg-indigo-600 text-white py-5 rounded-[1.5rem] font-black uppercase tracking-[0.2em] shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition active:scale-95">
                                Daftarkan Akun Admin
                            </button>
                            <button type="button" onclick="history.back()" class="flex-1 bg-slate-100 text-slate-400 py-5 rounded-[1.5rem] font-black uppercase tracking-widest hover:bg-slate-200 transition active:scale-95">
                                Batalkan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <p class="text-center mt-10 text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">
                HubTrans Management System &copy; 2026
            </p>
        </main>
    </div>

</body>
</html>