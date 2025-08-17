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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul tulisan
            $table->string('slug')->unique(); // URL unik untuk SEO
            $table->longText('content'); // Konten utama tulisan, bisa berisi HTML
            $table->text('excerpt')->nullable(); // Ringkasan singkat dari tulisan
            $table->string('cover_image')->nullable(); // Path ke gambar sampul

            // Relasi ke penulis (users table)
            // onDelete('cascade') berarti jika user dihapus, semua post-nya juga akan terhapus.
            // Anda bisa menggantinya dengan onDelete('set null') jika penulis boleh null.
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Status & Visibilitas
            $table->enum('status', ['published', 'draft', 'pending_review', 'scheduled'])->default('draft');
            $table->enum('visibility', ['public', 'private', 'password_protected'])->default('public');
            $table->string('password')->nullable(); // Jika visibility = password_protected

            // Jadwal & Waktu
            $table->timestamp('published_at')->nullable(); // Waktu tulisan dipublikasikan (untuk post terjadwal)
            $table->timestamps(); // created_at dan updated_at
            $table->softDeletes(); // Untuk fitur "trash" atau "soft delete"

            // Data SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Data Tambahan
            $table->boolean('is_featured')->default(false); // Untuk menandai tulisan unggulan
            $table->unsignedBigInteger('view_count')->default(0); // Menghitung berapa kali tulisan dilihat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};