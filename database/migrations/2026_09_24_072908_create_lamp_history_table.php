<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lamp_history', function (Blueprint $table) {
            $table->id();

            $table->foreignId('device_id')
                  ->constrained('devices')
                  ->cascadeOnDelete();

            $table->boolean('lamp_status');
            $table->string('trigger_type', 20)->default('automatic');
            $table->string('status', 20)->default('success');
            $table->timestamp('changed_at')->useCurrent();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lamp_history');
    }
};