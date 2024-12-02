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
        Schema::create('subcategory_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('industry_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('category_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('subcategory_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('title_ro');
            $table->string('title_en');
            $table->string('title_ru');
            $table->text('description_ro')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ru')->nullable();
            $table->string('length')->nullable();
            $table->string('depth')->nullable();
            $table->string('height')->nullable();
            $table->string('material')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategory_types');
    }
};
