@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ulasan untuk: {{ $buku->judul }}</h2>
    <a href="{{ route('reviews.create', $buku->id) }}" class="btn btn-sm btn-success">Ulas Buku</a>
    @if($buku->reviews->isEmpty())
        <p>Belum ada ulasan untuk buku ini.</p>
    @else
        @foreach($buku->reviews as $review)
            <div class="card mb-2">
                <div class="card-body">
                    <strong>{{ $review->user->name }}</strong> - Rating: {{ $review->rating }}/5
                    <p>{{ $review->review }}</p>

                    <small>{{ $review->created_at->diffForHumans() }}</small>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
