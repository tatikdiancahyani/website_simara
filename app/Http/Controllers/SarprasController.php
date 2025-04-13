<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sarpras;

class SarprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sarpras = Sarpras::orderBy('created_at', 'DESC')->get();

        return view('sarpras.index', compact('sarpras'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sarpras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_sarpras' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'pajak' => 'nullable|numeric|min:0',
            'anggaran' => 'required|numeric|min:0',
            'tanggal_pengadaan' => 'required|date', // Validasi untuk kolom tanggal
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        // Simpan data ke database
        $sarpras = new Sarpras();
        $sarpras->nama_sarpras = $request->input('nama_sarpras');
        $sarpras->jumlah = $request->input('jumlah');
        $sarpras->harga = $request->input('harga');
        $sarpras->pajak = $request->input('pajak', 0);
        $sarpras->anggaran = $request->input('anggaran');
        $sarpras->tanggal_pengadaan = $request->input('tanggal_pengadaan'); // Menyimpan tanggal pengadaan
        $sarpras->save();

        // Proses file gambar tanpa menyimpan ke database
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('uploads/gambar', 'public');
                // Tidak menyimpan $path ke database
            }
        }

        return redirect()->route('sarpras')->with('success', 'Data sarpras berhasil disimpan!');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sarpras = Sarpras::findOrFail($id);

        return view('sarpras.show', compact('sarpras'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sarpras = Sarpras::findOrFail($id);

        return view('sarpras.edit', compact('sarpras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cari data
        $sarpras = Sarpras::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama_sarpras' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'pajak' => 'nullable|numeric|min:0',
            'anggaran' => 'required|numeric|min:0',
            'tanggal_pengadaan' => 'required|date',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        // Update data ke database tanpa kolom 'total'
        $sarpras->nama_sarpras = $request->input('nama_sarpras');
        $sarpras->jumlah = $request->input('jumlah');
        $sarpras->harga = $request->input('harga');
        $sarpras->pajak = $request->input('pajak', 0);
        $sarpras->anggaran = $request->input('anggaran');
        $sarpras->tanggal_pengadaan = $request->input('tanggal_pengadaan');
        $sarpras->save();

        return redirect()->route('sarpras')->with('success', 'Data sarpras berhasil diupdate!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sarpras = Sarpras::findOrFail($id);

        $sarpras->delete();

        return redirect()->route('sarpras')->with('success', 'sarpras deleted successfully');
    }
}
