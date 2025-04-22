@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Detail Buku</h2>
    <div class="card">
        <div class="card-body">
            <h4>{{ $buku->judul }}</h4>
            <p><strong>Penulis:</strong> {{ $buku->penulis }}</p>
            <p><strong>Kategori:</strong> {{ $buku->kategori }}</p>
            <p><strong>Stok:</strong> {{ $buku->stok }}</p>

            @if ($buku->cover)
            <div class="mt-3">
                <p><strong>Cover Buku:</strong></p>
                <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover Buku" width="150">
            </div>
            @else
            <p><strong>Cover Buku:</strong> Tidak ada cover yang diupload.</p>
            @endif

            <a href="{{ route('petugas.buku.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
