<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(SeatLayoutSeeder::class);

        $now = now();

        // ============================================
        // COMPANIES (7) - Different transportation companies
        // ============================================
        DB::table('companies')->insert([
            // Kereta
            [
                'id' => 1,
                'name' => 'PT Kereta Api Indonesia (KAI)',
                'slug' => 'pt-kereta-api-indonesia',
                'address' => 'Jl. Perintis Kemerdekaan No. 1, Jakarta Pusat 10110',
                'status' => 'approved',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Pesawat - Lion Air Group
            [
                'id' => 2,
                'name' => 'Lion Air Group',
                'slug' => 'lion-air-group',
                'address' => 'Lion Air Tower, Jl. Kemanggisan Utama, Jakarta Barat 11480',
                'status' => 'approved',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Bus - PO Sinar Jaya
            [
                'id' => 3,
                'name' => 'PO Sinar Jaya',
                'slug' => 'po-sinar-jaya',
                'address' => 'Jl. Ahmad Yani No. 88, Surabaya 60131',
                'status' => 'approved',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Kapal - Pelni
            [
                'id' => 4,
                'name' => 'PT Pelni Nusantara',
                'slug' => 'pt-pelni-nusantara',
                'address' => 'Jl. Jend. Sudirman Kav. 52-53, Jakarta 12190',
                'status' => 'approved',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Pesawat - Garuda
            [
                'id' => 5,
                'name' => 'PT Garuda Indonesia (Persero) TBK',
                'slug' => 'pt-garuda-indonesia',
                'address' => 'Garuda Indonesia Building, Jakarta 10250',
                'status' => 'approved',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Bus - PO Haryanto
            [
                'id' => 6,
                'name' => 'PO Haryanto',
                'slug' => 'po-haryanto',
                'address' => 'Jl. Solo-Yogya km 8, Solo 57152',
                'status' => 'approved',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Pending company
            [
                'id' => 7,
                'name' => 'New Adventure Travel',
                'slug' => 'new-adventure-travel',
                'address' => 'Jl. Merdeka No. 10, Bandung 40111',
                'status' => 'pending',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // ============================================
        // USERS (12) - 1 superadmin, 6 admins, 5 users
        // ============================================
        DB::table('users')->insert([
            // Superadmin
            [
                'id' => 1,
                'nama' => 'Super Admin',
                'email' => 'superadmin@mail.com',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
                'company_id' => null,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Admins (one per approved company)
            [
                'id' => 2,
                'nama' => 'Admin KAI',
                'email' => 'admin@kai.co.id',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'company_id' => 1,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'nama' => 'Admin Lion Air',
                'email' => 'admin@lionair.co.id',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'company_id' => 2,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'nama' => 'Admin PO Sinar Jaya',
                'email' => 'admin@sinarjaya.co.id',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'company_id' => 3,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'nama' => 'Admin Pelni',
                'email' => 'admin@pelni.co.id',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'company_id' => 4,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'nama' => 'Admin Garuda',
                'email' => 'admin@garuda-indonesia.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'company_id' => 5,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'nama' => 'Admin PO Haryanto',
                'email' => 'admin@haryanto.co.id',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'company_id' => 6,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Regular Users
            [
                'id' => 8,
                'nama' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@mail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'company_id' => null,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 9,
                'nama' => 'Siti Rahayu',
                'email' => 'siti.rahayu@mail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'company_id' => null,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 10,
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@mail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'company_id' => null,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 11,
                'nama' => 'Dewi Lestari',
                'email' => 'dewi.lestari@mail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'company_id' => null,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 12,
                'nama' => 'Rudi Hermawan',
                'email' => 'rudi.hermawan@mail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'company_id' => null,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // ============================================
        // LOKASI (15) - Major cities in Indonesia
        // ============================================
        DB::table('lokasi')->insert([
            ['id' => 1, 'nama' => 'Jakarta', 'kode' => 'JKT', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'nama' => 'Bandung', 'kode' => 'BDG', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'nama' => 'Surabaya', 'kode' => 'SBY', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'nama' => 'Yogyakarta', 'kode' => 'YGY', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'nama' => 'Denpasar', 'kode' => 'DPS', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'nama' => 'Medan', 'kode' => 'MES', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'nama' => 'Makassar', 'kode' => 'UPG', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'nama' => 'Semarang', 'kode' => 'SRG', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'nama' => 'Malang', 'kode' => 'MLG', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'nama' => 'Palembang', 'kode' => 'PLB', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 11, 'nama' => 'Lombok', 'kode' => 'LOP', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 12, 'nama' => 'Balikpapan', 'kode' => 'BPN', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 13, 'nama' => 'Padang', 'kode' => 'PDG', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 14, 'nama' => 'Solo', 'kode' => 'SOC', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 15, 'nama' => 'Manado', 'kode' => 'MDC', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // ============================================
        // TRANSPORTASI (16) - 4 each: kereta, pesawat, bus, kapal
        // ============================================

        // KERETA (4) - KAI
        DB::table('transportasi')->insert([
            [
                'id' => 1,
                'tipe' => 'kereta',
                'nama_brand' => 'KAI Argo Bromo',
                'kode_identitas' => 'KAI-AB-001',
                'kapasitas' => 80,
                'user_id' => 2,
                'fasilitas' => json_encode(['ac', 'makan_siang', 'usb_charger', 'wifi', 'toilet']),
                'seat_layout' => json_encode([
                    'type' => 'kereta',
                    'seats_per_row' => 4,
                    'left' => ['A', 'B'],
                    'right' => ['C', 'D'],
                    'aisle_after' => 2,
                    'rows' => 20,
                    'desc' => 'Argo Bromo Premium 2-2',
                    'seat_types' => ['A' => 'window', 'B' => 'aisle', 'C' => 'aisle', 'D' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'tipe' => 'kereta',
                'nama_brand' => 'KAI Eksekutif',
                'kode_identitas' => 'KAI-EK-001',
                'kapasitas' => 100,
                'user_id' => 2,
                'fasilitas' => json_encode(['ac', 'makan_siang', 'usb_charger', 'toilet']),
                'seat_layout' => json_encode([
                    'type' => 'kereta',
                    'seats_per_row' => 5,
                    'left' => ['A', 'B'],
                    'right' => ['C', 'D', 'E'],
                    'aisle_after' => 2,
                    'rows' => 20,
                    'desc' => 'KAI Ekonomi Premium 2-3',
                    'seat_types' => ['A' => 'window', 'B' => 'aisle', 'C' => 'aisle', 'D' => 'middle', 'E' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'tipe' => 'kereta',
                'nama_brand' => 'KAI Bisnis',
                'kode_identitas' => 'KAI-BI-001',
                'kapasitas' => 120,
                'user_id' => 2,
                'fasilitas' => json_encode(['ac', 'toilet']),
                'seat_layout' => json_encode([
                    'type' => 'kereta',
                    'seats_per_row' => 5,
                    'left' => ['A', 'B'],
                    'right' => ['C', 'D', 'E'],
                    'aisle_after' => 2,
                    'rows' => 24,
                    'desc' => 'KAI Bisnis 2-3',
                    'seat_types' => ['A' => 'window', 'B' => 'aisle', 'C' => 'aisle', 'D' => 'middle', 'E' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'tipe' => 'kereta',
                'nama_brand' => 'KAI Ekonomi',
                'kode_identitas' => 'KAI-EK-002',
                'kapasitas' => 150,
                'user_id' => 2,
                'fasilitas' => json_encode(['ac', 'toilet']),
                'seat_layout' => json_encode([
                    'type' => 'kereta',
                    'seats_per_row' => 6,
                    'left' => ['A', 'B', 'C'],
                    'right' => ['D', 'E', 'F'],
                    'aisle_after' => 3,
                    'rows' => 25,
                    'desc' => 'KAI Ekonomi 3-3',
                    'seat_types' => ['A' => 'window', 'B' => 'middle', 'C' => 'aisle', 'D' => 'aisle', 'E' => 'middle', 'F' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // PESAWAT (4) - Lion Air & Garuda
        DB::table('transportasi')->insert([
            [
                'id' => 5,
                'tipe' => 'pesawat',
                'nama_brand' => 'Lion Air Boeing 737-900',
                'kode_identitas' => 'LA-737-001',
                'kapasitas' => 180,
                'user_id' => 3,
                'fasilitas' => json_encode(['ac', 'makan_siang', 'entertainment', 'bagasi_20kg']),
                'seat_layout' => json_encode([
                    'type' => 'pesawat',
                    'seats_per_row' => 6,
                    'left' => ['A', 'B', 'C'],
                    'right' => ['D', 'E', 'F'],
                    'aisle_after' => 3,
                    'rows' => 30,
                    'desc' => 'Lion Air 737-900 Economy 3-3',
                    'seat_types' => ['A' => 'window', 'B' => 'middle', 'C' => 'aisle', 'D' => 'aisle', 'E' => 'middle', 'F' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'tipe' => 'pesawat',
                'nama_brand' => 'Batik Air Airbus A320',
                'kode_identitas' => 'BA-A320-001',
                'kapasitas' => 150,
                'user_id' => 3,
                'fasilitas' => json_encode(['ac', 'makan_siang', 'entertainment', 'bagasi_20kg']),
                'seat_layout' => json_encode([
                    'type' => 'pesawat',
                    'seats_per_row' => 6,
                    'left' => ['A', 'B', 'C'],
                    'right' => ['D', 'E', 'F'],
                    'aisle_after' => 3,
                    'rows' => 25,
                    'desc' => 'Batik Air A320 Economy 3-3',
                    'seat_types' => ['A' => 'window', 'B' => 'middle', 'C' => 'aisle', 'D' => 'aisle', 'E' => 'middle', 'F' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'tipe' => 'pesawat',
                'nama_brand' => 'Garuda Indonesia Boeing 777',
                'kode_identitas' => 'GA-777-001',
                'kapasitas' => 350,
                'user_id' => 6,
                'fasilitas' => json_encode(['ac', 'makan_siang', 'makan_malam', 'entertainment', 'wifi', 'bagasi_30kg', 'pillow']),
                'seat_layout' => json_encode([
                    'type' => 'pesawat',
                    'seats_per_row' => 10,
                    'left' => ['A', 'B', 'C', 'K', 'J'],
                    'right' => ['D', 'E', 'F', 'G', 'H'],
                    'aisle_after' => 5,
                    'rows' => 35,
                    'desc' => 'Garuda 777-300ER Economy 3-2-3-2',
                    'seat_types' => ['A' => 'window', 'B' => 'middle', 'C' => 'aisle', 'D' => 'aisle', 'E' => 'middle', 'F' => 'middle', 'G' => 'middle', 'H' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 8,
                'tipe' => 'pesawat',
                'nama_brand' => 'Citilink Airbus A320',
                'kode_identitas' => 'CT-A320-001',
                'kapasitas' => 180,
                'user_id' => 3,
                'fasilitas' => json_encode(['ac', 'snack', 'bagasi_15kg']),
                'seat_layout' => json_encode([
                    'type' => 'pesawat',
                    'seats_per_row' => 6,
                    'left' => ['A', 'B', 'C'],
                    'right' => ['D', 'E', 'F'],
                    'aisle_after' => 3,
                    'rows' => 30,
                    'desc' => 'Citilink A320 Economy 3-3',
                    'seat_types' => ['A' => 'window', 'B' => 'middle', 'C' => 'aisle', 'D' => 'aisle', 'E' => 'middle', 'F' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // BUS (4) - PO Sinar Jaya & PO Haryanto
        DB::table('transportasi')->insert([
            [
                'id' => 9,
                'tipe' => 'bus',
                'nama_brand' => 'PO Sinar Jaya Premium',
                'kode_identitas' => 'SJ-PRE-001',
                'kapasitas' => 45,
                'user_id' => 4,
                'fasilitas' => json_encode(['ac', 'makan_siang', 'snack', 'wifi', 'usb_charger', 'toilet']),
                'seat_layout' => json_encode([
                    'type' => 'bus',
                    'seats_per_row' => 4,
                    'left' => ['A', 'B'],
                    'right' => ['C', 'D'],
                    'aisle_after' => 2,
                    'rows' => 11,
                    'desc' => 'Sinar Jaya Premium 2-2',
                    'seat_types' => ['A' => 'window', 'B' => 'aisle', 'C' => 'aisle', 'D' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 10,
                'tipe' => 'bus',
                'nama_brand' => 'PO Sinar Jaya Ekonomi',
                'kode_identitas' => 'SJ-EKO-001',
                'kapasitas' => 50,
                'user_id' => 4,
                'fasilitas' => json_encode(['ac', 'snack']),
                'seat_layout' => json_encode([
                    'type' => 'bus',
                    'seats_per_row' => 4,
                    'left' => ['A', 'B'],
                    'right' => ['C', 'D'],
                    'aisle_after' => 2,
                    'rows' => 12,
                    'desc' => 'Sinar Jaya Ekonomi 2-2',
                    'seat_types' => ['A' => 'window', 'B' => 'aisle', 'C' => 'aisle', 'D' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 11,
                'tipe' => 'bus',
                'nama_brand' => 'PO Haryanto VIP',
                'kode_identitas' => 'HT-VIP-001',
                'kapasitas' => 40,
                'user_id' => 7,
                'fasilitas' => json_encode(['ac', 'makan_siang', 'makan_malam', 'wifi', 'usb_charger', 'reclining_seat']),
                'seat_layout' => json_encode([
                    'type' => 'bus',
                    'seats_per_row' => 4,
                    'left' => ['A', 'B'],
                    'right' => ['C', 'D'],
                    'aisle_after' => 2,
                    'rows' => 10,
                    'desc' => 'Haryanto VIP 2-2',
                    'seat_types' => ['A' => 'window', 'B' => 'aisle', 'C' => 'aisle', 'D' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 12,
                'tipe' => 'bus',
                'nama_brand' => 'PO Haryanto Ekonomi',
                'kode_identitas' => 'HT-EKO-001',
                'kapasitas' => 52,
                'user_id' => 7,
                'fasilitas' => json_encode(['ac', 'snack']),
                'seat_layout' => json_encode([
                    'type' => 'bus',
                    'seats_per_row' => 4,
                    'left' => ['A', 'B'],
                    'right' => ['C', 'D'],
                    'aisle_after' => 2,
                    'rows' => 13,
                    'desc' => 'Haryanto Ekonomi 2-2',
                    'seat_types' => ['A' => 'window', 'B' => 'aisle', 'C' => 'aisle', 'D' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // KAPAL (4) - Pelni
        DB::table('transportasi')->insert([
            [
                'id' => 13,
                'tipe' => 'kapal',
                'nama_brand' => 'Pelni KM. Dobonsolo',
                'kode_identitas' => 'PL-DB-001',
                'kapasitas' => 200,
                'user_id' => 5,
                'fasilitas' => json_encode(['ac', 'makan_siang', 'makan_malam', 'kamar_tidur', 'toilet']),
                'seat_layout' => json_encode([
                    'type' => 'kapal',
                    'seats_per_row' => 4,
                    'left' => ['A', 'B'],
                    'right' => ['C', 'D'],
                    'aisle_after' => 2,
                    'rows' => 50,
                    'desc' => 'Pelni Ferry Ekonomi 2-2',
                    'seat_types' => ['A' => 'window', 'B' => 'aisle', 'C' => 'aisle', 'D' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 14,
                'tipe' => 'kapal',
                'nama_brand' => 'Pelni KM. Kelud',
                'kode_identitas' => 'PL-KL-001',
                'kapasitas' => 150,
                'user_id' => 5,
                'fasilitas' => json_encode(['ac', 'makan_siang', 'kamar_tidur', 'toilet']),
                'seat_layout' => json_encode([
                    'type' => 'kapal',
                    'seats_per_row' => 4,
                    'left' => ['A', 'B'],
                    'right' => ['C', 'D'],
                    'aisle_after' => 2,
                    'rows' => 37,
                    'desc' => 'Pelni Ferry Ekonomi 2-2',
                    'seat_types' => ['A' => 'window', 'B' => 'aisle', 'C' => 'aisle', 'D' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 15,
                'tipe' => 'kapal',
                'nama_brand' => 'Pelni KM. Sinabung',
                'kode_identitas' => 'PL-SN-001',
                'kapasitas' => 180,
                'user_id' => 5,
                'fasilitas' => json_encode(['ac', 'makan_siang', 'hiburan', 'toilet']),
                'seat_layout' => json_encode([
                    'type' => 'kapal',
                    'seats_per_row' => 4,
                    'left' => ['A', 'B'],
                    'right' => ['C', 'D'],
                    'aisle_after' => 2,
                    'rows' => 45,
                    'desc' => 'Pelni Ferry Ekonomi 2-2',
                    'seat_types' => ['A' => 'window', 'B' => 'aisle', 'C' => 'aisle', 'D' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 16,
                'tipe' => 'kapal',
                'nama_brand' => 'Pelni KM. Ciremai',
                'kode_identitas' => 'PL-CR-001',
                'kapasitas' => 120,
                'user_id' => 5,
                'fasilitas' => json_encode(['ac', 'makan_siang', 'toilet']),
                'seat_layout' => json_encode([
                    'type' => 'kapal',
                    'seats_per_row' => 4,
                    'left' => ['A', 'B'],
                    'right' => ['C', 'D'],
                    'aisle_after' => 2,
                    'rows' => 30,
                    'desc' => 'Pelni Ferry Ekonomi 2-2',
                    'seat_types' => ['A' => 'window', 'B' => 'aisle', 'C' => 'aisle', 'D' => 'window']
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // ============================================
        // JADWAL (40+) - Various routes, times, prices
        // ============================================

        // Helper function for schedule times
        $scheduleData = [];
        $scheduleId = 1;

        // KERETA SCHEDULES (10) - Various routes
        $keretaSchedules = [
            // Jakarta - Bandung
            [1, 1, 2, '06:00', '08:30', 150000, 'Stasiun Gambir', 75],
            [1, 1, 2, '10:00', '12:30', 180000, 'Stasiun Gambir', 80],
            [1, 1, 2, '14:00', '16:30', 150000, 'Stasiun Pasar Senen', 75],
            [1, 1, 2, '18:00', '20:30', 170000, 'Stasiun Gambir', 70],
            // Jakarta - Surabaya
            [1, 1, 3, '08:00', '18:00', 350000, 'Stasiun Gambir', 100],
            [1, 1, 3, '20:00', '06:00+1', 320000, 'Stasiun Pasar Senen', 100],
            // Jakarta - Yogyakarta
            [1, 1, 4, '07:00', '19:00', 380000, 'Stasiun Gambir', 90],
            [1, 1, 4, '21:00', '09:00+1', 350000, 'Stasiun Pasar Senen', 90],
            // Bandung - Surabaya
            [1, 2, 3, '23:00', '11:00+1', 300000, 'Stasiun Bandung', 85],
            // Surabaya - Yogyakarta
            [1, 3, 4, '05:00', '10:00', 200000, 'Stasiun Pasar Turi', 80],
        ];

        foreach ($keretaSchedules as $sch) {
            $berangkat = Carbon::createFromFormat('H:i', explode('+', $sch[3])[0]);
            $tiba = Carbon::createFromFormat('H:i', explode('+', $sch[4])[0]);
            if (isset(explode('+', $sch[4])[1])) {
                $tiba->addDays(1);
            }
            if ($sch[3] === '20:00' || $sch[3] === '21:00' || $sch[3] === '23:00') {
                $berangkat->addDays(1);
            }

            DB::table('jadwal')->insert([
                'id' => $scheduleId,
                'transportasi_id' => $sch[0],
                'asal_id' => $sch[1],
                'tujuan_id' => $sch[2],
                'waktu_berangkat' => $berangkat,
                'waktu_tiba' => $tiba,
                'harga' => $sch[5],
                'info_lokasi' => $sch[6],
                'stok_tersedia' => $sch[7],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $scheduleId++;
        }

        // PESAWAT SCHEDULES (10) - Various routes
        $pesawatSchedules = [
            // Jakarta - Surabaya
            [5, 1, 3, '07:00', '08:30', 850000, 'Bandara Soekarno-Hatta', 150],
            [5, 1, 3, '12:00', '13:30', 750000, 'Bandara Soekarno-Hatta', 160],
            [5, 1, 3, '18:00', '19:30', 800000, 'Bandara Soekarno-Hatta', 155],
            // Jakarta - Medan
            [5, 1, 6, '09:00', '11:30', 950000, 'Bandara Soekarno-Hatta', 140],
            [5, 1, 6, '15:00', '17:30', 900000, 'Bandara Soekarno-Hatta', 145],
            // Jakarta - Makassar
            [8, 1, 7, '08:00', '11:00', 1100000, 'Bandara Soekarno-Hatta', 130],
            [8, 1, 7, '14:00', '17:00', 1050000, 'Bandara Soekarno-Hatta', 135],
            // Jakarta - Denpasar
            [6, 1, 5, '10:00', '12:30', 900000, 'Bandara Soekarno-Hatta', 120],
            [6, 1, 5, '16:00', '18:30', 850000, 'Bandara Soekarno-Hatta', 125],
            // Surabaya - Jakarta
            [5, 3, 1, '11:00', '12:30', 820000, 'Bandara Juanda', 150],
        ];

        foreach ($pesawatSchedules as $sch) {
            $berangkat = Carbon::createFromFormat('H:i', $sch[3]);
            $tiba = Carbon::createFromFormat('H:i', $sch[4]);

            DB::table('jadwal')->insert([
                'id' => $scheduleId,
                'transportasi_id' => $sch[0],
                'asal_id' => $sch[1],
                'tujuan_id' => $sch[2],
                'waktu_berangkat' => $berangkat,
                'waktu_tiba' => $tiba,
                'harga' => $sch[5],
                'info_lokasi' => $sch[6],
                'stok_tersedia' => $sch[7],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $scheduleId++;
        }

        // BUS SCHEDULES (10) - Various routes
        $busSchedules = [
            // Jakarta - Bandung
            [9, 1, 2, '06:00', '09:00', 120000, 'Terminal Kampung Rambutan', 40],
            [9, 1, 2, '10:00', '13:00', 130000, 'Terminal Kampung Rambutan', 42],
            [9, 1, 2, '14:00', '17:00', 120000, 'Terminal Kampung Rambutan', 40],
            [9, 1, 2, '18:00', '21:00', 125000, 'Terminal Kampung Rambutan', 38],
            // Jakarta - Surabaya
            [10, 1, 3, '18:00', '06:00+1', 350000, 'Terminal Kampung Rambutan', 45],
            [10, 1, 3, '20:00', '08:00+1', 320000, 'Terminal Pulogebang', 48],
            // Jakarta - Yogyakarta
            [11, 1, 4, '17:00', '05:00+1', 400000, 'Terminal Kampung Rambutan', 35],
            [11, 1, 4, '19:00', '07:00+1', 380000, 'Terminal Pulogebang', 38],
            // Bandung - Surabaya
            [10, 2, 3, '20:00', '08:00+1', 300000, 'Terminal Cicaheum', 44],
            // Surabaya - Jakarta
            [9, 3, 1, '19:00', '04:00+1', 340000, 'Terminal Purabaya', 42],
        ];

        foreach ($busSchedules as $sch) {
            $berangkat = Carbon::createFromFormat('H:i', explode('+', $sch[3])[0]);
            $tiba = Carbon::createFromFormat('H:i', explode('+', $sch[4])[0]);
            if (isset(explode('+', $sch[4])[1])) {
                $tiba->addDays(1);
            }
            if (isset(explode('+', $sch[3])[1])) {
                $berangkat->addDays(1);
            }

            DB::table('jadwal')->insert([
                'id' => $scheduleId,
                'transportasi_id' => $sch[0],
                'asal_id' => $sch[1],
                'tujuan_id' => $sch[2],
                'waktu_berangkat' => $berangkat,
                'waktu_tiba' => $tiba,
                'harga' => $sch[5],
                'info_lokasi' => $sch[6],
                'stok_tersedia' => $sch[7],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $scheduleId++;
        }

        // KAPAL SCHEDULES (10) - Various routes
        $kapalSchedules = [
            // Jakarta - Denpasar (via laut)
            [13, 1, 5, '08:00', '20:00+1', 450000, 'Pelabuhan Tanjung Priok', 180],
            [13, 1, 5, '20:00', '08:00+2', 420000, 'Pelabuhan Tanjung Priok', 175],
            // Jakarta - Makassar
            [14, 1, 7, '10:00', '10:00+2', 550000, 'Pelabuhan Tanjung Priok', 130],
            // Surabaya - Denpasar
            [15, 3, 5, '06:00', '18:00', 280000, 'Pelabaya Surabaya', 160],
            [15, 3, 5, '18:00', '06:00+1', 250000, 'Pelabaya Surabaya', 165],
            // Jakarta - Lombok
            [13, 1, 11, '09:00', '09:00+2', 480000, 'Pelabuhan Tanjung Priok', 150],
            // Surabaya - Makassar
            [14, 3, 7, '14:00', '14:00+1', 420000, 'Pelabaya Surabaya', 140],
            // Jakarta - Balikpapan
            [16, 1, 12, '07:00', '07:00+1', 380000, 'Pelabuhan Tanjung Priok', 100],
            // Jakarta - Padang
            [15, 1, 13, '06:00', '06:00+1', 320000, 'Pelabuhan Tanjung Priok', 110],
            // Makassar - Jakarta
            [14, 7, 1, '15:00', '15:00+2', 520000, 'Pelabuhan Makassar', 135],
        ];

        foreach ($kapalSchedules as $sch) {
            $berangkat = Carbon::createFromFormat('H:i', explode('+', $sch[3])[0]);
            $tiba = Carbon::createFromFormat('H:i', explode('+', $sch[4])[0]);
            if (isset(explode('+', $sch[4])[1])) {
                $tiba->addDays((int) explode('+', $sch[4])[1]);
            }
            if (isset(explode('+', $sch[3])[1])) {
                $berangkat->addDays((int) explode('+', $sch[3])[1]);
            }

            DB::table('jadwal')->insert([
                'id' => $scheduleId,
                'transportasi_id' => $sch[0],
                'asal_id' => $sch[1],
                'tujuan_id' => $sch[2],
                'waktu_berangkat' => $berangkat,
                'waktu_tiba' => $tiba,
                'harga' => $sch[5],
                'info_lokasi' => $sch[6],
                'stok_tersedia' => $sch[7],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $scheduleId++;
        }

        // ============================================
        // PEMESANAN (15+) - Various statuses
        // ============================================
        DB::table('pemesanan')->insert([
            // PAID bookings
            [
                'id' => 1,
                'kode_booking' => 'BOOK-2026-001',
                'user_id' => 8,
                'jadwal_id' => 1,
                'nama_penumpang' => 'Ahmad Fauzi',
                'nik' => '3276010101010001',
                'nomor_kursi' => 'A5',
                'total_harga' => 120000,
                'status' => 'canceled',
                'qr_code_data' => 'QR-BOOK-2026-011',
                'created_at' => $now->copy()->subDays(3),
                'updated_at' => $now->copy()->subDays(2),
            ],
            [
                'id' => 12,
                'kode_booking' => 'BOOK-2026-012',
                'user_id' => 9,
                'jadwal_id' => 18,
                'nama_penumpang' => 'Siti Rahayu',
                'nik' => '3276010101010002',
                'nomor_kursi' => 'B7',
                'total_harga' => 950000,
                'status' => 'canceled',
                'qr_code_data' => 'QR-BOOK-2026-012',
                'created_at' => $now->copy()->subDays(4),
                'updated_at' => $now->copy()->subDays(3),
            ],
            // More PAID bookings
            [
                'id' => 13,
                'kode_booking' => 'BOOK-2026-013',
                'user_id' => 10,
                'jadwal_id' => 25,
                'nama_penumpang' => 'Budi Santoso',
                'nik' => '3276010101010003',
                'nomor_kursi' => 'D3',
                'total_harga' => 380000,
                'status' => 'paid',
                'qr_code_data' => 'QR-BOOK-2026-013',
                'created_at' => $now->copy()->subHours(8),
                'updated_at' => $now->copy()->subHours(8),
            ],
            [
                'id' => 14,
                'kode_booking' => 'BOOK-2026-014',
                'user_id' => 11,
                'jadwal_id' => 35,
                'nama_penumpang' => 'Dewi Lestari',
                'nik' => '3276010101010004',
                'nomor_kursi' => 'A6',
                'total_harga' => 550000,
                'status' => 'paid',
                'qr_code_data' => 'QR-BOOK-2026-014',
                'created_at' => $now->copy()->subHours(4),
                'updated_at' => $now->copy()->subHours(4),
            ],
            [
                'id' => 15,
                'kode_booking' => 'BOOK-2026-015',
                'user_id' => 12,
                'jadwal_id' => 10,
                'nama_penumpang' => 'Rudi Hermawan',
                'nik' => '3276010101010005',
                'nomor_kursi' => 'B4',
                'total_harga' => 200000,
                'status' => 'pending',
                'qr_code_data' => 'QR-BOOK-2026-015',
                'created_at' => $now->copy()->subMinutes(15),
                'updated_at' => $now->copy()->subMinutes(15),
            ],

            // DUMMY PEMESANAN UNTUK JADWAL KAPAL 17 MEI 2026 (jadwal_id = 11)
            [
                'id' => 3,
                'kode_booking' => 'BOOK-003',
                'user_id' => 3,
                'jadwal_id' => 11,
                'nama_penumpang' => 'Andi Pratama',
                'nik' => '3276010101010003',
                'nomor_kursi' => 'A1',
                'total_harga' => 150000,
                'status' => 'paid',
                'qr_code_data' => 'QR-BOOK-2026-001',
                'created_at' => $now->copy()->subDays(2),
                'updated_at' => $now->copy()->subDays(2),
            ],
            [
                'id' => 2,
                'kode_booking' => 'BOOK-2026-002',
                'user_id' => 9,
                'jadwal_id' => 11,
                'nama_penumpang' => 'Siti Rahayu',
                'nik' => '3276010101010002',
                'nomor_kursi' => 'B3',
                'total_harga' => 850000,
                'status' => 'paid',
                'qr_code_data' => 'QR-BOOK-2026-002',
                'created_at' => $now->copy()->subDays(1),
                'updated_at' => $now->copy()->subDays(1),
            ],
            [
                'id' => 3,
                'kode_booking' => 'BOOK-2026-003',
                'user_id' => 10,
                'jadwal_id' => 21,
                'nama_penumpang' => 'Budi Santoso',
                'nik' => '3276010101010003',
                'nomor_kursi' => '12A',
                'total_harga' => 120000,
                'status' => 'paid',
                'qr_code_data' => 'QR-BOOK-2026-003',
                'created_at' => $now->copy()->subHours(12),
                'updated_at' => $now->copy()->subHours(12),
            ],
            [
                'id' => 4,
                'kode_booking' => 'BOOK-2026-004',
                'user_id' => 11,
                'jadwal_id' => 31,
                'nama_penumpang' => 'Dewi Lestari',
                'nik' => '3276010101010004',
                'nomor_kursi' => 'C5',
                'total_harga' => 450000,
                'status' => 'paid',
                'qr_code_data' => 'QR-BOOK-2026-004',
                'created_at' => $now->copy()->subHours(6),
                'updated_at' => $now->copy()->subHours(6),
            ],
            [
                'id' => 5,
                'kode_booking' => 'BOOK-2026-005',
                'user_id' => 12,
                'jadwal_id' => 5,
                'nama_penumpang' => 'Rudi Hermawan',
                'nik' => '3276010101010005',
                'nomor_kursi' => 'D2',
                'total_harga' => 350000,
                'status' => 'paid',
                'qr_code_data' => 'QR-BOOK-2026-005',
                'created_at' => $now->copy()->subHours(3),
                'updated_at' => $now->copy()->subHours(3),
            ],
            // PENDING bookings
            [
                'id' => 6,
                'kode_booking' => 'BOOK-2026-006',
                'user_id' => 8,
                'jadwal_id' => 12,
                'nama_penumpang' => 'Ahmad Fauzi',
                'nik' => '3276010101010001',
                'nomor_kursi' => 'A4',
                'total_harga' => 750000,
                'status' => 'pending',
                'qr_code_data' => 'QR-BOOK-2026-006',
                'created_at' => $now->copy()->subHours(2),
                'updated_at' => $now->copy()->subHours(2),
            ],
            [
                'id' => 7,
                'kode_booking' => 'BOOK-2026-007',
                'user_id' => 9,
                'jadwal_id' => 22,
                'nama_penumpang' => 'Siti Rahayu',
                'nik' => '3276010101010002',
                'nomor_kursi' => 'B1',
                'total_harga' => 130000,
                'status' => 'pending',
                'qr_code_data' => 'QR-BOOK-2026-007',
                'created_at' => $now->copy()->subHours(1),
                'updated_at' => $now->copy()->subHours(1),
            ],
            [
                'id' => 8,
                'kode_booking' => 'BOOK-2026-008',
                'user_id' => 10,
                'jadwal_id' => 32,
                'nama_penumpang' => 'Budi Santoso',
                'nik' => '3276010101010003',
                'nomor_kursi' => 'C8',
                'total_harga' => 400000,
                'status' => 'pending',
                'qr_code_data' => 'QR-BOOK-2026-008',
                'created_at' => $now->copy()->subMinutes(30),
                'updated_at' => $now->copy()->subMinutes(30),
            ],
            // COMPLETED bookings
            [
                'id' => 9,
                'kode_booking' => 'BOOK-2026-009',
                'user_id' => 11,
                'jadwal_id' => 2,
                'nama_penumpang' => 'Dewi Lestari',
                'nik' => '3276010101010004',
                'nomor_kursi' => '15C',
                'total_harga' => 180000,
                'status' => 'completed',
                'qr_code_data' => 'QR-BOOK-2026-009',
                'created_at' => $now->copy()->subDays(5),
                'updated_at' => $now->copy()->subDays(3),
            ],
            [
                'id' => 10,
                'kode_booking' => 'BOOK-2026-010',
                'user_id' => 12,
                'jadwal_id' => 15,
                'nama_penumpang' => 'Rudi Hermawan',
                'nik' => '3276010101010005',
                'nomor_kursi' => 'A2',
                'total_harga' => 320000,
                'status' => 'completed',
                'qr_code_data' => 'QR-BOOK-2026-010',
                'created_at' => $now->copy()->subDays(7),
                'updated_at' => $now->copy()->subDays(5),
            ],
            // CANCELED bookings
            [
                'id' => 11,
                'kode_booking' => 'BOOK-2026-011',
                'user_id' => 8,
                'jadwal_id' => 8,
                'nama_penumpang' => 'Ahmad Fauzi',
                'nik' => '3276010101010001',
                'nomor_kursi' => 'A5',
                'total_harga' => 120000,
                'status' => 'canceled',
                'qr_code_data' => 'QR-BOOK-2026-011',
                'created_at' => $now->copy()->subDays(3),
                'updated_at' => $now->copy()->subDays(2),
            ],
            [
                'id' => 12,
                'kode_booking' => 'BOOK-2026-012',
                'user_id' => 9,
                'jadwal_id' => 18,
                'nama_penumpang' => 'Siti Rahayu',
                'nik' => '3276010101010002',
                'nomor_kursi' => 'B7',
                'total_harga' => 950000,
                'status' => 'canceled',
                'qr_code_data' => 'QR-BOOK-2026-012',
                'created_at' => $now->copy()->subDays(4),
                'updated_at' => $now->copy()->subDays(3),
            ],
            // More PAID bookings
            [
                'id' => 13,
                'kode_booking' => 'BOOK-2026-013',
                'user_id' => 10,
                'jadwal_id' => 25,
                'nama_penumpang' => 'Budi Santoso',
                'nik' => '3276010101010003',
                'nomor_kursi' => 'D3',
                'total_harga' => 380000,
                'status' => 'paid',
                'qr_code_data' => 'QR-BOOK-2026-013',
                'created_at' => $now->copy()->subHours(8),
                'updated_at' => $now->copy()->subHours(8),
            ],
            [
                'id' => 14,
                'kode_booking' => 'BOOK-2026-014',
                'user_id' => 11,
                'jadwal_id' => 35,
                'nama_penumpang' => 'Dewi Lestari',
                'nik' => '3276010101010004',
                'nomor_kursi' => 'A6',
                'total_harga' => 550000,
                'status' => 'paid',
                'qr_code_data' => 'QR-BOOK-2026-014',
                'created_at' => $now->copy()->subHours(4),
                'updated_at' => $now->copy()->subHours(4),
            ],
            [
                'id' => 15,
                'kode_booking' => 'BOOK-2026-015',
                'user_id' => 12,
                'jadwal_id' => 10,
                'nama_penumpang' => 'Rudi Hermawan',
                'nik' => '3276010101010005',
                'nomor_kursi' => 'B4',
                'total_harga' => 200000,
                'status' => 'pending',
                'qr_code_data' => 'QR-BOOK-2026-015',
                'created_at' => $now->copy()->subMinutes(15),
                'updated_at' => $now->copy()->subMinutes(15),
            ],
        ]);

        // ============================================
        // PEMBAYARAN (15+) - Various methods and statuses
        // ============================================
        DB::table('pembayaran')->insert([
            // PAID payments
            [
                'id' => 1,
                'pemesanan_id' => 1,
                'metode_bayar' => 'transfer',
                'bukti_transfer' => 'bukti_2026_001.jpg',
                'nominal_bayar' => 150000,
                'status' => 'paid',
                'payment_time' => $now->copy()->subDays(2),
                'verified_at' => $now->copy()->subDays(2),
                'created_at' => $now->copy()->subDays(2),
                'updated_at' => $now->copy()->subDays(2),
            ],
            [
                'id' => 2,
                'pemesanan_id' => 2,
                'metode_bayar' => 'gopay',
                'bukti_transfer' => 'gopay_2026_002.png',
                'nominal_bayar' => 850000,
                'status' => 'paid',
                'payment_time' => $now->copy()->subDays(1),
                'verified_at' => $now->copy()->subDays(1),
                'created_at' => $now->copy()->subDays(1),
                'updated_at' => $now->copy()->subDays(1),
            ],
            [
                'id' => 3,
                'pemesanan_id' => 3,
                'metode_bayar' => 'ovo',
                'bukti_transfer' => 'ovo_2026_003.png',
                'nominal_bayar' => 120000,
                'status' => 'paid',
                'payment_time' => $now->copy()->subHours(12),
                'verified_at' => $now->copy()->subHours(11),
                'created_at' => $now->copy()->subHours(12),
                'updated_at' => $now->copy()->subHours(11),
            ],
            [
                'id' => 4,
                'pemesanan_id' => 4,
                'metode_bayar' => 'dana',
                'bukti_transfer' => 'dana_2026_004.png',
                'nominal_bayar' => 450000,
                'status' => 'paid',
                'payment_time' => $now->copy()->subHours(6),
                'verified_at' => $now->copy()->subHours(5),
                'created_at' => $now->copy()->subHours(6),
                'updated_at' => $now->copy()->subHours(5),
            ],
            [
                'id' => 5,
                'pemesanan_id' => 5,
                'metode_bayar' => 'kartu_kredit',
                'bukti_transfer' => 'kartu_2026_005.jpg',
                'nominal_bayar' => 350000,
                'status' => 'paid',
                'payment_time' => $now->copy()->subHours(3),
                'verified_at' => $now->copy()->subHours(3),
                'created_at' => $now->copy()->subHours(3),
                'updated_at' => $now->copy()->subHours(3),
            ],
            // PENDING payments
            [
                'id' => 6,
                'pemesanan_id' => 6,
                'metode_bayar' => 'transfer',
                'bukti_transfer' => 'bukti_2026_006.jpg',
                'nominal_bayar' => 750000,
                'status' => 'pending',
                'payment_time' => $now->copy()->subHours(2),
                'verified_at' => null,
                'created_at' => $now->copy()->subHours(2),
                'updated_at' => $now->copy()->subHours(2),
            ],
            [
                'id' => 7,
                'pemesanan_id' => 7,
                'metode_bayar' => 'gopay',
                'bukti_transfer' => 'gopay_2026_007.png',
                'nominal_bayar' => 130000,
                'status' => 'pending',
                'payment_time' => $now->copy()->subHours(1),
                'verified_at' => null,
                'created_at' => $now->copy()->subHours(1),
                'updated_at' => $now->copy()->subHours(1),
            ],
            [
                'id' => 8,
                'pemesanan_id' => 8,
                'metode_bayar' => 'ovo',
                'bukti_transfer' => 'ovo_2026_008.png',
                'nominal_bayar' => 400000,
                'status' => 'pending',
                'payment_time' => $now->copy()->subMinutes(30),
                'verified_at' => null,
                'created_at' => $now->copy()->subMinutes(30),
                'updated_at' => $now->copy()->subMinutes(30),
            ],
            // COMPLETED payments (for completed bookings)
            [
                'id' => 9,
                'pemesanan_id' => 9,
                'metode_bayar' => 'transfer',
                'bukti_transfer' => 'bukti_2026_009.jpg',
                'nominal_bayar' => 180000,
                'status' => 'paid',
                'payment_time' => $now->copy()->subDays(5),
                'verified_at' => $now->copy()->subDays(5),
                'created_at' => $now->copy()->subDays(5),
                'updated_at' => $now->copy()->subDays(5),
            ],
            [
                'id' => 10,
                'pemesanan_id' => 10,
                'metode_bayar' => 'dana',
                'bukti_transfer' => 'dana_2026_010.png',
                'nominal_bayar' => 320000,
                'status' => 'paid',
                'payment_time' => $now->copy()->subDays(7),
                'verified_at' => $now->copy()->subDays(7),
                'created_at' => $now->copy()->subDays(7),
                'updated_at' => $now->copy()->subDays(7),
            ],
            // REJECTED payments
            [
                'id' => 11,
                'pemesanan_id' => 11,
                'metode_bayar' => 'transfer',
                'bukti_transfer' => 'bukti_2026_011.jpg',
                'nominal_bayar' => 120000,
                'status' => 'rejected',
                'payment_time' => $now->copy()->subDays(3),
                'verified_at' => null,
                'created_at' => $now->copy()->subDays(3),
                'updated_at' => $now->copy()->subDays(2),
            ],
            [
                'id' => 12,
                'pemesanan_id' => 12,
                'metode_bayar' => 'kartu_kredit',
                'bukti_transfer' => 'kartu_2026_012.jpg',
                'nominal_bayar' => 950000,
                'status' => 'rejected',
                'payment_time' => $now->copy()->subDays(4),
                'verified_at' => null,
                'created_at' => $now->copy()->subDays(4),
                'updated_at' => $now->copy()->subDays(3),
            ],
            // More PAID payments
            [
                'id' => 13,
                'pemesanan_id' => 13,
                'metode_bayar' => 'transfer',
                'bukti_transfer' => 'bukti_2026_013.jpg',
                'nominal_bayar' => 380000,
                'status' => 'paid',
                'payment_time' => $now->copy()->subHours(8),
                'verified_at' => $now->copy()->subHours(7),
                'created_at' => $now->copy()->subHours(8),
                'updated_at' => $now->copy()->subHours(7),
            ],
            [
                'id' => 14,
                'pemesanan_id' => 14,
                'metode_bayar' => 'gopay',
                'bukti_transfer' => 'gopay_2026_014.png',
                'nominal_bayar' => 550000,
                'status' => 'paid',
                'payment_time' => $now->copy()->subHours(4),
                'verified_at' => $now->copy()->subHours(4),
                'created_at' => $now->copy()->subHours(4),
                'updated_at' => $now->copy()->subHours(4),
            ],
            [
                'id' => 15,
                'pemesanan_id' => 15,
                'metode_bayar' => 'ovo',
                'bukti_transfer' => 'ovo_2026_015.png',
                'nominal_bayar' => 200000,
                'status' => 'pending',
                'payment_time' => $now->copy()->subMinutes(15),
                'verified_at' => null,
                'created_at' => $now->copy()->subMinutes(15),
                'updated_at' => $now->copy()->subMinutes(15),
            ],
        ]);
    }
}
