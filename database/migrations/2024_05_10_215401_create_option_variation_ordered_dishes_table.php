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
        Schema::create('option_variation_ordered_dishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('option_variation_id')->constrained()->onDelete('cascade');
            $table->foreignId('ordered_dish_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_variation_ordered_dishes');
    }
};
