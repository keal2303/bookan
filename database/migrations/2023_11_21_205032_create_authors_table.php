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
            $table->unsignedBigInteger('genre_id');
            $table->string('name')->unique();
            $table->string('bio');
            $table->year('birth_year');
            $table->year('death_year')->nullable();
            $table->boolean('is_alive');
            $table->string('nationality');
            $table->string('website');
            $table->string('media');
            $table->timestamps();

            $table->foreign('genre_id')->references('id')->on('genres');
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
