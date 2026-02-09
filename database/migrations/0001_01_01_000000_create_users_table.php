<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // User Tabel
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['superAdmin', 'admin', 'user']);
            $table->timestamp('created_at');
        });

        //Transportasi Tabel
        Schema::create('transportasi', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['pesawat', 'bus', 'kereta', 'kapal']);
            $table->string('nama_brand');
            $table->string('kode_identitas');
            $table->integer('kapasitas');
            $table->integer('admin_id')
                ->foreignId('user_id')
                ->constrained('user')
                ->cascadeOnDelete();

        });

        //Jadwal Tabel
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->integer('transportasi_id')
                ->foreignId('transportasi_id')
                ->constrained('transportasi')
                ->cascadeOnDelete();
            $table->string('titik_asal');
            $table->string('titik_tujuan');
            $table->dateTime('waktu_berangkat');
            $table->dateTime('waktu_tiba');
            $table->decimal(15, 2);
            $table->string('info_lokasi');
            $table->integer('stok_tersedia');
        });

        //Pemesanan Tabel
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking')->unique();
            $table->integer('user_id')
                ->foreignId('user_id')
                ->constrained('user')
                ->cascadeOnDelete();
            $table->integer('jadwal_id')
                ->foreignId('jadwal_id')
                ->constrained('jadwal')
                ->cascadeOnDelete();
            $table->string('nomor_kursi');
            $table->decimal(15, 2); //total harga 
            $table->enum('status', ['pending', 'paid', 'canceled', 'completed']);
            $table->text('qr_code_data');
            $table->timestamp('created_at');
        });

        //Pembayaran Tabel
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id')
                ->foreignId('pemesanan_id')
                ->constrained('pemesanan')
                ->cascadeOnDelete();
            $table->string('metode_bayar');
            $table->string('bukti_transfer');
            $table->decimal(15, 2, ); //nominal bayar
            $table->timestamp('payment_time');
            $table->timestamp('verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('transportasi');
        Schema::dropIfExists('jadwal');
        Schema::dropIfExists('pemesanan');
        Schema::dropIfExists('pembayaran');
    }
};
