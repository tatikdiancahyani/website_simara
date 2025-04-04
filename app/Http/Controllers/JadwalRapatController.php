<?php

namespace App\Http\Controllers;

use App\Models\JadwalRapat;
use Illuminate\Http\Request;

class JadwalRapatController extends Controller
{
    
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'tempat' => 'required|string|max:255',
        ]);

        // Simpan ke database
        JadwalRapat::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
        ]);

        return redirect()->back()->with('success', 'Jadwal rapat berhasil disimpan.');
    }

    public function index()
{
    $jadwal = JadwalRapat::all(); // Ambil semua data jadwal rapat
    return response()->json($jadwal); // Kembalikan sebagai JSON
}


}