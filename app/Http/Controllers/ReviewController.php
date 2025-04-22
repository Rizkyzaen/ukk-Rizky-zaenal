<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create($bukuId)
    {
        $buku = Buku::findOrFail($bukuId);
        return view('reviews.create', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'buku_id' => $request->buku_id,
            'user_id' => auth()->id(),
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return redirect()->route('reviews.show', $request->buku_id)
               ->with('success', 'Ulasan berhasil dikirim!')
               ->withFragment('ulasan');

    }

    public function show($bukuid)
    {
        $buku = Buku::with('reviews.user')->findOrFail($bukuid);
        return view('reviews.show', compact('buku'));
    }
}
