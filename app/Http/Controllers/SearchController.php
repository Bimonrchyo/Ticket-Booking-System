<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    private array $modaConfig = [
        'pesawat' => [
            'icon' => 'plane',
            'label' => 'Maskapai',
            'operators' => ['Lion Air Boeing 737-900', 'Batik Air Airbus A320', 'Garuda Indonesia Boeing 777', 'Citilink Airbus A320'],
        ],
        'bus' => [
            'icon' => 'bus',
            'label' => 'Operator Bus',
            'operators' => ['PO Sinar Jaya Premium', 'PO Sinar Jaya Ekonomi', 'PO Haryanto VIP', 'PO Haryanto Ekonomi'],
        ],
        'kereta' => [
            'icon' => 'train',
            'label' => 'Operator Kereta',
            'operators' => ['KAI Argo Bromo', 'KAI Eksekutif', 'KAI Bisnis', 'KAI Ekonomi'],
        ],
        'kapal' => [
            'icon' => 'ship',
            'label' => 'Operator Kapal',
            'operators' => ['Pelni KM. Dobonsolo', 'Pelni KM. Kelud', 'Pelni KM. Sinabung', 'Pelni KM. Ciremai'],
        ],
    ];
    public function index(Request $request)
    {
        $request->validate([
            'asal' => 'nullable|exists:lokasi,id',
            'tujuan' => 'nullable|different:asal|exists:lokasi,id',
            'tanggal' => 'nullable|date',
            'moda' => 'nullable|in:pesawat,bus,kereta,kapal'
        ]);

        $asal = $request->query('asal');
        $tujuan = $request->query('tujuan');
        $tanggalRaw = $request->query('tanggal');
        $moda = strtolower($request->query('moda', 'pesawat'));

        if ($asal == $tujuan) {
            return back()->withErrors('Asal dan tujuan tidak boleh sama.');
        }

        $asalModel = $asal ? Lokasi::find($asal) : null;
        $tujuanModel = $tujuan ? Lokasi::find($tujuan) : null;

        $tanggalFmt = 'Pilih tanggal';

        if ($tanggalRaw) {
            try {
                Carbon::setLocale('id');
                $tanggalFmt = Carbon::parse($tanggalRaw)
                    ->translatedFormat('l, j F Y');
            } catch (\Exception $e) {
                $tanggalFmt = $tanggalRaw;
            }
        }
        $config = $this->modaConfig[$moda] ?? $this->modaConfig['pesawat'];

        $modaIcon = $config['icon'];
        $operatorLabel = $config['label'];
        $operators = $config['operators'];

        $lokasis = Lokasi::all();

        $modas = collect($this->modaConfig)->map(function ($item, $key) {
            return [
                'id' => $key,
                'icon' => $item['icon'],
                'label' => ucfirst($key),
            ];
        });

        $active_moda = $moda;

        $selectedOperators = $request->query('operator');
        $departureTime = $request->query('departure_time'); // time range: 00-06, 06-12, 12-18, 18-24
        $sortBy = $request->query('sort_by', 'harga'); // harga (termurah) atau durasi (tercepat)

        $query = Jadwal::with(['transportasi', 'asal', 'tujuan'])
            ->when($asal, fn($q) => $q->where('asal_id', $asal))
            ->when($tujuan, fn($q) => $q->where('tujuan_id', $tujuan))
            ->when(
                $tanggalRaw,
                fn($q) =>
                $q->whereDate('waktu_berangkat', $tanggalRaw)
            )
            ->whereHas(
                'transportasi',
                fn($q) =>
                $q->where('tipe', $moda)
            );

        // Operator filter
        $query->when($selectedOperators, function ($q) use ($selectedOperators) {
            $q->whereHas('transportasi', function ($sub) use ($selectedOperators) {
                $sub->whereIn('nama_brand', $selectedOperators);
            });
        });

        // Departure time filter
        if ($departureTime) {
            $times = explode('-', $departureTime);
            if (count($times) == 2) {
                $startHour = intval($times[0]);
                $endHour = intval($times[1]);

                $driver = DB::connection()->getDriverName();
                if ($driver === 'sqlite') {
                    $query->whereRaw("CAST(strftime('%H', waktu_berangkat) AS INTEGER) >= ? AND CAST(strftime('%H', waktu_berangkat) AS INTEGER) < ?", [$startHour, $endHour]);
                } else {
                    $query->whereRaw("HOUR(waktu_berangkat) >= ? AND HOUR(waktu_berangkat) < ?", [$startHour, $endHour]);
                }
            }
        }

        // Sorting
        if ($sortBy === 'durasi') {
            $driver = DB::connection()->getDriverName();
            if ($driver === 'sqlite') {
                // SQLite: calculate duration in seconds and divide by 3600 for hours
                $query->orderByRaw('(julianday(waktu_tiba) - julianday(waktu_berangkat)) * 24');
            } else {
                // MySQL
                $query->orderByRaw('(TIME_TO_SEC(TIMEDIFF(waktu_tiba, waktu_berangkat)) / 3600)');
            }
        } else {
            $query->orderBy('harga');
        }

        $results = $query->get();

        // dd($results);

        return view('user.pencarian', compact(
            'asal',
            'tujuan',
            'asalModel',
            'tujuanModel',
            'tanggalFmt',
            'moda',
            'modas',
            'active_moda',
            'lokasis',
            'operators',
            'results',
            'modaIcon',
            'operatorLabel',
            'departureTime',
            'sortBy',
            'selectedOperators'
        ));
    }
}
