<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['superadmin', 'admin', 'user']);
            $table->timestamps();
        });

        // Password Reset Tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Personal Access Tokens (Sanctum)
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });


        // Sessions (optional, tapi sering dipakai)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        Schema::create('lokasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode', 10);
            $table->timestamps();
        });

        // Transportasi Table
        Schema::create('transportasi', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['pesawat', 'bus', 'kereta', 'kapal']);
            $table->string('nama_brand');
            $table->string('kode_identitas');
            $table->integer('kapasitas');

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();
        });

        // Jadwal Table
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transportasi_id')
                ->constrained('transportasi')
                ->cascadeOnDelete();
            $table->foreignId('asal_id')->constrained('lokasi');
            $table->foreignId('tujuan_id')->constrained('lokasi');
            $table->dateTime('waktu_berangkat');
            $table->dateTime('waktu_tiba');
            $table->unsignedBigInteger('harga');
            $table->string('info_lokasi');
            $table->integer('stok_tersedia');
            $table->index(['titik_asal', 'titik_tujuan', 'waktu_berangkat']);
            $table->index('transportasi_id');
            $table->timestamps();
        });

        // Pemesanan Table
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking')->unique();
            $table->timestamp('expired_at')->nullable();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('jadwal_id')
                ->constrained('jadwal')
                ->cascadeOnDelete();
            $table->string('nama_penumpang');
            $table->string('nik', 16);
            $table->string('nomor_kursi');
            $table->enum('status', ['pending', 'paid', 'canceled', 'completed']);
            $table->text('qr_code_data');
            $table->unsignedBigInteger('total_harga');
            $table->unique(['jadwal_id', 'nomor_kursi']);
            $table->timestamps();
        });

        // Pembayaran Table
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pemesanan_id')
                ->constrained('pemesanan')
                ->cascadeOnDelete();
            $table->enum('status', [
                'unpaid',
                'paid',
            ])->default('unpaid');
            $table->string('metode_bayar');
            $table->string('bukti_transfer')->nullable();
            $table->timestamp('payment_time')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->unsignedBigInteger('nominal_bayar');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('pemesanan');
        Schema::dropIfExists('jadwal');
        Schema::dropIfExists('transportasi');
        Schema::dropIfExists('lokasi');
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('password_reset_tokens');

    }
};