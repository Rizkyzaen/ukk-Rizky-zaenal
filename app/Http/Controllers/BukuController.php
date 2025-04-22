<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index() {
        $bukus = Buku::all();
        return view('petugas.buku.index', compact('bukus'));
    }

    public function show(Buku $buku) {
        return view('petugas.buku.show', compact('buku'));
    }

    public function edit(Buku $buku) {
        return view('petugas.buku.edit', compact('buku'));
    }

    public function create() {
        return view('petugas.buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'kategori' => 'required|string',
            'stok' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Menyimpan file cover jika ada
        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('cover_buku', 'public');
        }

        // Menyimpan data buku ke database
        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'cover' => $coverPath,
        ]);

        return redirect()->route('petugas.buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cek jika ada cover baru dan hapus cover lama jika ada
        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($buku->cover && Storage::disk('public')->exists($buku->cover)) {
                Storage::disk('public')->delete($buku->cover);
            }

            // Upload cover baru
            $buku->cover = $request->file('cover')->store('cover_buku', 'public');
        }

        // Update informasi buku
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->kategori = $request->kategori;
        $buku->stok = $request->stok;
        $buku->save();

        return redirect()->route('petugas.buku.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json(['message' => 'buku not found'], 404);
        }

        // Hapus cover jika ada
        if ($buku->cover && Storage::disk('public')->exists($buku->cover)) {
            Storage::disk('public')->delete($buku->cover);
        }

        // Hapus data buku
        $buku->delete();
        return redirect()->route('petugas.buku.index')->with('success', 'Buku berhasil dihapus!');
    }
}
