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
        Schema::create('unique_codes', function (Blueprint $table) {
            $table->id(); // ID auto increment
            $table->string('code')->unique(); // Kode unik, harus unik
            $table->unsignedBigInteger('category_id'); // Kategori ID yang merujuk ke tabel categories
            $table->boolean('is_used')->default(false); // Status apakah kode sudah digunakan atau belum
            $table->timestamps(); // Kolom created_at dan updated_at

            // Menambahkan foreign key yang menghubungkan category_id dengan id di tabel categories
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unique_codes');
    }
};
