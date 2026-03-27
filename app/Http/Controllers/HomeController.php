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

        // Ambil jadwal populer (paling banyak booking)
        $popularRoutes = Jadwal::with(['transportasi', 'asal', 'tujuan'])
            ->withCount('bookings')
            ->orderByDesc('bookings_count')
            ->limit(3)
            ->get();

        return view('user.home', [
            'modas' => $modas,
            'active_moda' => $activeModa,
            'lokasis' => $lokasis,
            'popularRoutes' => $popularRoutes
        ]);
    }
}