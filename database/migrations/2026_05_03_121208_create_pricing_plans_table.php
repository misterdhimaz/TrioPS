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
    Schema::create('pricing_plans', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Day Pass, Weekend Pack, Elite Week
        $table->string('subtitle'); // Perfect for a quick session
        $table->string('badge')->nullable(); // Most Popular, Best Value
        $table->integer('price'); // 100000
        $table->string('duration_text'); // per day, for 3 days
        $table->text('features'); // List fitur (JSON)
        $table->string('color_theme'); // purple, cyan, amber (untuk sesuaikan desain)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_plans');
    }
};
