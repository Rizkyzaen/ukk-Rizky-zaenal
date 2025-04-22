@extends('layouts.app')

@section('content')
<style>
    /* Fix Laravel pagination agar SVG panah besar tidak tampil */
    .pagination svg {
        display: none !important;
    }

    .pagination .hidden {
        display: inline !important;
    }

    .pagination {
        justify-content: center;
        margin-top: 1rem;
    }

    .page-link {
        font-size: 0.9rem;
        padding: 6px 12px;
    }
</style>

<div class="container mt-4">
    <h2 class="mb-4">Daftar Peminjaman Buku</h2>

    {{-- Form Pencarian --}}
    <form action="{{ route('pinjam.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama visitor atau judul buku">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="kembalikan" {{ request('status') == 'kembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" name="date" value="{{ request('date') }}" class="form-control">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Cari</button>
        </div>
    </form>

    {{-- Tabel Data --}}
    <table class="table table-striped table-bordered">
        <thead class="table">
            <tr>
                <th>ID</th>
                <th>Nama Visitor</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pinjams as $pinjam)
            <tr>
                <td>{{ $pinjam->id }}</td>
                <td>{{ $pinjam->user->name }}</td>
                <td>{{ $pinjam->buku->judul }}</td>
                <td>{{ $pinjam->dipinjam_date }}</td>
                <td>{{ $pinjam->kembalikan_date ?? 'Belum dikembalikan' }}</td>
                <td>
                    @if ($pinjam->status == 'dipinjam')
                        <span class="badge bg-warning text-dark">Dipinjam</span>
                    @elseif ($pinjam->status == 'kembalikan')
                        <span class="badge bg-success">Dikembalikan</span>
                    @else
                        <span class="badge bg-secondary">{{ $pinjam->status }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Data tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $pinjams->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection
