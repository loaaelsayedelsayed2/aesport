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
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['size', 'color']);

            $table->unsignedBigInteger('size_variant_id')->nullable();
            $table->unsignedBigInteger('color_variant_id')->nullable();

            $table->foreign('size_variant_id')
                ->references('id')->on('product_variants')
                ->cascadeOnDelete();

            $table->foreign('color_variant_id')
                ->references('id')->on('product_variants')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            //
        });
    }
};
