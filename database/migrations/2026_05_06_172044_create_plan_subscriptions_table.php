<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pricing_plan_id')->constrained('pricing_plans')->onDelete('cascade');
            $table->date('start_date'); // Tanggal mulai langganan paket
            $table->integer('price_snapshot'); // Menyimpan harga saat itu (jaga-jaga jika harga paket naik nanti)
            $table->string('status')->default('Pending'); // Pending, Active, Completed, Cancelled
            $table->string('payment_proof')->nullable(); // Bukti TF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_subscriptions');
    }
};
