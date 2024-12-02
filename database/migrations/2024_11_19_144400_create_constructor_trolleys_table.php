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
        Schema::create('constructor_trolleys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('nesting_capacity')->nullable();
            $table->string('travelator_capacity')->nullable();
            $table->text('body_colors')->nullable();
            $table->text('handle_colors')->nullable();
            $table->text('back_colors')->nullable();
            $table->text('baby_seat_colors')->nullable();
            $table->text('basket_colors')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('constructor_trolleys');
    }
};
