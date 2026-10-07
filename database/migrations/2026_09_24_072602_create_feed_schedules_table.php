<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('feed_schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('device_id')
                  ->constrained('devices')
                  ->cascadeOnDelete();

            $table->time('feeding_time');
            $table->decimal('feed_amount', 6, 2);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feed_schedules');
    }
};