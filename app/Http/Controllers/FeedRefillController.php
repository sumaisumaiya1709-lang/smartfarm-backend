<?php

namespace App\Http\Controllers;

use App\Models\SensorReading;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FeedRefillController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'amount_kg' => 'required|numeric|min:1|max:50',
        ]);

        // Ambil data sensor terakhir
        $latestSensor = SensorReading::where(
            'device_id',
            $validated['device_id']
        )
        ->latest('recorded_at')
        ->first();

        if (!$latestSensor) {
            return response()->json([
                'message' => 'Data sensor pakan belum tersedia.'
            ], 404);
        }

        // Stok saat ini dalam persen
        $stokSebelum = (float) $latestSensor->feed_stock;

        /*
         * Untuk sementara 1 kg dianggap menambah 10%.
         * Nanti ketika hardware sudah tersedia,
         * perhitungan dapat disesuaikan dengan sensor nyata.
         */
        $tambahanPersen = $validated['amount_kg'] * 10;

        $stokSesudah = min(
            100,
            $stokSebelum + $tambahanPersen
        );

        // Simpan pembacaan sensor terbaru
        $newSensor = SensorReading::create([
            'device_id' => $validated['device_id'],
            'temperature' => $latestSensor->temperature,
            'humidity' => $latestSensor->humidity,
            'feed_stock' => $stokSesudah,
            'light_condition' => $latestSensor->light_condition,
            'recorded_at' => Carbon::now(),
        ]);

        // Catat aktivitas
        ActivityLog::create([
            'device_id' => $validated['device_id'],
            'activity_type' => 'feed',
            'description' => 'Isi ulang pakan oleh pengguna (+' . $validated['amount_kg'] . ' kg)',
            'status' => 'success',
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'message' => 'Isi ulang pakan berhasil.',
            'stok_sebelum' => $stokSebelum,
            'stok_sesudah' => $stokSesudah,
            'amount_kg' => $validated['amount_kg'],
            'sensor' => $newSensor,
        ], 201);
    }
}