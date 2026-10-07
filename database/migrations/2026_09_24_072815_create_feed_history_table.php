<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('feed_history', function (Blueprint $table) {
            $table->id();

            $table->foreignId('device_id')
                  ->constrained('devices')
                  ->cascadeOnDelete();

            $table->decimal('feed_amount', 6, 2);
            $table->string('trigger_type', 20)->default('automatic');
            $table->string('status', 20)->default('success');
            $table->timestamp('fed_at')->useCurrent();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feed_history');
    }
};