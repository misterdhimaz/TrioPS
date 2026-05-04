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
    Schema::create('playstations', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->enum('category', ['PS3', 'PS4', 'PS5']);
        $table->integer('price_per_hour');
        $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playstations');
    }
};
