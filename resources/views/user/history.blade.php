<?php
// Simulasi Data Pesanan dari Database
$daftar_pesanan = [
    [
        'id' => 'HT-88120',
        'moda' => 'bus',
        'asal' => 'Jakarta',
        'tujuan' => 'Bandung',
        'tanggal' => '25 Jan 2026, 08:00 WIB',
        'total' => '150.000',
        'status' => 'PENDING', // Menunggu Pembayaran
        'warna' => 'yellow'
    ],
    [
        'id' => 'HT-77122',
        'moda' => 'pesawat',
        'asal' => 'Jakarta',
        'tujuan' => 'Denpasar (Bali)',
        'tanggal' => '12 Feb 2026, 14:20 WIB',
        'total' => '1.250.000',
        'status' => 'SUCCESS', // Selesai
        'warna' => 'green'
    ],
    [
        'id' => 'HT-77501',
        'moda' => 'kereta',
        'asal' => 'Surabaya',
        'tujuan' => 'Yogyakarta',
        'tanggal' => '05 Jan 2026',
        'total' => '250.000',
        'status' => 'CANCELLED', // Dibatalkan
        'warna' => 'red'
    ]
];

// Fungsi pembantu untuk icon moda
function getIcon($moda) {
    switch ($moda) {
        case 'pesawat': return 'fa-plane';
        case 'kereta': return 'fa-train';
        case 'bus': return 'fa-bus';
        default: return 'fa-ticket-alt';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Pesanan - HubTrans</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">

    <nav class="bg-blue-700 p-4 shadow-md sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-white font-bold text-xl flex items-center gap-2">
                <i class="fas fa-route"></i> HubTrans
            <div class="hidden md:flex space-x-6 text-white items-center text-sm font-semibold">
                <a href="/home" class="hover:text-blue-200">Beranda</a>
                <a href="/history" class="text-orange-400 border-b-2 border-orange-400">Histori</a>
                <div class="flex items-center gap-2 bg-blue-800 px-3 py-1.5 rounded-xl">
                    <i class="fas fa-user-circle text-lg"></i>
                    <span>Budi Santoso</span>
                </div>
            </div>
        </div>
    </nav>


    <div class="max-w-4xl mx-auto p-6 space-y-4">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tighter">Histori Pesanan</h2>
                <p class="text-xs text-gray-400">Pantau semua aktivitas perjalanan dan transaksi Anda.</p>
            </div>
            <div class="flex bg-gray-200/50 p-1 rounded-xl text-[10px] font-bold">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-sm">Semua</button>
                <button class="text-gray-500 px-4 py-2 rounded-lg">Selesai</button>
                <button class="text-gray-500 px-4 py-2 rounded-lg">Dibatalkan</button>
            </div>
        </div>

        <?php foreach ($daftar_pesanan as $order): ?>
            <div class="bg-white rounded-3xl p-6 shadow-lg border border-gray-200 ring-1 ring-gray-50 border-l-4 border-l-<?php echo $order['warna']; ?>-500 flex flex-col md:flex-row items-center gap-6 relative overflow-hidden">
                
                <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-blue-600 text-xl shadow-inner">
                    <i class="fas <?php echo getIcon($order['moda']); ?>"></i>
                </div>

                <div class="flex-1 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-2 mb-1">
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest"><?php echo $order['id']; ?></span>
                        
                        <?php if ($order['status'] == 'PENDING'): ?>
                            <span class="text-[9px] font-black bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded uppercase italic">Menunggu Pembayaran</span>
                        <?php elseif ($order['status'] == 'SUCCESS'): ?>
                            <span class="text-[9px] font-black bg-green-100 text-green-700 px-2 py-0.5 rounded uppercase italic">Selesai</span>
                        <?php else: ?>
                            <span class="text-[9px] font-black bg-red-100 text-red-700 px-2 py-0.5 rounded uppercase italic">Dibatalkan</span>
                        <?php endif; ?>
                    </div>
                    <h4 class="font-black text-gray-800 text-lg"><?php echo $order['asal']; ?> &rarr; <?php echo $order['tujuan']; ?></h4>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wide"><?php echo $order['tanggal']; ?></p>
                </div>

                <div class="text-right hidden md:block px-6 border-r border-gray-50">
                    <p class="text-[9px] font-black text-gray-300 uppercase">Total Bayar</p>
                    <p class="font-black text-blue-700 tracking-tighter">IDR <?php echo $order['total']; ?></p>
                </div>

                <div class="flex flex-row md:flex-col gap-3 w-full md:w-40">
                    <?php if ($order['status'] == 'PENDING'): ?>
                        <a href="checkout.php?id=<?php echo $order['id']; ?>" class="w-full flex items-center justify-center gap-2 text-blue-600 font-black text-[10px] hover:text-blue-800 transition py-2 group uppercase tracking-widest">
                            Detail & Bayar 
                            <i class="fas fa-chevron-right text-[8px] group-hover:translate-x-1 transition-transform"></i>
                        </a>

                    <?php elseif ($order['status'] == 'SUCCESS'): ?>
                        <button class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2.5 rounded-xl text-[10px] font-black transition flex items-center justify-center gap-2 shadow-lg shadow-green-100 uppercase tracking-widest">
                            <i class="fas fa-download"></i> E-Tiket
                        </button>
                        <button class="flex-1 border-2 border-gray-100 hover:bg-gray-50 text-gray-500 px-4 py-2.5 rounded-xl text-[10px] font-black transition uppercase tracking-widest">
                            Struk
                        </button>

                    <?php else: ?>
                        <button class="flex-1 border border-gray-100 text-gray-400 px-4 py-2 rounded-xl text-[10px] font-black transition uppercase tracking-widest cursor-not-allowed">
                            Detail
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t flex justify-around py-3 z-50">
        <a href="/home" class="flex flex-col items-center text-gray -400">
            <i class="fas fa-search text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">Cari</span>
        </a>
        <a href="/history" class="flex flex-col items-center text-blue-600">
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