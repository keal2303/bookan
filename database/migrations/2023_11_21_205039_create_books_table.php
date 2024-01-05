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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id')->nullable();;
            $table->unsignedBigInteger('genre_id')->nullable();;
            $table->string('title');
            $table->text('description');
            $table->string('isbn')->unique();
            $table->string('language');
            $table->string('published_year');
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->string('is_bookan_original')->default(false);
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('authors')->onDelete('set null');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
