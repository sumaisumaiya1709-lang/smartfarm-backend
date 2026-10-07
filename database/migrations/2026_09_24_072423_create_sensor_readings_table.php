<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sensor_readings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('device_id')
                  ->constrained('devices')
                  ->cascadeOnDelete();

            $table->decimal('temperature', 5, 2)->nullable();
            $table->decimal('humidity', 5, 2)->nullable();
            $table->decimal('feed_stock', 5, 2)->nullable();
            $table->string('light_condition', 20)->nullable();

            $table->timestamp('recorded_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sensor_readings');
    }
};