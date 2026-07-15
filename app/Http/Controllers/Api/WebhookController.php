<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanBencana;

class WebhookController extends Controller
{
    public function terimaDariWhatsapp(Request $request)
    {
        // Validasi Token Keamanan Prototipe
        if ($request->token !== 'SITABA_PROTOTYPE_SECRET_2026') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validasi input dasar
        $request->validate([
            'nomor_pelapor' => 'required',
            'deskripsi' => 'required'
        ]);

        // Simpan ke database
        $laporan = LaporanBencana::create([
            'nomor_pelapor' => $request->nomor_pelapor,
            'deskripsi' => $request->deskripsi,
            'kabupaten' => $request->kabupaten,
            'status_laporan' => $request->status_laporan ?? 'Baru',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan sukses masuk database SITABA',
            'data' => $laporan
        ], 201);
    }
}