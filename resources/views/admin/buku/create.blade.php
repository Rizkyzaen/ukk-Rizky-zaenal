@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Buku</h2>
    @if (auth()->user()->role === 'petugas')
    <a href="{{ route('petugas.dashboard') }}" class="btn btn-success mb-3">back</a>
    @endif
    <form action="{{ route('buku.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input type="text" class="form-control" name="judul" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Penulis</label>
            <input type="text" class="form-control" name="penulis" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" class="form-control" name="kategori" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" class="form-control" name="stok" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
