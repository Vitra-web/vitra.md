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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('industry_id')
                ->constrained()
                ->onDelete('cascade');
            $table->integer('status');
            $table->integer('sort_order');
            $table->string('image_preview');
            $table->string('image_main');
            $table->string('name_ro');
            $table->string('name_en');
            $table->string('name_ru');
            $table->text('description_ro');
            $table->text('description_en');
            $table->text('description_ru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
