<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Membuat tabel 'role'
        Schema::create('role', function (Blueprint $table) {
            $table->id('id_role'); // ID sebagai primary key
            $table->char('kode_role', 6)->unique(); // Kode role dengan panjang 6 karakter dan unique
            $table->string('nama_role', 50); // Nama role
        });

        // Membuat trigger untuk mengisi kode_role otomatis
        DB::unprepared('
            CREATE TRIGGER trigger_kode_role
            BEFORE INSERT ON role
            FOR EACH ROW
            BEGIN
                DECLARE last_code INT;

                -- Mengambil kode_role terakhir
                SELECT MAX(CAST(SUBSTRING(kode_role, 4) AS UNSIGNED)) INTO last_code
                FROM role
                WHERE kode_role LIKE "RO-%";

                -- Menentukan kode role berikutnya
                IF last_code IS NULL THEN
                    SET last_code = 0;
                END IF;

                -- Menyusun kode_role baru dengan menambahkan 1
                SET NEW.kode_role = CONCAT("RO-", LPAD(last_code + 1, 3, "0"));
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop trigger sebelum menghapus tabel role
        DB::unprepared('DROP TRIGGER IF EXISTS trigger_kode_role');

        // Drop tabel 'role'
        Schema::dropIfExists('role');
    }
};
