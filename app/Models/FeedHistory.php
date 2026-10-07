<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedHistory extends Model
{
    use HasFactory;

    protected $table = 'feed_history';

    protected $fillable = [
        'device_id',
        'feed_amount',
        'trigger_type',
        'status',
        'fed_at',
    ];

    protected $casts = [
        'feed_amount' => 'float',
        'fed_at' => 'datetime',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}