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
            $table->id('ProductID');
            $table->unsignedBigInteger('FarmerID');
            $table->string('ProductName', 100);
            $table->string('Category', 50)->nullable();
            $table->text('Description')->nullable();
            $table->decimal('Price', 10, 2);
            $table->integer('Quantity');
            $table->string('Image', 255)->nullable();
            $table->timestamp('CreatedAt')->useCurrent();
            
            $table->foreign('FarmerID')->references('UserID')->on('users')->onDelete('cascade');
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
