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
        Schema::create('order_dish_user_option_variation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_dish_user_id')->constrained('order_dish_user')->onDelete('cascade');
            $table->foreignId('option_variation_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_dish_user_option_variation');
    }
};
