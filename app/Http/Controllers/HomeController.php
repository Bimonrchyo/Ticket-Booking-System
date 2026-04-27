<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $allowedModas = ['pesawat', 'bus', 'kereta', 'kapal'];

        $activeModa = $request->query('type', 'pesawat');

        if (! in_array($activeModa, $allowedModas)) {
            abort(400, 'Moda tidak valid.');
        }

        $modas = [
            ['id' => 'pesawat', 'icon' => 'fa-plane', 'label' => 'Pesawat'],
            ['id' => 'bus', 'icon' => 'fa-bus', 'label' => 'Bus'],
            ['id' => 'kereta', 'icon' => 'fa-train', 'label' => 'Kereta'],
            ['id' => 'kapal', 'icon' => 'fa-ship', 'label' => 'Kapal'],
        ];

        $lokasis = Lokasi::orderBy('nama')->get();

        // Ambil jadwal populer - 1 dari setiap moda transportasi untuk variasi
        $modasForRoute = ['pesawat', 'bus', 'kereta', 'kapal'];
        $popularRoutes = collect();

        foreach ($modasForRoute as $moda) {
            $route = Jadwal::with(['transportasi', 'asal', 'tujuan'])
                ->whereHas('transportasi', fn($q) => $q->where('tipe', $moda))
                ->withCount('bookings')
                ->orderByDesc('bookings_count')
                ->first();

            if ($route) {
                $popularRoutes->push($route);
            }
        }

        // Jika belum ada 3 rute, tambahkan dari jadwal yang ada
        if ($popularRoutes->count() < 3) {
            $additional = Jadwal::with(['transportasi', 'asal', 'tujuan'])
                ->whereNotIn('id', $popularRoutes->pluck('id'))
                ->withCount('bookings')
                ->orderByDesc('bookings_count')
                ->limit(3 - $popularRoutes->count())
                ->get();
            $popularRoutes = $popularRoutes->concat($additional);
        }

        return view('user.home', [
            'modas' => $modas,
            'active_moda' => $activeModa,
            'lokasis' => $lokasis,
            'popularRoutes' => $popularRoutes
        ]);
    }
}
