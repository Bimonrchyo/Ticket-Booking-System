<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchController extends Controller
{
    private array $modaConfig = [
        'pesawat' => [
            'icon' => 'plane',
            'label' => 'Maskapai',
            'operators' => ['Garuda Indonesia', 'Citilink', 'Lion Air'],
        ],
        'bus' => [
            'icon' => 'bus',
            'label' => 'Operator Bus',
            'operators' => ['TransJakarta', 'Rosalia Indah', 'Sinar Jaya'],
        ],
        'kereta' => [
            'icon' => 'train',
            'label' => 'Operator Kereta',
            'operators' => ['Kereta Api Indonesia', 'Argo Parahyangan'],
        ],
        'kapal' => [
            'icon' => 'ship',
            'label' => 'Operator Kapal',
            'operators' => ['Pelni Express', 'ASDP'],
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

        $query = Jadwal::with(['transportasi', 'asal', 'tujuan'])
            ->when($asal, fn ($q) => $q->where('asal_id', $asal))
            ->when($tujuan, fn ($q) => $q->where('tujuan_id', $tujuan))
            ->when($tanggalRaw, fn ($q) =>
                $q->whereDate('waktu_berangkat', $tanggalRaw)
            )
            ->whereHas('transportasi', fn ($q) =>
                $q->where('tipe', $moda)
            );

        $query->when($selectedOperators, function ($q) use ($selectedOperators) {
            $q->whereHas('transportasi', function ($sub) use ($selectedOperators) {
                $sub->whereIn('nama_brand', $selectedOperators);
            });
        });

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
            'operatorLabel'
        ));
    }
}
