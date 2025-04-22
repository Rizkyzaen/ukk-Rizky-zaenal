<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Pinjam;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $date = $request->input('date');

        $query = Pinjam::with(['user', 'buku']);

        // Apply search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($qUser) use ($search) {
                    $qUser->where('name', 'like', "%{$search}%");
                })->orWhereHas('buku', function ($qBuku) use ($search) {
                    $qBuku->where('judul', 'like', "%{$search}%");
                });
            });
        }

        // Apply status filter
        if (!empty($status)) {
            $query->where('status', $status);
        }

        // Apply date filter
        if (!empty($date)) {
            $query->whereDate('dipinjam_date', $date);
        }

        // Get results with pagination
        $pinjams = $query->orderByDesc('dipinjam_date')->paginate(10);

        return view('petugas.dashboard', compact('pinjams'));
    }

    public function destroy($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $pinjam->delete();
        return redirect()->route('petugas.dashboard')->with('sukses', ' berhasil di hapus');
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

        return redirect()->route('buku.index')->with('sukses', 'buku berhasil si tambahkan');
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

        return redirect()->route('pinjam.index')->with('sukses', 'Buku berhasil dikembalikan!');
    }
}

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Buku;
// class PetugasController extends Controller
// {
//     public function index() {
//         $bukus = Buku::all();
//         return view('petugas.buku.index', compact('bukus'));
//     }
//     public function show(Buku $buku) {
//         return view('petugas.buku.show', compact('buku'));
//     }

//     public function edit(Buku $buku) {
//         return view('petugas.buku.edit', compact('buku'));
//     }
//     public function create() {
//         return view('petugas.buku.create');
//     }
// }
