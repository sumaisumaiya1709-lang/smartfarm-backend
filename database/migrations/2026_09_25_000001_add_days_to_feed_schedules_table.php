<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('feed_schedules', function (Blueprint $table) {
            $table->json('days')->nullable()->after('is_active');
        });
    }

    public function down()
    {
        Schema::table('feed_schedules', function (Blueprint $table) {
            $table->dropColumn('days');
        });
    }
};