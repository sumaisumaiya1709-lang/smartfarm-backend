<?php

namespace App\Http\Controllers;

use App\Models\Device;

class DeviceController extends Controller
{
    public function index()
    {
        return response()->json(
            Device::all()
        );
    }
}