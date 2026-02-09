<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - HubTrans</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans flex">

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

    <main class="flex-1 p-8 lg:ml-64">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-2xl font-black text-slate-800">Ringkasan Statistik</h2>
                <p class="text-sm text-slate-500 font-medium tracking-wide uppercase">Laporan Penjualan Tiket per Moda</p>
            </div>
            <div class="flex items-center gap-4">
                <button class="bg-white p-2 rounded-lg shadow-sm border border-gray-200 text-gray-400"><i class="fas fa-bell"></i></button>
                <div class="flex items-center gap-3 ml-4 bg-white p-1 pr-4 rounded-full shadow-sm border border-gray-100">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold">AD</div>
                    <span class="text-xs font-black text-slate-700 uppercase">Super Admin</span>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 hover:shadow-xl transition-transform transform hover:-translate-y-1">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-lg">+12.5%</span>
                </div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Pendapatan</p>
                <h3 class="text-2xl font-black text-slate-800 tracking-tighter">IDR 45.280.000</h3>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 hover:shadow-xl transition-transform transform hover:-translate-y-1">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-ticket"></i>
                    </div>
                    <span class="text-xs font-bold text-orange-500 bg-orange-50 px-2 py-1 rounded-lg">Target: 80%</span>
                </div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tiket Terjual</p>
                <h3 class="text-2xl font-black text-slate-800 tracking-tighter">1,245 <span class="text-xs text-gray-400">Pcs</span></h3>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 hover:shadow-xl transition-transform transform hover:-translate-y-1">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Pengguna Aktif</p>
                <h3 class="text-2xl font-black text-slate-800 tracking-tighter">892 <span class="text-xs text-gray-400">User</span></h3>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 hover:shadow-xl transition-transform transform hover:-translate-y-1">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Menunggu Verifikasi</p>
                <h3 class="text-2xl font-black text-slate-800 tracking-tighter">18 <span class="text-xs text-gray-400">Pesanan</span></h3>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-md border border-gray-200 hover:shadow-xl transition-transform transform hover:-translate-y-1">
                <h3 class="font-black text-slate-800 mb-6 uppercase text-sm">Tren Penjualan Mingguan</h3>
                <canvas id="salesChart" height="150"></canvas>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-200 hover:shadow-xl transition-transform transform hover:-translate-y-1">
                <h3 class="font-black text-slate-800 mb-6 uppercase text-sm">Distribusi Moda</h3>
                <canvas id="modeChart"></canvas>
                <div class="mt-8 space-y-3">
                    <div class="flex justify-between text-xs font-bold">
                        <span class="text-blue-500"><i class="fas fa-plane mr-2"></i> PESAWAT</span>
                        <span class="text-slate-700">45%</span>
                    </div>
                    <div class="flex justify-between text-xs font-bold">
                        <span class="text-orange-500"><i class="fas fa-train mr-2"></i> KERETA</span>
                        <span class="text-slate-700">35%</span>
                    </div>
                    <div class="flex justify-between text-xs font-bold">
                        <span class="text-green-500"><i class="fas fa-bus mr-2"></i> BUS</span>
                        <span class="text-slate-700">20%</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Chart Penjualan (Line)
        const ctxSales = document.getElementById('salesChart').getContext('2d');
        new Chart(ctxSales, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Penjualan',
                    data: [12, 19, 15, 25, 22, 35, 30],
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 4,
                    pointRadius: 0
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { 
                    y: { display: false },
                    x: { grid: { display: false } }
                }
            }
        });

        // Chart Moda (Doughnut)
        const ctxMode = document.getElementById('modeChart').getContext('2d');
        new Chart(ctxMode, {
            type: 'doughnut',
            data: {
                labels: ['Pesawat', 'Kereta', 'Bus'],
                datasets: [{
                    data: [45, 35, 20],
                    backgroundColor: ['#3b82f6', '#f97316', '#22c55e'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                cutout: '80%'
            }
        });
    </script>
</body>
</html>