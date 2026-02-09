<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Transport Hub | Pesan Tiket Mudah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-900 overflow-x-hidden">

    <nav class="bg-blue-700 p-4 shadow-md sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-white font-bold text-xl flex items-center gap-2">
                <i class="fas fa-route"></i> HubTrans
            <div class="hidden md:flex space-x-6 text-white items-center text-sm font-semibold">
                <a href="/home" class="text-orange-400 border-b-2 border-orange-400">Beranda</a>
                <a href="/history" class="hover:text-blue-200 ">Histori</a>
                <a href="/login" class="bg-orange-500 px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition">Sign in</a>
            </div>
        </div>
    </nav>

    <header class="relative bg-blue-600 h-65 md:h-60 flex items-center justify-center text-center text-white px-4">
        <div class="z-10">
            <h1 class="text-3xl md:text-5xl font-extrabold mb-2">Mau Pergi ke Mana?</h1>
            <p class="text-blue-100 text-sm md:text-lg">Cari tiket pesawat, bus, kereta, dan kapal dalam satu aplikasi.</p>
        </div>
        <i class="fas fa-plane fixed top-8 right-4 md:top-6 md:right-10 text-[120px] md:text-[200px] opacity-20 pointer-events-none z-0"></i>
    </header>

    <main class="container mx-auto px-4 -mt-8 md:-mt-12 pb-12">
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
            
            <div class="flex overflow-x-auto pb-4 mb-6 gap-4 no-scrollbar border-b mt-10">
                <?php
                $modas = [
                    ['id' => 'pesawat', 'icon' => 'fa-plane', 'label' => 'Pesawat'],
                    ['id' => 'bus', 'icon' => 'fa-bus', 'label' => 'Bus'],
                    ['id' => 'kereta', 'icon' => 'fa-train', 'label' => 'Kereta'],
                    ['id' => 'kapal', 'icon' => 'fa-ship', 'label' => 'Kapal'],
                ];
                
                $active_moda = isset($_GET['type']) ? $_GET['type'] : 'pesawat';

                foreach ($modas as $moda): 
                    $activeClass = ($active_moda == $moda['id']) ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-500';
                ?>
                    <a href="?type=<?= $moda['id'] ?>" class="flex flex-col items-center min-w-[80px] pb-2 transition <?= $activeClass ?>">
                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-100 mb-1">
                            <i class="fas <?= $moda['icon'] ?> text-xl"></i>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider"><?= $moda['label'] ?></span>
                    </a>
                <?php endforeach; ?>
            </div>

            <form action="/pencarian" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <input type="hidden" name="moda" value="<?= htmlspecialchars($active_moda) ?>">
                
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-600 mb-1 italic">Asal</label>
                    <div class="relative">
                        <i class="fas fa-map-marker-alt absolute left-3 top-3.5 text-gray-400"></i>
                        <input type="text" name="asal" placeholder="Kota Asal..." class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-600 mb-1 italic">Tujuan</label>
                    <div class="relative">
                        <i class="fas fa-location-arrow absolute left-3 top-3.5 text-gray-400"></i>
                        <input type="text" name="tujuan" placeholder="Kota Tujuan..." class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-600 mb-1 italic">Tanggal Pergi</label>
                    <div class="relative">
                        <i class="fas fa-calendar-alt absolute left-3 top-3.5 text-gray-400"></i>
                        <input type="date" name="tanggal" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <div class="flex flex-col justify-end">
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3.5 rounded-xl shadow-lg transform active:scale-95 transition">
                        CARI TIKET
                    </button>
                </div>
            </form>
        </div>

        <section class="mt-12">
            <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                Rekomendasi Rute Terpopuler
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php for($i=1; $i<=3; $i++): ?>
                <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
                    <img src="https://picsum.photos/400/200" alt="Destination" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <p class="text-xs text-blue-600 font-bold uppercase">Favorit Travelers</p>
                        <h3 class="font-bold text-lg text-gray-800">Jakarta → Bali</h3>
                        <p class="text-gray-500 text-sm mb-4">Mulai dari <span class="text-orange-500 font-bold text-lg">Rp 850.000</span></p>
                        <button class="w-full border border-blue-600 text-blue-600 py-2 rounded-lg font-semibold hover:bg-blue-50 transition text-sm">Cek Jadwal</button>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </section>
    </main>

    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t flex justify-around py-3 z-50">
        <a href="/home" class="flex flex-col items-center text-blue-600">
            <i class="fas fa-search text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">Cari</span>
        </a>
        <a href="/history" class="flex flex-col items-center text-gray-400">
            <i class="fas fa-history text-xl"></i>
            <span class="text-[10px] mt-1">Histori</span>
        </a>
        <a href="/login" class="flex flex-col items-center text-gray-400">
            <i class="fas fa-user text-xl"></i>
            <span class="text-[10px] mt-1">Akun</span>
        </a>
    </div>

</body>
</html>