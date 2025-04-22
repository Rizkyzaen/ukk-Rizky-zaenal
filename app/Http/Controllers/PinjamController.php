<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class PinjamController extends Controller
{
    public function index(Request $request)
    {
        $pinjams = Pinjam::with(['user', 'buku'])
        ->when($request->search, function ($query) use ($request) {
            $query->whereHas('user', fn($q) => $q->where('name', 'like', '%' . $request->search . '%'))
                  ->orWhereHas('buku', fn($q) => $q->where('judul', 'like', '%' . $request->search . '%'));
        })
        ->when($request->status, function ($query) use ($request) {
            $query->where('status', $request->status);
        })
        ->when($request->date, function ($query) use ($request) {
            $query->whereDate('dipinjam_date', $request->date);
        })
        ->orderByDesc('id')
        ->paginate(10)
        ->appends($request->except('page'));


        return view('pinjam.index', compact('pinjams'));
    }


    public function create(Request $request)
    {
        $query = Buku::query();

        if ($request->has('search') && $request->search !== '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->has('kategori') && $request->kategori !== '') {
            $query->where('kategori', $request->kategori);
        }

        $bukus = $query->get();
        $kategoris = Buku::select('kategori')->distinct()->pluck('kategori');

        return view('pinjam.create', compact('bukus', 'kategoris'));
    }
    //store
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        // Cek apakah buku sudah dipinjam oleh pengguna lain
        $existingPinjam = Pinjam::where('buku_id', $buku->id)
                                 ->where('user_id', Auth::id())
                                 ->where('status', 'dipinjam')
                                 ->first();

        if ($existingPinjam) {
            return redirect()->back()->with('error', 'Anda sudah meminjam buku ini!');
        }

        if ($buku->stok < 1) {
            return redirect()->back()->with('error', 'Stok buku habis!');
        }

        Pinjam::create([
            'buku_id' => $request->buku_id,
            'user_id' => Auth::id(),
            'dipinjam_date' => now(),
            'status' => 'dipinjam',
        ]);

        $buku->decrement('stok');

        return redirect()->route('pinjam.index')->with('success', 'Buku berhasil dipinjam!');
    }

    //destroy
    public function destroy($id)
    {
        $pinjam = Pinjam::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($pinjam->status === 'dipinjam') {
            return redirect()->back()->with('error', 'Buku masih dipinjam, tidak bisa dihapus.');
        }

        $pinjam->delete();
        return redirect()->route('pinjam.index')->with('success', 'Peminjaman berhasil dihapus.');
    }
    public function returnbook($id)
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

    public function boot(): void
    {
        Paginator::useBootstrap();
    }

    public function getCoverUrlAttribute()
    {
        return asset('storage/cover_buku/' . $this->cover);

    }
}
