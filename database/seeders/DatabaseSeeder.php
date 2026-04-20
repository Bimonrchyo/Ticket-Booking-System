<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(SeatLayoutSeeder::class);

        $now = now();

        // COMPANIES
        DB::table('companies')->insert([
            [
                'id' => 1,
                'name' => 'Default Transport Company',
                'slug' => 'default-transport-company',
                'address' => 'Head Office, Jakarta',
                'status' => 'approved',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // USERS
        DB::table('users')->insert([
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
            [
                'id' => 2,
                'nama' => 'Admin Transport',
                'email' => 'admin@mail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'company_id' => 1,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'nama' => 'User Demo',
                'email' => 'user@mail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'company_id' => null,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'nama' => 'User Kedua',
                'email' => 'user2@mail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'company_id' => null,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // LOKASI
        DB::table('lokasi')->insert([
            ['id' => 1, 'nama' => 'Jakarta', 'kode' => 'JKT', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'nama' => 'Bandung', 'kode' => 'BDG', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'nama' => 'Surabaya', 'kode' => 'SBY', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'nama' => 'Yogyakarta', 'kode' => 'YGY', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'nama' => 'Denpasar', 'kode' => 'DPS', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // TRANSPORTASI
        DB::table('transportasi')->insert([
            [
                'id' => 1,
                'tipe' => 'kereta',
                'nama_brand' => 'KAI Eksekutif',
                'kode_identitas' => 'KA-EX-01',
                'kapasitas' => 80,
                'user_id' => 2,
                'fasilitas' => json_encode(['ac', 'makan', 'usb']),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'tipe' => 'pesawat',
                'nama_brand' => 'Garuda Indonesia',
                'kode_identitas' => 'GA-737',
                'kapasitas' => 180,
                'user_id' => 2,

                'fasilitas' => json_encode(['ac', 'makan', 'usb']),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'tipe' => 'bus',
                'nama_brand' => 'PO Haryanto',
                'kode_identitas' => 'BUS-HT-01',
                'kapasitas' => 48,
                'user_id' => 2,
                'fasilitas' => json_encode(['ac', 'makan', 'usb']),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // JADWAL
        DB::table('jadwal')->insert([
            [
                'id' => 1,
                'transportasi_id' => 1,
                'asal_id' => 1,
                'tujuan_id' => 2,
                'waktu_berangkat' => $now->copy()->addDays(1),
                'waktu_tiba' => $now->copy()->addDays(1)->addHours(3),
                'harga' => 250000,
                'info_lokasi' => 'Stasiun Gambir',
                'stok_tersedia' => 150,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'transportasi_id' => 2,
                'asal_id' => 1,
                'tujuan_id' => 3,
                'waktu_berangkat' => $now->copy()->addDays(2),
                'waktu_tiba' => $now->copy()->addDays(2)->addHours(2),
                'harga' => 1200000,
                'info_lokasi' => 'Bandara Soekarno-Hatta',
                'stok_tersedia' => 100,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'transportasi_id' => 3,
                'asal_id' => 2,
                'tujuan_id' => 4,
                'waktu_berangkat' => $now->copy()->addDays(3),
                'waktu_tiba' => $now->copy()->addDays(3)->addHours(8),
                'harga' => 180000,
                'info_lokasi' => 'Terminal Cicaheum',
                'stok_tersedia' => 40,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // NEW TODAY SCHEDULES (2 per transportasi)
            [
                'id' => 4,
                'transportasi_id' => 1,
                'asal_id' => 1,
                'tujuan_id' => 4,
                'waktu_berangkat' => $now->copy()->addHours(2),
                'waktu_tiba' => $now->copy()->addHours(6),
                'harga' => 350000,
                'info_lokasi' => 'Stasiun Pasar Senen',
                'stok_tersedia' => 120,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'transportasi_id' => 1,
                'asal_id' => 3,
                'tujuan_id' => 5,
                'waktu_berangkat' => $now->copy()->addHours(10),
                'waktu_tiba' => $now->copy()->addHours(16),
                'harga' => 450000,
                'info_lokasi' => 'Stasiun Pasar Turi',
                'stok_tersedia' => 180,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'transportasi_id' => 2,
                'asal_id' => 2,
                'tujuan_id' => 3,
                'waktu_berangkat' => $now->copy()->addHours(14),
                'waktu_tiba' => $now->copy()->addHours(15)->addMinutes(30),
                'harga' => 850000,
                'info_lokasi' => 'Bandara Husein Snd',
                'stok_tersedia' => 90,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'transportasi_id' => 2,
                'asal_id' => 4,
                'tujuan_id' => 1,
                'waktu_berangkat' => $now->copy()->addHours(18),
                'waktu_tiba' => $now->copy()->addHours(19),
                'harga' => 950000,
                'info_lokasi' => 'Bandara Adisutjipto',
                'stok_tersedia' => 110,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 8,
                'transportasi_id' => 3,
                'asal_id' => 1,
                'tujuan_id' => 2,
                'waktu_berangkat' => $now->copy()->addHours(8),
                'waktu_tiba' => $now->copy()->addHours(10)->addMinutes(30),
                'harga' => 120000,
                'info_lokasi' => 'Terminal Kampung Rambutan',
                'stok_tersedia' => 35,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 9,
                'transportasi_id' => 3,
                'asal_id' => 3,
                'tujuan_id' => 4,
                'waktu_berangkat' => $now->copy()->addHours(16),
                'waktu_tiba' => $now->copy()->addHours(26),
                'harga' => 220000,
                'info_lokasi' => 'Terminal Purabaya',
                'stok_tersedia' => 28,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // PEMESANAN
        DB::table('pemesanan')->insert([
            [
                'id' => 1,
                'kode_booking' => 'BOOK-001',
                'user_id' => 3,
                'jadwal_id' => 1,
                'nama_penumpang' => 'Budi Santoso',
                'nik' => '3276010101010001',
                'nomor_kursi' => 'A1',
                'total_harga' => 250000,
                'status' => 'paid',
                'qr_code_data' => 'QR-BOOK-001',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'kode_booking' => 'BOOK-002',
                'user_id' => 4,
                'jadwal_id' => 2,
                'nama_penumpang' => 'Siti Rahma',
                'nik' => '3276010101010002',
                'nomor_kursi' => '12B',
                'total_harga' => 1200000,
                'status' => 'pending',
                'qr_code_data' => 'QR-BOOK-002',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // PEMBAYARAN
        DB::table('pembayaran')->insert([
            [
                'id' => 1,
                'pemesanan_id' => 1,
                'metode_bayar' => 'transfer',
                'bukti_transfer' => 'bukti_001.jpg',
                'nominal_bayar' => 250000,
                'status' => 'paid',
                'payment_time' => $now,
                'verified_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}