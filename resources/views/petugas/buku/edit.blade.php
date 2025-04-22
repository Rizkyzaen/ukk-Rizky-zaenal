@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Buku</h2>
    <form action="{{ route('petugas.buku.update', $buku) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <div class="mb-3">
        <label class="form-label">Judul Buku</label>
        <input type="text" class="form-control" name="judul" value="{{ old('judul', $buku->judul) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Penulis</label>
        <input type="text" class="form-control" name="penulis" value="{{ old('penulis', $buku->penulis) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <input type="text" class="form-control" name="kategori" value="{{ old('kategori', $buku->kategori) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Stok</label>
        <input type="number" class="form-control" name="stok" value="{{ old('stok', $buku->stok) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Cover Buku</label>
        <input type="file" class="form-control" name="cover">

        @if ($buku->cover)
        <div class="mt-2">
            <p>Cover sebelumnya:</p>
            <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover Buku" width="100">
        </div>
        @else
        <p>Tidak ada cover buku yang diunggah sebelumnya.</p>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
</div>
@endsection
