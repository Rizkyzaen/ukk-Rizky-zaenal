@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Buku</h2>
    <form action="{{ route('petugas.buku.update', $buku) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" name="judul" value="{{ $buku->judul }}" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Penulis</label>
            <input type="text" class="form-control" name="penulis" value="{{ $buku->penulis }}" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <input type="text" class="form-control" name="kategori" value="{{ $buku->kategori }}" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control" name="stok" value="{{ $buku->stok }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update Buku</button>
        <a href="{{ route('petugas.buku.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
