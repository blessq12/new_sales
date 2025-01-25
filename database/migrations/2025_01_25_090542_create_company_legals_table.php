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
        Schema::create('company_legals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Company::class);
            $table->string('account_number');
            $table->string('currency');
            $table->string('name');
            $table->string('inn');
            $table->string('kpp');
            $table->string('bank');
            $table->string('bik');
            $table->string('correspondent_account');
            $table->string('legal_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_legals');
    }
};
