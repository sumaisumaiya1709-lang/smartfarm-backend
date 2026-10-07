<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'temperature',
        'humidity',
        'feed_stock',
        'light_condition',
        'recorded_at',
    ];

    protected $casts = [
        'temperature' => 'float',
        'humidity' => 'float',
        'feed_stock' => 'float',
        'recorded_at' => 'datetime',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}