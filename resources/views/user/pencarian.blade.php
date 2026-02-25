    <!DOCTYPE html>
    <html lang="id">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Hasil Pencarian Pesawat | HubTrans</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
            <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        </head>

        <body class="bg-gray-50" x-data="{ showFilter: false }">

            @php
                $icon = match ($moda) {
                    'pesawat' => 'plane',
                    'bus' => 'bus',
                    'kereta' => 'train',
                    'kapal' => 'ship',
                    default => 'plane',
                };
            @endphp
            <nav class="sticky top-0 z-40 bg-blue-700 p-4 text-white shadow-md">
                <div class="mx-auto flex max-w-6xl items-center justify-between px-2">
                    <div class="flex items-center gap-4">
                        <a class="rounded-lg border border-white/20 bg-blue-800/50 px-3 py-2 text-xs transition hover:bg-blue-600"
                            href="javascript:history.back()">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div>
                            <div class="flex items-center gap-4">
                                <i class="fas fa-{{ $modaIcon }} text-xs opacity-50"></i>
                                <div>
                                    <h1 class="flex items-center gap-2 text-lg font-bold">
                                        {{ $asalModel->nama ?? 'Asal' }} <i class="fas fa-{{ $icon }} text-xs opacity-50"></i>
                                        {{ $tujuanModel->nama ?? 'Tujuan' }}
                                    </h1>
                                    <p class="text-[10px] font-semibold uppercase tracking-widest text-blue-100">
                                        {{ $tanggalFmt }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a
                        class="rounded-lg border border-white/40 px-4 py-2 text-xs font-bold transition hover:bg-white hover:text-blue-700"
                        href="/home">UBAH</a>
                </div>
            </nav>

            <div class="mx-auto flex max-w-6xl flex-col gap-8 px-4 py-8 lg:flex-row">
                <aside class="hidden w-72 space-y-6 lg:block">
                    <div
                        class="transform rounded-2xl border border-gray-300 bg-white p-6 shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1">
                        <div class="mb-6 flex items-center justify-between">
                            <h3 class="font-bold text-gray-800">Filter</h3>
                            <button class="text-xs font-bold text-blue-600">Reset</button>
                        </div>

                        <div class="mb-6">
                            <label class="text-xs font-black uppercase tracking-wider text-gray-400">Transit</label>
                            <div class="mt-3 space-y-3">
                                <label class="group flex cursor-pointer items-center justify-between text-sm">
                                    <span class="text-gray-600 transition group-hover:text-blue-600">Langsung</span>
                                    <input class="rounded text-blue-600 focus:ring-blue-500" type="checkbox" checked>
                                </label>
                                <label class="group flex cursor-pointer items-center justify-between text-sm">
                                    <span class="text-gray-600 transition group-hover:text-blue-600">1 Transit</span>
                                    <input class="rounded text-blue-600 focus:ring-blue-500" type="checkbox">
                                </label>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="text-xs font-black uppercase tracking-wider text-gray-400">Waktu Keberangkatan</label>
                            <div class="mt-3 grid grid-cols-2 gap-2">
                                <button
                                    class="rounded-xl border border-gray-200 p-2 text-[10px] font-bold transition hover:border-blue-500 hover:bg-blue-50">00:00
                                    - 06:00</button>
                                <button class="rounded-xl border border-blue-500 bg-blue-50 p-2 text-[10px] font-bold text-blue-600">06:00 -
                                    12:00</button>
                                <button
                                    class="rounded-xl border border-gray-200 p-2 text-[10px] font-bold transition hover:border-blue-500 hover:bg-blue-50">12:00
                                    - 18:00</button>
                                <button
                                    class="rounded-xl border border-gray-200 p-2 text-[10px] font-bold transition hover:border-blue-500 hover:bg-blue-50">18:00
                                    - 24:00</button>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="text-xs font-black uppercase tracking-wider text-gray-400">{{ $operatorLabel }}</label>
                            @foreach ($operators as $op)
                                <label class="flex items-center gap-3 text-sm">
                                    <input class="rounded text-blue-600" name="operator[]" type="checkbox" value="{{ $op }}" checked>
                                    <span class="text-gray-600">{{ $op }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </aside>


                <main class="flex-1 space-y-4">
                    @foreach ($results as $index => $r)
                        <div
                            class="group relative overflow-hidden rounded-3xl border border-gray-300 bg-white shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1 hover:shadow-[0_20px_60px_rgba(0,0,0,0.12)]">
                            <div class="flex flex-col gap-6 p-6 lg:flex-row lg:items-center">

                                <div class="flex items-center gap-4 lg:w-48">
                                    <div
                                        class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-lg font-black italic text-blue-600 shadow-inner">
                                        {{ strtoupper(substr($r->transportasi->nama_brand, 0, 2)) }}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-black text-gray-800">{{ $r->transportasi->nama_brand }}</h4>
                                        <div class="mt-1 flex items-center gap-2">
                                            <span
                                                class="rounded bg-gray-100 px-2 py-0.5 text-[9px] font-bold uppercase text-gray-500">{{ $r->transportasi->kode_identitas }}</span>
                                            <span class="text-[9px] font-bold italic text-blue-600">{{ ucfirst($r->transportasi->tipe) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-1 items-center justify-between gap-6 lg:justify-center lg:gap-16">
                                    <div class="text-center">
                                        <span
                                            class="block text-2xl font-black tracking-tighter text-gray-900">{{ \Carbon\Carbon::parse($r->waktu_berangkat)->format('H:i') }}</span>
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-gray-400">{{ strtoupper(substr($r->asal->kode, 0, 3)) }}</span>
                                    </div>

                                    <div class="flex max-w-[120px] flex-1 flex-col items-center">
                                        <span class="mb-1 text-[9px] font-black text-gray-400">{{ $r->durasi }}</span>
                                        <div class="flex w-full items-center gap-1">
                                            <div class="h-1.5 w-1.5 rounded-full border-2 border-gray-200"></div>
                                            <div class="relative h-[2px] flex-1 bg-gray-100">
                                                <i
                                                    class="fas {{ $moda == 'kereta' ? 'fa-train' : ($moda == 'bus' ? 'fa-bus' : ($moda == 'kapal' ? 'fa-ship' : 'fa-plane')) }} absolute -top-1.5 left-1/2 -translate-x-1/2 text-[10px] text-blue-200"></i>
                                            </div>
                                            <div class="h-1.5 w-1.5 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.5)]"></div>
                                        </div>
                                        {{-- <span --}}
                                        {{-- class="mt-1 text-[9px] font-black uppercase tracking-tighter text-green-500">{{ $r['features'] && in_array('Langsung', $r['features']) ? 'Langsung' : '' }}</span> --}}
                                    </div>

                                    <div class="text-center">
                                        <span
                                            class="block text-2xl font-black tracking-tighter text-gray-900">{{ \Carbon\Carbon::parse($r->waktu_tiba)->format('H:i') }}</span>
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-gray-400">{{ strtoupper(substr($r->tujuan->kode, 0, 3)) }}</span>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center justify-between gap-3 border-t border-gray-50 pt-4 lg:flex-col lg:items-end lg:border-l lg:border-t-0 lg:pl-10 lg:pt-0">
                                    <div class="text-right">
                                        @if ($r->stok_tersedia <= 3)
                                            <span class="text-[9px] font-black uppercase text-red-500">
                                                Sisa {{ $r->stok_tersedia }} Kursi!
                                            </span>
                                        @endif
                                        <p class="text-2xl font-black tracking-tighter text-orange-500">Rp {{ number_format($r->harga, 0, ',', '.') }}
                                        </p>
                                        <p class="text-[9px] font-bold uppercase text-gray-400">Sudah Termasuk Pajak</p>
                                    </div>
                                    <a class="rounded-xl bg-blue-600 px-8 py-3 text-xs font-black uppercase tracking-widest text-white shadow-lg shadow-blue-100 transition hover:bg-blue-700 active:scale-95" href="{{ route('booking.create', $r->id) }}">
                                        Pilih
                                    </a>
                                </div>
                            </div>

                            {{-- <div class="hidden gap-4 border-t border-gray-50 bg-gray-50 px-6 py-2 lg:flex">
                                @if (!empty($r['features']) && is_array($r['features']))
                                    @foreach ($r['features'] as $f)
                                        <span class="text-[9px] font-bold text-gray-500"><i
                                                class="fas {{ $f == 'Bagasi 20kg' || strtolower($f) == 'bagasi 20kg' ? 'fa-suitcase-rolling' : ($f == 'Makan' || strtolower($f) == 'makan' ? 'fa-utensils' : ($f == 'USB Port' || strtolower($f) == 'usb port' ? 'fa-plug' : ($f == 'AC' ? 'fa-wind' : 'fa-check'))) }} mr-1"></i>
                                            {{ $f }}</span>
                                    @endforeach
                                @endif
                            </div> --}}
                        </div>
                    @endforeach

                </main>
            </div>

            <div class="fixed bottom-6 left-1/2 z-50 -translate-x-1/2 lg:hidden">
                <button
                    class="flex items-center gap-3 rounded-2xl bg-blue-700 px-8 py-4 text-sm font-black uppercase tracking-widest text-white shadow-2xl"
                    @click="showFilter = true">
                    <i class="fas fa-sliders-h"></i> Filter
                </button>
            </div>

            <div class="fixed inset-0 z-50 bg-black/60 lg:hidden" x-show="showFilter" x-transition.opacity
                @click="showFilter = false"></div>
            <div class="fixed bottom-0 left-0 right-0 z-50 max-h-[90vh] overflow-y-auto rounded-t-[40px] bg-white p-8 lg:hidden"
                x-show="showFilter" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-y-full"
                x-transition:enter-end="translate-y-0">

                <div class="mx-auto mb-8 h-1.5 w-12 rounded-full bg-gray-200"></div>
                <h3 class="mb-6 text-xl font-black uppercase tracking-tighter text-gray-800">Filter Penerbangan</h3>

                <div class="space-y-8">
                    <div>
                        <label class="text-xs font-black uppercase tracking-widest text-gray-400">Urutkan</label>
                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <button class="rounded-2xl bg-blue-600 py-3 text-xs font-bold text-white">Termurah</button>
                            <button class="rounded-2xl border border-gray-200 py-3 text-xs font-bold">Tercepat</button>
                        </div>
                    </div>
                </div>

                <button
                    class="mt-10 w-full rounded-2xl bg-blue-700 py-5 font-black uppercase tracking-widest text-white shadow-xl shadow-blue-100"
                    @click="showFilter = false">Terapkan</button>
            </div>

        </body>

    </html>
