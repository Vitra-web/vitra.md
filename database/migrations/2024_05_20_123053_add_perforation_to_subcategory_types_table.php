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
        Schema::table('subcategory_types', function (Blueprint $table) {
            $table->string('perforation_pitch');
            $table->string('inclination_angle');
            $table->string('shelf_height');
            $table->string('coating_ro');
            $table->string('coating_en');
            $table->string('coating_ru');
            $table->string('type_ro');
            $table->string('type_en');
            $table->string('type_ru');
            $table->string('components_ro');
            $table->string('components_en');
            $table->string('components_ru');
            $table->string('install_ro');
            $table->string('install_en');
            $table->string('install_ru');
            $table->string('panel_type_ro');
            $table->string('panel_type_en');
            $table->string('panel_type_ru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subcategory_types', function (Blueprint $table) {
            $table->dropColumn('perforation_pitch');
            $table->dropColumn('inclination_angle');
            $table->dropColumn('shelf_height');
            $table->dropColumn('coating_ro');
            $table->dropColumn('coating_en');
            $table->dropColumn('coating_ru');
            $table->dropColumn('type_ro');
            $table->dropColumn('type_en');
            $table->dropColumn('type_ru');
            $table->dropColumn('components_ro');
            $table->dropColumn('components_en');
            $table->dropColumn('components_ru');
            $table->dropColumn('install_ro');
            $table->dropColumn('install_en');
            $table->dropColumn('install_ru');
            $table->dropColumn('panel_type_ro');
            $table->dropColumn('panel_type_en');
            $table->dropColumn('panel_type_ru');
        });
    }
};
