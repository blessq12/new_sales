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

            $table->bigInteger('client_id')->nullable();
            $table->bigInteger('service_id')->nullable();

            $table->string('name');
            $table->string('phone');

            $table->string('comment')->nullable();

            $table->string('status')->default('new');
            $table->string('payment_status')->default('not_paid');

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
