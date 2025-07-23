<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->json('keywords')->nullable()->after('content')
                ->comment('Массив ключевых слов для Яндекс.Директ');
        });

        Schema::table('service_categories', function (Blueprint $table) {
            $table->json('keywords')->nullable()->after('description')
                ->comment('Массив ключевых слов для Яндекс.Директ');
        });
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('keywords');
        });

        Schema::table('service_categories', function (Blueprint $table) {
            $table->dropColumn('keywords');
        });
    }
};
