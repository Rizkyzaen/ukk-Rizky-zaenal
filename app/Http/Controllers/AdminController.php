<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Pinjam;

class AdminController extends Controller
{
    public function index(Request $request)
{
    $query = Pinjam::with(['user', 'buku']);

    // Search functionality
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->whereHas('user', function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
        })->orWhereHas('buku', function($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%");
        });
    }

    // Status filter
    if ($request->has('status') && !empty($request->status)) {
        $query->where('status', $request->status);
    }

    // Date filter
    if ($request->has('date') && !empty($request->date)) {
        $query->whereDate('dipinjam_date', $request->date);
    }

    $pinjams = $query->latest('dipinjam_date')->paginate(10);

    return view('petugas.dashboard', compact('pinjams'));
}

    public function destroy($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $pinjam->delete();
        return redirect()->route('officers.index')->with('success', ' deleted successfully');
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'kategori' => 'required',
            'stok' => 'required|integer',
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')->with('success', 'Book added successfully');
    }
    public function returnbuku($id)
    {
        $pinjam = Pinjam::findOrFail($id);

        if ($pinjam->status === 'kembalikan') {
            return redirect()->back()->with('error', 'Buku sudah dikembalikan sebelumnya!');
        }

        $pinjam->update([
            'kembalikan_date' => now(),
            'status' => 'kembalikan',
        ]);
        $buku = buku::findOrFail($pinjam->buku_id);
        $buku->increment('stok');

        return redirect()->route('pinjam.index')->with('success', 'Buku berhasil dikembalikan!');
    }
}
