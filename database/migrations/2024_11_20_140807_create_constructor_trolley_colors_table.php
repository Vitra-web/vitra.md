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
        Schema::create('constructor_trolley_colors', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name_ro');
            $table->string('name_ru');
            $table->string('name_en');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('constructor_trolley_colors');
    }
};
