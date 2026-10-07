<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LampHistory extends Model
{
    use HasFactory;

    protected $table = 'lamp_history';

    protected $fillable = [
        'device_id',
        'lamp_status',
        'trigger_type',
        'status',
        'changed_at',
    ];

    protected $casts = [
        'lamp_status' => 'boolean',
        'changed_at' => 'datetime',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}