@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ulas Buku: {{ $buku->judul }}</h2>

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="buku_id" value="{{ $buku->id }}">

        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <div class="star-rating">
                @for ($i = 5; $i >= 1; $i--)
                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                    <label for="star{{ $i }}" title="{{ $i }} bintang">★</label>
                @endfor
            </div>
        </div>

        <div class="mb-3">
            <label for="review" class="form-label">Ulasan</label>
            <textarea name="review" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
    </form>
</div>
@endsection
