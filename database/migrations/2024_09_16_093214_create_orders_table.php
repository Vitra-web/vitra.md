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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->string('status');
            $table->integer('user_id')->nullable();
            $table->string('name');
            $table->string('surname');
            $table->string('phone');
            $table->string('email');
            $table->string('location');
            $table->string('address')->nullable();
            $table->string('juridic_type')->nullable();
            $table->string('company_name')->nullable();
            $table->string('tva')->nullable();
            $table->string('juridic_address')->nullable();
            $table->string('fiscal_code')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('iban')->nullable();


            $table->integer('paymentType');
            $table->integer('deliveryType');
            $table->text('comment')->nullable();
            $table->text('products');
            $table->integer('priceProducts');
            $table->integer('priceDelivery');
            $table->integer('priceTotal');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
