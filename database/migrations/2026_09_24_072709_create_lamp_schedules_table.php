<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lamp_schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('device_id')
                  ->constrained('devices')
                  ->cascadeOnDelete();

            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('auto_mode')->default(true);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lamp_schedules');
    }
};