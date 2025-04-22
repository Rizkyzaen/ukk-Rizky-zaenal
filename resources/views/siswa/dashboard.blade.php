@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2 class="text-center mb-4">Dashboard Siswa</h2>
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
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
            @foreach($bukus as $buku)
            <tr>
                <td>
                    @if ($buku->cover)
                        <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover" width="80" class="rounded">
                    @else
                        <span class="text-muted">Tidak ada</span>
                    @endif
                </td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ $buku->kategori }}</td>
                <td>{{ $buku->stok }}</td>
                <td>
                    <a href="{{ route('reviews.create', $buku->id) }}" class="btn btn-sm btn-success btn-action">Ulas Buku</a>
                    <a href="{{ route('reviews.show', $buku->id) }}" class="btn btn-sm btn-info btn-action">Lihat Ulasan</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('styles')
    <style>
        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        .btn-action {
            transition: transform 0.3s ease, background-color 0.3s ease;
            margin-right: 5px;
        }

        .btn-action:hover {
            transform: scale(1.05);
            background-color: #0062cc;
        }

        .rounded {
            border-radius: 10px;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .table {
                font-size: 12px;
            }
        }
    </style>
@endpush
