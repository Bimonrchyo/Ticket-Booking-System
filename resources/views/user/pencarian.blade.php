<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian Pesawat | HubTrans</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50" x-data="{ showFilter: false }">

<?php
use Carbon\Carbon;
Carbon::setLocale('id');
$asal = request()->query('asal') ?? '';
$tujuan = request()->query('tujuan') ?? '';
$tanggal_raw = request()->query('tanggal') ?? '';
if ($tanggal_raw) {
    try {
        $dt = Carbon::parse($tanggal_raw);
        $tanggal_fmt = $dt->translatedFormat('l, j F Y');
    } catch (\Exception $e) {
        $tanggal_fmt = date('d M Y', strtotime($tanggal_raw));
    }
} else {
    $tanggal_fmt = 'Pilih tanggal';
}
$asal_display = $asal ? htmlspecialchars($asal, ENT_QUOTES, 'UTF-8') : 'Asal';
$tujuan_display = $tujuan ? htmlspecialchars($tujuan, ENT_QUOTES, 'UTF-8') : 'Tujuan';
// Moda/logo handling
$moda = strtolower(request()->query('moda') ?? 'pesawat');
switch($moda) {
    case 'bus':
        $moda_icon = '<i class="fas fa-bus text-xl"></i>';
        $moda_label = 'Bus';
        break;
    case 'kereta':
        $moda_icon = '<i class="fas fa-train text-xl"></i>';
        $moda_label = 'Kereta';
        break;
    case 'kapal':
        $moda_icon = '<i class="fas fa-ship text-xl"></i>';
        $moda_label = 'Kapal';
        break;
    case 'pesawat':
    default:
        $moda_icon = '<i class="fas fa-plane text-xl"></i>';
        $moda_label = 'Pesawat';
        break;
}
$moda_icon_html = '<div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-white">' . $moda_icon . '</div>';

// Operators per moda for filter
$operators_map = [
    'pesawat' => ['Garuda Indonesia','Citilink','Lion Air'],
    'bus' => ['TransJakarta','Rosalia Indah','Sinar Jaya'],
    'kereta' => ['Kereta Api Indonesia','Argo Parahyangan','Sriwijaya'],
    'kapal' => ['Pelni Express','ASDP']
];
$operators = $operators_map[$moda] ?? $operators_map['pesawat'];
?>

    <nav class="bg-blue-700 text-white p-4 shadow-md sticky top-0 z-40">
        <div class="max-w-6xl mx-auto flex justify-between items-center px-2">
            <div class="flex items-center gap-4">
                <a href="javascript:history.back()" class="text-xs bg-blue-800/50 px-3 py-2 rounded-lg border border-white/20 hover:bg-blue-600 transition">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <div class="flex items-center gap-4">
                        <?= $moda_icon_html ?>
                        <div>
                            <h1 class="font-bold text-lg flex items-center gap-2">
                                <?= $asal_display ?> <i class="fas fa-<?=$moda == 'pesawat' ? 'plane' : ($moda == 'bus' ? 'bus' : ($moda == 'kereta' ? 'train' : 'ship'))?> text-xs opacity-50"></i> <?= $tujuan_display ?>
                            </h1>
                            <p class="text-[10px] text-blue-100 uppercase tracking-widest font-semibold">
                                <?= $tanggal_fmt ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="/home" class="text-xs font-bold border border-white/40 px-4 py-2 rounded-lg hover:bg-white hover:text-blue-700 transition">UBAH</a>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-8 flex flex-col lg:flex-row gap-8">
        
        <aside class="hidden lg:block w-72 space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-2xl border border-gray-300 ring-1 ring-gray-100 transform hover:-translate-y-1 transition-all">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-gray-800">Filter</h3>
                    <button class="text-xs text-blue-600 font-bold">Reset</button>
                </div>
                
                <div class="mb-6">
                    <label class="text-xs font-black text-gray-400 uppercase tracking-wider">Transit</label>
                    <div class="mt-3 space-y-3">
                        <label class="flex justify-between items-center text-sm cursor-pointer group">
                            <span class="text-gray-600 group-hover:text-blue-600 transition">Langsung</span>
                            <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500" checked>
                        </label>
                        <label class="flex justify-between items-center text-sm cursor-pointer group">
                            <span class="text-gray-600 group-hover:text-blue-600 transition">1 Transit</span>
                            <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500">
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="text-xs font-black text-gray-400 uppercase tracking-wider">Waktu Keberangkatan</label>
                    <div class="grid grid-cols-2 gap-2 mt-3">
                        <button class="border border-gray-200 p-2 rounded-xl text-[10px] font-bold hover:border-blue-500 hover:bg-blue-50 transition">00:00 - 06:00</button>
                        <button class="border border-blue-500 bg-blue-50 p-2 rounded-xl text-[10px] font-bold text-blue-600">06:00 - 12:00</button>
                        <button class="border border-gray-200 p-2 rounded-xl text-[10px] font-bold hover:border-blue-500 hover:bg-blue-50 transition">12:00 - 18:00</button>
                        <button class="border border-gray-200 p-2 rounded-xl text-[10px] font-bold hover:border-blue-500 hover:bg-blue-50 transition">18:00 - 24:00</button>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="text-xs font-black text-gray-400 uppercase tracking-wider"><?php echo $moda_label === 'Pesawat' ? 'Maskapai' : ($moda_label === 'Kereta' ? 'Operator Kereta' : ($moda_label === 'Bus' ? 'Operator Bus' : 'Operator Kapal')); ?></label>
                    <div class="mt-3 space-y-3">
                        <?php foreach($operators as $op): ?>
                        <label class="flex items-center text-sm gap-3">
                            <input type="checkbox" name="operator[]" value="<?= htmlspecialchars($op, ENT_QUOTES, 'UTF-8') ?>" class="rounded text-blue-600" checked>
                            <span class="text-gray-600"><?php echo $op; ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 space-y-4">
            
            <?php
            // Dataset dynamic per moda
            if (!isset($moda)) { $moda = 'pesawat'; }

            if ($moda === 'bus') {
                $results = [
                    ['logo'=>'BS','name'=>'TransJakarta','code'=>'TJ-01','dep'=>'07:00','arr'=>'09:15','from_code'=>'GMR','to_code'=>'BDG','duration'=>'2j 15m','price'=>'120.000','tag'=>'AC','features'=>['AC','Reclining Seat','Toilet'] ],
                    ['logo'=>'RB','name'=>'Rosalia Indah','code'=>'RI-23','dep'=>'10:00','arr'=>'13:30','from_code'=>'GMR','to_code'=>'BDG','duration'=>'3j 30m','price'=>'150.000','tag'=>'Executive','features'=>['AC','Snack','WiFi'] ],
                ];
            } elseif ($moda === 'kereta') {
                $results = [
                    ['logo'=>'KA','name'=>'Kereta Api Indonesia','code'=>'KA-101','dep'=>'08:30','arr'=>'11:00','from_code'=>'GMR','to_code'=>'BDG','duration'=>'2j 30m','price'=>'95.000','tag'=>'Ekonomi','features'=>['Reserved Seat','Toilet','AC'] ],
                    ['logo'=>'AR','name'=>'Argo Parahyangan','code'=>'AR-45','dep'=>'09:45','arr'=>'12:15','from_code'=>'GMR','to_code'=>'BDG','duration'=>'2j 30m','price'=>'200.000','tag'=>'Eksekutif','features'=>['Recliner','Makan','AC'] ],
                ];
            } elseif ($moda === 'kapal') {
                $results = [
                    ['logo'=>'KP','name'=>'Pelni Express','code'=>'PL-12','dep'=>'06:00','arr'=>'12:00','from_code'=>'GMR','to_code'=>'BDG','duration'=>'6j 0m','price'=>'250.000','tag'=>'Kabin','features'=>['Kabin','Makan','Toilet'] ],
                ];
            } else {
                // default pesawat
                $results = [
                    ['logo' => 'GI', 'name' => 'Garuda Indonesia', 'code' => 'GA-123', 'dep' => '08:00', 'arr' => '09:30', 'from_code'=>'HLP','to_code'=>'SUB','duration'=>'1j 30m','price' => '1.450.000', 'tag' => 'Full Service','features'=>['Bagasi 20kg','Makan','USB Port'] ],
                    ['logo' => 'CL', 'name' => 'Citilink', 'code' => 'QG-882', 'dep' => '10:45', 'arr' => '12:15','from_code'=>'HLP','to_code'=>'SUB','duration'=>'1j 30m','price' => '850.000', 'tag' => 'LCC','features'=>['Bagasi 20kg','Makan','USB Port'] ],
                    ['logo' => 'LA', 'name' => 'Lion Air', 'code' => 'JT-661', 'dep' => '13:00', 'arr' => '14:30','from_code'=>'HLP','to_code'=>'SUB','duration'=>'1j 30m','price' => '720.000', 'tag' => 'LCC','features'=>['Bagasi 20kg','Makan','USB Port'] ]
                ];
            }

            foreach($results as $index => $r):
            ?>
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-300 ring-1 ring-gray-100 hover:shadow-[0_20px_60px_rgba(0,0,0,0.12)] hover:-translate-y-1 transition-all group relative overflow-hidden">
                <div class="p-6 flex flex-col lg:flex-row lg:items-center gap-6">
                    
                        <div class="flex items-center gap-4 lg:w-48">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center font-black text-blue-600 text-lg italic shadow-inner">
                            <?php echo $r['logo']; ?>
                        </div>
                        <div>
                            <h4 class="font-black text-gray-800 text-sm"><?php echo $r['name']; ?></h4>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-[9px] bg-gray-100 text-gray-500 px-2 py-0.5 rounded font-bold uppercase"><?php echo $r['code']; ?></span>
                                <span class="text-[9px] text-blue-600 font-bold italic"><?php echo $r['tag']; ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 flex items-center justify-between lg:justify-center gap-6 lg:gap-16">
                        <div class="text-center">
                            <span class="block font-black text-2xl text-gray-900 tracking-tighter"><?php echo $r['dep']; ?></span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest"><?php echo $r['from_code'] ?? '---'; ?></span>
                        </div>

                        <div class="flex-1 max-w-[120px] flex flex-col items-center">
                            <span class="text-[9px] text-gray-400 font-black mb-1"><?php echo $r['duration']; ?></span>
                            <div class="w-full flex items-center gap-1">
                                <div class="w-1.5 h-1.5 rounded-full border-2 border-gray-200"></div>
                                <div class="flex-1 h-[2px] bg-gray-100 relative">
                                    <i class="fas <?php echo ($moda=='kereta')? 'fa-train' : (($moda=='bus')? 'fa-bus' : (($moda=='kapal')? 'fa-ship' :  'fa-plane')); ?> absolute -top-1.5 left-1/2 -translate-x-1/2 text-[10px] text-blue-200"></i>
                                </div>
                                <div class="w-1.5 h-1.5 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.5)]"></div>
                            </div>
                            <span class="text-[9px] text-green-500 font-black mt-1 uppercase tracking-tighter"><?php echo ($r['features'] && in_array('Langsung',$r['features']))? 'Langsung' : ''; ?></span>
                        </div>

                        <div class="text-center">
                            <span class="block font-black text-2xl text-gray-900 tracking-tighter"><?php echo $r['arr']; ?></span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest"><?php echo $r['to_code'] ?? '---'; ?></span>
                        </div>
                    </div>

                    <div class="border-t lg:border-t-0 lg:border-l border-gray-50 pt-4 lg:pt-0 lg:pl-10 flex lg:flex-col justify-between items-center lg:items-end gap-3">
                        <div class="text-right">
                            <?php if($index == 0): ?>
                                <span class="text-red-500 text-[9px] font-black uppercase tracking-tighter block mb-1">Sisa 2 Kursi!</span>
                            <?php endif; ?>
                            <p class="text-orange-500 font-black text-2xl tracking-tighter">Rp <?php echo $r['price']; ?></p>
                            <p class="text-[9px] text-gray-400 font-bold uppercase">Sudah Termasuk Pajak</p>
                        </div>
                        <button class="bg-blue-600 text-white px-8 py-3 rounded-xl font-black text-xs hover:bg-blue-700 transition shadow-lg shadow-blue-100 active:scale-95 uppercase tracking-widest">Pilih</button>
                    </div>
                </div>
                
                <div class="hidden lg:flex bg-gray-50 px-6 py-2 gap-4 border-t border-gray-50">
                    <?php if(!empty($r['features']) && is_array($r['features'])): foreach($r['features'] as $f): ?>
                        <span class="text-[9px] text-gray-500 font-bold"><i class="fas <?php echo ($f=='Bagasi 20kg' || strtolower($f)=='bagasi 20kg')? 'fa-suitcase-rolling' : (($f=='Makan' || strtolower($f)=='makan')? 'fa-utensils' : (($f=='USB Port' || strtolower($f)=='usb port')? 'fa-plug' : (($f=='AC')? 'fa-wind' : 'fa-check'))); ?> mr-1"></i> <?php echo $f; ?></span>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <?php endforeach; ?>

        </main>
    </div>

    <div class="lg:hidden fixed bottom-6 left-1/2 -translate-x-1/2 z-50">
        <button @click="showFilter = true" class="bg-blue-700 text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-3 font-black text-sm uppercase tracking-widest">
            <i class="fas fa-sliders-h"></i> Filter
        </button>
    </div>

    <div x-show="showFilter" x-transition.opacity class="fixed inset-0 bg-black/60 z-50 lg:hidden" @click="showFilter = false"></div>
    <div x-show="showFilter" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         class="fixed bottom-0 left-0 right-0 z-50 lg:hidden bg-white rounded-t-[40px] p-8 max-h-[90vh] overflow-y-auto">
        
        <div class="w-12 h-1.5 bg-gray-200 rounded-full mx-auto mb-8"></div>
        <h3 class="text-xl font-black text-gray-800 mb-6 uppercase tracking-tighter">Filter Penerbangan</h3>
        
        <div class="space-y-8">
            <div>
                <label class="font-black text-xs uppercase text-gray-400 tracking-widest">Urutkan</label>
                <div class="grid grid-cols-2 gap-3 mt-4">
                    <button class="bg-blue-600 text-white py-3 rounded-2xl text-xs font-bold">Termurah</button>
                    <button class="border border-gray-200 py-3 rounded-2xl text-xs font-bold">Tercepat</button>
                </div>
            </div>
        </div>

        <button @click="showFilter = false" class="w-full bg-blue-700 text-white py-5 rounded-2xl mt-10 font-black uppercase tracking-widest shadow-xl shadow-blue-100">Terapkan</button>
    </div>

</body>
</html> 