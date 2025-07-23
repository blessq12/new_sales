<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('telegram_chats', function (Blueprint $table) {
            $table->string('flow_state')->nullable()->after('entities');
            $table->json('flow_data')->nullable()->after('flow_state');
        });
    }

    public function down()
    {
        Schema::table('telegram_chats', function (Blueprint $table) {
            $table->dropColumn(['flow_state', 'flow_data']);
        });
    }
};
