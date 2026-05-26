<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('pengajuan_buku', function (Blueprint $table) {
    $table->id();

    $table->string('judul');
    $table->string('penulis');
    $table->string('penerbit');
    $table->string('cover')->nullable();

    $table->integer('stok')->default(0);

    $table->enum('status', [
        'menunggu',
        'disetujui',
        'ditolak'
    ])->default('menunggu');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_bukus');
    }
};
