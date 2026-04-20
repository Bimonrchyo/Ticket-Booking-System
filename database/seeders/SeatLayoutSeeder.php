<?php

namespace Database\Seeders;

use App\Models\Transportasi;
use Illuminate\Database\Seeder;

class SeatLayoutSeeder extends Seeder
{
    public function run(): void
    {
        $layouts = [
            'bus' => [
                'type' => 'bus',
                'seats_per_row' => 4,
                'left' => ['A', 'B'],
                'right' => ['C', 'D'],
                'aisle_after' => 2,
                'rows' => 12, // 48 seats total
                'desc' => 'AKAP Standar 2-2'
            ],
            'kereta' => [
                'type' => 'kereta',
                'seats_per_row' => 4,
                'left' => ['A', 'B'],
                'right' => ['C', 'D'],
                'aisle_after' => 2,
                'rows' => 20, // 80 seats per coach (KAI Eksekutif facing pairs)
                'desc' => 'KAI Eksekutif 2-2 Facing'
            ],
            'pesawat' => [
                'type' => 'pesawat',
                'seats_per_row' => 6,
                'left' => ['A', 'B', 'C'],
                'right' => ['D', 'E', 'F'],
                'aisle_after' => 3,
                'rows' => 30, // 180 seats Boeing 737
                'desc' => 'Narrow Body 3-3 Lion Air/Garuda'
            ],
            'kapal' => [
                'type' => 'kapal',
                'seats_per_row' => 4,
                'left' => ['A', 'B'],
                'right' => ['C', 'D'],
                'aisle_after' => 2,
                'rows' => 25, // 100 seats ferry
                'desc' => 'Ferry Ekonomi 2-2'
            ]
        ];

        foreach ($layouts as $tipe => $layout) {
            Transportasi::where('tipe', $tipe)
                ->update(['seat_layout' => $layout]);
        }
    }
}
