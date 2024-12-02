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
        Schema::create('wheel_constructor_trolleys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wheel_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('constructor_trolley_id')
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wheel_constructor_trolleys');
    }
};
