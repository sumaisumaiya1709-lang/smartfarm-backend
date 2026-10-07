<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LampSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'start_time',
        'end_time',
        'auto_mode',
        'is_active',
        'days',
    ];

    protected $casts = [
        'auto_mode' => 'boolean',
        'is_active' => 'boolean',
        'days' => 'array',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}