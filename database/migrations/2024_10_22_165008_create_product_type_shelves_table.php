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
        Schema::create('product_type_shelves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_type_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('product_width_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('product_deep_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('color');
            $table->string('color_name');

            $table->string('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_type_shelves');
    }
};
