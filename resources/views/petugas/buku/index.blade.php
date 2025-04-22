@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Daftar Buku</h2>
    @if (auth()->user()->role === 'admin')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-success mb-3">back</a>
    @endif
    {{-- <a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">Tambah Buku</a> --}}
    <table class="table">
        <thead>
            <tr>
                <th>Cover</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukus as $buku)
            <tr>
                <td>
                    @if ($buku->cover)
                        <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover" width="60">
                    @else
                        <span class="text-muted">Tidak ada</span>
                    @endif
                </td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ $buku->kategori }}</td>
                <td>{{ $buku->stok }}</td>
                <td>
                    <a href="{{ route('petugas.buku.show', $buku) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('petugas.buku.edit', $buku) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('petugas.buku.destroy', $buku->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
