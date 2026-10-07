<?php

namespace App\Http\Controllers;

use App\Models\FeedHistory;

class FeedHistoryController extends Controller
{
    public function index()
    {
        return response()->json(
            FeedHistory::with('device')->latest('fed_at')->get()
        );
    }
}