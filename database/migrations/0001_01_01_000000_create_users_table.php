<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->char('kode_user', 6)->unique();
            $table->string('nama_user', 30);
            $table->string('username', 30)->unique();
            $table->string('password', 255);
            $table->unsignedBigInteger('id_role');
            $table->timestamps();
            $table->foreign('id_role')->references('id_role')->on('role')->onDelete('cascade');
        });

        // Menambahkan tabel password_reset_tokens tanpa kolom email
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('token')->primary(); // Set token sebagai primary key
            $table->timestamp('created_at')->nullable(); // Kolom untuk waktu pembuatan token
            // Anda bisa menambahkan kolom expires_at jika ingin masa berlaku token
            //$table->timestamp('expires_at')->nullable();
        });

        // Menambahkan tabel sessions (tetap ada)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index(); // Menyimpan ID pengguna yang terkait dengan sesi
            $table->string('ip_address', 45)->nullable(); // Menyimpan IP address pengguna
            $table->text('user_agent')->nullable(); // Menyimpan user agent
            $table->longText('payload'); // Menyimpan payload sesi
            $table->integer('last_activity')->index(); // Menyimpan waktu terakhir aktivitas
        });
    }

    public function down(): void
    {
        // Menghapus tabel yang telah dibuat
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
