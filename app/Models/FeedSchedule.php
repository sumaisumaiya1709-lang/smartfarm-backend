<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'feeding_time',
        'feed_amount',
        'is_active',
        'days',
    ];

    protected $casts = [
        'feed_amount' => 'float',
        'is_active' => 'boolean',
        'days' => 'array',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}