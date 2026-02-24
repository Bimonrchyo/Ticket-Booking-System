<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // USERS
        DB::table('users')->insert([
            [
                'id' => 1,
                'nama' => 'Super Admin',
                'email' => 'superadmin@mail.com',
                'password' => Hash::make('password'),
                'role' => 'superAdmin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama' => 'Admin Transport',
                'email' => 'admin@mail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama' => 'User Demo',
                'email' => 'user@mail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // TRANSPORTASI
        DB::table('transportasi')->insert([
            [
                'id' => 1,
                'tipe' => 'kereta',
                'nama_brand' => 'KAI Eksekutif',
                'kode_identitas' => 'KA-EX-01',
                'kapasitas' => 200,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'tipe' => 'pesawat',
                'nama_brand' => 'Garuda Indonesia',
                'kode_identitas' => 'GA-737',
                'kapasitas' => 180,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // JADWAL
        DB::table('jadwal')->insert([
            [
                'id' => 1,
                'transportasi_id' => 1,
                'titik_asal' => 'Jakarta',
                'titik_tujuan' => 'Bandung',
                'waktu_berangkat' => now()->addDay(),
                'waktu_tiba' => now()->addDay()->addHours(3),
                'harga' => 250000,
                'info_lokasi' => 'Stasiun Gambir',
                'stok_tersedia' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'transportasi_id' => 2,
                'titik_asal' => 'Jakarta',
                'titik_tujuan' => 'Surabaya',
                'waktu_berangkat' => now()->addDays(2),
                'waktu_tiba' => now()->addDays(2)->addHours(2),
                'harga' => 1200000,
                'info_lokasi' => 'Bandara Soekarno-Hatta',
                'stok_tersedia' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // PEMESANAN
        DB::table('pemesanan')->insert([
            [
                'id' => 1,
                'kode_booking' => 'BOOK-001',
                'user_id' => 3,
                'jadwal_id' => 1,
                'nomor_kursi' => 'A1',
                'total_harga' => 250000,
                'status' => 'paid',
                'qr_code_data' => 'QR-DATA-BOOK-001',
                'created_at' => now(),
                'updated_at' => now(),
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
                'payment_time' => now(),
                'verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
