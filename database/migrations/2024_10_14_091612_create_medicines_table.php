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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('unit_id');
            $table->integer('stock');
            $table->decimal('price_buy', 10, 2);
            $table->decimal('price_sell', 10, 2);
            $table->text('description')->nullable();
            $table->timestamps();
            // Relasi
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('unit_id')->references('unit_id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
