@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Katalog Buku</h2>

    {{-- Form Pencarian --}}
    <form action="{{ route('pinjam.create') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-6 mb-2">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari judul buku...">
            </div>
            <div class="col-md-4 mb-2">
                <select name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <button class="btn btn-outline-primary w-100" type="submit">Cari</button>
            </div>
        </div>
    </form>

    {{-- Pesan error --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Daftar Buku --}}
    <div class="row">
        @forelse($bukus as $buku)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    {{-- Cover --}}
                    @if ($buku->cover)
                        <img src="{{ asset('storage/' . $buku->cover) }}" class="card-img-top" alt="Cover Buku {{ $buku->judul }}" style="height: 250px; object-fit: cover;" alt="Cover Buku {{ $buku->judul }}">
                    @endif

                    @if (!$buku->cover)
                        <img src="{{ asset('images/default-cover.jpg') }}" class="card-img-top" alt="Default Cover" style="height: 250px; object-fit: cover;">
                    @endif

                    {{-- Info Buku --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $buku->judul }}</h5>
                        <p class="card-text">
                            <strong>Penulis:</strong> {{ $buku->penulis }}<br>
                            <strong>Kategori:</strong> {{ $buku->kategori }}<br>
                            <strong>Stok:</strong> {{ $buku->stok }}
                        </p>
                        <form action="{{ route('pinjam.store') }}" method="POST" onsubmit="return confirmLoan()">
                            @csrf
                            <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                            <button class="btn btn-primary w-100" {{ $buku->stok == 0 ? 'disabled' : '' }}>
                                {{ $buku->stok == 0 ? 'Stok Habis' : 'Pinjam Buku' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Tidak ada buku ditemukan.</p>
        @endforelse
    </div>
</div>

<script>
    function confirmLoan() {
        return confirm('Yakin mau pinjam buku ini?');
    }
</script>
@endsection
