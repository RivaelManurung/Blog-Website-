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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');

            // Jika komentar harus dari user yang login
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Untuk komentar bertingkat (balasan)
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');

            $table->text('content');
            $table->boolean('is_approved')->default(true); // Untuk moderasi komentar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};