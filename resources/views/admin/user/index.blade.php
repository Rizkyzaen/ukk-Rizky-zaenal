@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Pengguna</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach ($users as $user)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text">
                            <strong>Email:</strong> {{ $user->email }}<br>
                            <strong>Role:</strong> <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                        </p>
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning w-100 mb-2">
                            <i class="fas fa-edit"></i> Edit Role
                        </a>
                        <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash-alt"></i> Hapus Pengguna
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
