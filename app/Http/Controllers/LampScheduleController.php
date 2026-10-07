<?php

namespace App\Http\Controllers;

use App\Models\LampSchedule;
use Illuminate\Http\Request;

class LampScheduleController extends Controller
{
    public function index()
    {
        return response()->json(
            LampSchedule::with('device')->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'auto_mode' => 'required|boolean',
            'is_active' => 'required|boolean',
            'days' => 'nullable|array',
        ]);

        $schedule = LampSchedule::updateOrCreate(
            [
                'device_id' => $validated['device_id'],
            ],
            [
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'auto_mode' => $validated['auto_mode'],
                'is_active' => $validated['is_active'],
                'days' => $validated['days'] ?? [],
            ]
        );

        return response()->json(
            $schedule->load('device'),
            201
        );
    }

    // PUT - memperbarui jadwal lampu berdasarkan ID
    public function update(Request $request, $id)
    {
        $schedule = LampSchedule::findOrFail($id);

        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'auto_mode' => 'required|boolean',
            'is_active' => 'required|boolean',
            'days' => 'nullable|array',
        ]);

        $schedule->update([
            'device_id' => $validated['device_id'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'auto_mode' => $validated['auto_mode'],
            'is_active' => $validated['is_active'],
            'days' => $validated['days'] ?? [],
        ]);

        return response()->json(
            $schedule->load('device')
        );
    }

    // DELETE - menghapus jadwal lampu berdasarkan ID
    public function destroy($id)
    {
        $schedule = LampSchedule::findOrFail($id);

        $schedule->delete();

        return response()->json([
            'message' => 'Jadwal lampu berhasil dihapus'
        ]);
    }
}