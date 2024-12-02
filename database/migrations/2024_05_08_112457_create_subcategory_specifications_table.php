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
        Schema::create('subcategory_specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('length')->nullable();
            $table->string('depth')->nullable();
            $table->string('height')->nullable();
            $table->string('material')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategory_specifications');
    }
};
