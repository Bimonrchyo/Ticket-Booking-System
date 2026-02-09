<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Armada - HubTrans</title>
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
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Daftar Armada</h2>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Semua Unit Kendaraan HubTrans</p>
            </div>
            <a href="transportasi-create.php" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition shadow-lg shadow-blue-100">
                + Tambah Unit
            </a>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Unit & Moda</th>
                        <th class="p-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">ID Unit</th>
                        <th class="p-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Kapasitas</th>
                        <th class="p-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="p-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm font-bold">
                    <?php 
                    $armada = [
                        ['nama' => 'Boeing 737', 'id' => 'PK-GAA', 'moda' => 'Pesawat', 'icon' => 'fa-plane', 'kursi' => '180'],
                        ['nama' => 'Scania K410IB', 'id' => 'HT-BUS-01', 'moda' => 'Bus', 'icon' => 'fa-bus', 'kursi' => '32'],
                        ['nama' => 'Argo Bromo', 'id' => 'KAI-EX-01', 'moda' => 'Kereta', 'icon' => 'fa-train', 'kursi' => '50'],
                    ];
                    foreach($armada as $row): 
                    ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center"><i class="fas <?php echo $row['icon']; ?>"></i></div>
                                <div>
                                    <p class="text-slate-800"><?php echo $row['nama']; ?></p>
                                    <p class="text-[9px] text-gray-400 uppercase"><?php echo $row['moda']; ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="p-6 text-gray-500 font-mono"><?php echo $row['id']; ?></td>
                        <td class="p-6 text-slate-600"><?php echo $row['kursi']; ?> Kursi</td>
                        <td class="p-6"><span class="bg-green-100 text-green-700 text-[9px] font-black px-3 py-1 rounded-full uppercase italic">Aktif</span></td>
                        <td class="p-6 text-center">
                            <button class="text-blue-500 hover:text-blue-700 mr-2"><i class="fas fa-edit"></i></button>
                            <button class="text-red-400 hover:text-red-600"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>