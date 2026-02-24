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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model_number')->nullable();
            $table->text('description')->nullable();
            $table->text('main_image')->nullable();
            $table->decimal('price_before_discount', 8, 2);
            $table->decimal('discount_price', 8, 2)->nullable();
            $table->enum('discount_type', ['percentage', 'fixed'])->default('fixed');
            $table->decimal('price', 8, 2);
            $table->integer('quantity')->default(0);
            $table->boolean('in_stock')->default(true);
            $table->boolean('is_active')->default(true);
            $table->text('additional_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
