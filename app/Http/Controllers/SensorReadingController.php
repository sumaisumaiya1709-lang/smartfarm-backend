<?php

namespace App\Http\Controllers;

use App\Models\SensorReading;

class SensorReadingController extends Controller
{
    public function index()
    {
        return response()->json(
            SensorReading::with('device')->latest('recorded_at')->get()
        );
    }
}