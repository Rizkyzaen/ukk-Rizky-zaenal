@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar Peminjaman</h2>
        {{-- <a href="{{ url('/pinjam') }}" class="btn btn-primary">
            <i class="fas fa-list-check me-1"></i> Kelola Peminjaman
        </a> --}}
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('petugas.dashboard') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Cari nama peminjam atau judul buku..." name="search" value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="status">
                        <option value="">Semua Status</option>
                        <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Terlambat</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="date" value="{{ request('date') }}" placeholder="Filter tanggal">
                </div>
                <div class="col-md-2">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Peminjam</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($pinjams->count() > 0)
                            @foreach($pinjams as $pinjam)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user-circle text-muted me-2"></i>
                                        <span>{{ $pinjam->user->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-book text-muted me-2"></i>
                                        <span>{{ $pinjam->buku->judul }}</span>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($pinjam->dipinjam_date)->format('d M Y') }}</td>
                                <td>
                                    @if($pinjam->kembalikan_date)
                                        {{ \Carbon\Carbon::parse($pinjam->kembalikan_date)->format('d M Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($pinjam->status === 'dipinjam')
                                        <span class="badge bg-primary">Dipinjam</span>
                                    @elseif($pinjam->status === 'kembalikan')
                                        <span class="badge bg-success">Dikembalikan</span>
                                    @elseif($pinjam->status === 'overdue')
                                        <span class="badge bg-danger">Terlambat</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $pinjam->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $pinjam->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        @if($pinjam->status === 'dipinjam')
                                            <form action="{{ route('pinjam.return', $pinjam->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')">
                                                    <i class="fas fa-check me-1"></i> Kembalikan
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="modal fade" id="detailModal{{ $pinjam->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $pinjam->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailModalLabel{{ $pinjam->id }}">Detail Peminjaman</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Informasi Peminjam</h6>
                                                        <p class="mb-1"><strong>Nama:</strong> {{ $pinjam->user->name }}</p>
                                                        <p class="mb-1"><strong>Email:</strong> {{ $pinjam->user->email }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Informasi Buku</h6>
                                                        <p class="mb-1"><strong>Judul:</strong> {{ $pinjam->buku->judul }}</p>
                                                        <p class="mb-1"><strong>Penulis:</strong> {{ $pinjam->buku->penulis }}</p>
                                                        <p class="mb-1"><strong>Kategori:</strong> {{ $pinjam->buku->kategori }}</p>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold">Informasi Peminjaman</h6>
                                                        <p class="mb-1"><strong>Tanggal Pinjam:</strong> {{ \Carbon\Carbon::parse($pinjam->dipinjam_date)->format('d M Y') }}</p>
                                                        <p class="mb-1"><strong>Tanggal Jatuh Tempo:</strong>
                                                            @if(isset($pinjam->due_date))
                                                                {{ \Carbon\Carbon::parse($pinjam->due_date)->format('d M Y') }}
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </p>
                                                        <p class="mb-1"><strong>Tanggal Kembali:</strong>
                                                            @if($pinjam->kembalikan_date)
                                                                {{ \Carbon\Carbon::parse($pinjam->kembalikan_date)->format('d M Y') }}
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </p>
                                                        <p class="mb-1"><strong>Status:</strong>
                                                            @if($pinjam->status === 'dipinjam')
                                                                <span class="badge bg-primary">Dipinjam</span>
                                                            @elseif($pinjam->status === 'kembalikan')
                                                                <span class="badge bg-success">Dikembalikan</span>
                                                            @elseif($pinjam->status === 'overdue')
                                                                <span class="badge bg-danger">Terlambat</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ $pinjam->status }}</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    @if($pinjam->status === 'dipinjam')
                                                        <form action="{{ route('pinjam.return', $pinjam->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-success">Kembalikan Buku</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Tidak ada data peminjaman yang ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
