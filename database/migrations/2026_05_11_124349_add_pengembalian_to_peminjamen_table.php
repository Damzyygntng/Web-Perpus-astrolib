<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {

           $table->enum('status_pengembalian', [
            'menunggu',
            'dikembalikan',
            'ditolak'
])->default('menunggu');

        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            $table->dropColumn('status_pengembalian');

        });
    }
};