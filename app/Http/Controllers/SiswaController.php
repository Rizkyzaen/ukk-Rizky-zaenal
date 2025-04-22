<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Pinjam;

class SiswaController extends Controller
{
            public function dashboard(Request $request)
            {
            $query = Buku::query();

            // Search functionality
            if ($request->has('cari') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%");
                });
            }

            // Category filter
            if ($request->has('category') && !empty($request->category)) {
                $query->where('category', $request->category);
            }

            $bukus = $query->paginate(12);

            return view('siswa.dashboard', compact('bukus'));
            }

}
