<?php

namespace App\Http\Controllers;

use App\Models\FeedSchedule;
use Illuminate\Http\Request;

class FeedScheduleController extends Controller
{
    // GET - mengambil semua jadwal pakan
    public function index()
    {
        return response()->json(
            FeedSchedule::with('device')->get()
        );
    }

    // POST - menyimpan jadwal pakan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'feeding_time' => 'required|date_format:H:i',
            'feed_amount' => 'required|numeric|min:100|max:2000',
            'is_active' => 'required|boolean',
            'days' => 'nullable|array',
        ]);

        $schedule = FeedSchedule::updateOrCreate(
            [
                'device_id' => $validated['device_id'],
            ],
            [
                'feeding_time' => $validated['feeding_time'],
                'feed_amount' => $validated['feed_amount'],
                'is_active' => $validated['is_active'],
                'days' => $validated['days'] ?? [],
            ]
        );

        return response()->json(
            $schedule->load('device'),
            201
        );
    }

    // PUT - memperbarui jadwal pakan berdasarkan ID
    public function update(Request $request, $id)
    {
        $schedule = FeedSchedule::findOrFail($id);

        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'feeding_time' => 'required|date_format:H:i',
            'feed_amount' => 'required|numeric|min:100|max:2000',
            'is_active' => 'required|boolean',
            'days' => 'nullable|array',
        ]);

        $schedule->update([
            'device_id' => $validated['device_id'],
            'feeding_time' => $validated['feeding_time'],
            'feed_amount' => $validated['feed_amount'],
            'is_active' => $validated['is_active'],
            'days' => $validated['days'] ?? [],
        ]);

        return response()->json(
            $schedule->load('device')
        );
    }

    // DELETE - menghapus jadwal pakan berdasarkan ID
    public function destroy($id)
    {
        $schedule = FeedSchedule::findOrFail($id);

        $schedule->delete();

        return response()->json([
            'message' => 'Jadwal pakan berhasil dihapus'
        ]);
    }
}