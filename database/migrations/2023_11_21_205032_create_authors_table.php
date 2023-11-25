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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genre_id')->nullable();
            $table->string('name')->unique();
            $table->string('bio');
            $table->string('birth_year')->nullable();
            $table->string('death_year')->nullable();
            $table->boolean('is_alive')->default(true);
            $table->string('language');
            $table->string('link')->nullable();
            $table->string('media')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
