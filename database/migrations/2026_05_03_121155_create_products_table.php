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
    Schema::create('products', function (Blueprint $table) {
        $id = $table->id();
        $table->string('name');
        $table->string('version');
        $table->string('slug')->unique();
        $table->string('image')->nullable();
        $table->string('category'); // PS5 atau PS4
        $table->string('status')->default('Available');
        $table->string('cpu');
        $table->string('resolution');
        $table->string('storage');
        $table->string('connectivity');
        $table->text('included_games');
        $table->integer('price_per_hour');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
