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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->foreignId('slider_category_id')
                ->constrained();
            $table->string('name_ro');
            $table->string('name_en');
            $table->string('name_ru');
            $table->text('description_ro')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ru')->nullable();
            $table->integer('sort_order');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};