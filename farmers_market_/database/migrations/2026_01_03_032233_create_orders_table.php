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
            $table->id('OrderID');
            $table->unsignedBigInteger('BuyerID');
            $table->string('FullName', 100);
            $table->string('Phone', 15);
            $table->string('Email', 100);
            $table->string('DeliveryAddress', 120);
            $table->string('City', 50);
            $table->string('Pincode', 10);
            $table->timestamp('OrderDate')->useCurrent();
            $table->enum('Status', ['Pending', 'Shipped', 'Delivered', 'Cancelled'])->default('Pending');
            $table->decimal('TotalAmount', 10, 2)->nullable();
            
            $table->foreign('BuyerID')->references('UserID')->on('users')->onDelete('cascade');
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
