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
                'rows' => 12,
                'desc' => 'AKAP Standar 2-2',
                'seat_types' => [
                    'A' => 'window',
                    'B' => 'aisle',
                    'C' => 'aisle',
                    'D' => 'window',
                ],
            ],
            'kereta' => [
                'type' => 'kereta',
                'seats_per_row' => 5,
                'left' => ['A', 'B'],
                'right' => ['C', 'D', 'E'],
                'aisle_after' => 2,
                'rows' => 16,
                'desc' => 'KAI Ekonomi 2-3',
                'seat_types' => [
                    'A' => 'window',
                    'B' => 'aisle',
                    'C' => 'aisle',
                    'D' => 'middle',
                    'E' => 'window',
                ],
            ],
            'pesawat' => [
                'type' => 'pesawat',
                'seats_per_row' => 6,
                'left' => ['A', 'B', 'C'],
                'right' => ['D', 'E', 'F'],
                'aisle_after' => 3,
                'rows' => 30,
                'desc' => 'Narrow Body 3-3 Lion Air/Garuda',
                'seat_types' => [
                    'A' => 'window',
                    'B' => 'middle',
                    'C' => 'aisle',
                    'D' => 'aisle',
                    'E' => 'middle',
                    'F' => 'window',
                ],
            ],
            'kapal' => [
                'type' => 'kapal',
                'seats_per_row' => 4,
                'left' => ['A', 'B'],
                'right' => ['C', 'D'],
                'aisle_after' => 2,
                'rows' => 25,
                'desc' => 'Ferry Ekonomi 2-2',
                'seat_types' => [
                    'A' => 'window',
                    'B' => 'aisle',
                    'C' => 'aisle',
                    'D' => 'window',
                ],
            ],
        ];

        foreach ($layouts as $tipe => $layout) {
            Transportasi::where('tipe', $tipe)
                ->update(['seat_layout' => $layout]);
        }
    }
}

