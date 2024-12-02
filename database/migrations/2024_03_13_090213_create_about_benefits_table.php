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
        Schema::create('about_benefits', function (Blueprint $table) {
            $table->id();
            $table->integer('main_page')->nullable();
            $table->string('title_ro')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_ru')->nullable();
            $table->integer('number');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_benefits');
    }
};
