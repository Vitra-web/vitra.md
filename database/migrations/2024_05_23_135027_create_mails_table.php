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
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->integer('vacancy_id')->nullable();
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('file')->nullable();
            $table->text('message')->nullable();
            $table->string('type')->nullable();
            $table->integer('source');
            $table->integer('vacancyNotification')->nullable();
            $table->integer('newsNotification')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mails');
    }
};
