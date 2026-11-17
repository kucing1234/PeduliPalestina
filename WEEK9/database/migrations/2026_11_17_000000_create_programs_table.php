<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration: buat tabel `programs`.
     * Kolom wajib dari tugas: id, nama, deskripsi, timestamps.
     * Kolom tambahan (kategori, target, terkumpul) dipakai agar progress bar
     * PeduliPalestina tetap tampil dari database.
     */
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('kategori')->default('Umum');
            $table->unsignedBigInteger('target')->default(0);
            $table->unsignedBigInteger('terkumpul')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (php artisan migrate:rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
