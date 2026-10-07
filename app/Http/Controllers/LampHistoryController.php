<?php

namespace App\Http\Controllers;

use App\Models\LampHistory;

class LampHistoryController extends Controller
{
    public function index()
    {
        return response()->json(
            LampHistory::with('device')->latest('changed_at')->get()
        );
    }
}