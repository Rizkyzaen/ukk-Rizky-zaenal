@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Role Pengguna</h2>
    <div class="card shadow-sm p-4">
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama:</label>
                <input type="text" class="form-control" value="{{ $user->name }}" disabled>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" value="{{ $user->email }}" disabled>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Pilih Role:</label>
                <select name="role" id="role" class="form-select">
                    <option value="visitor" {{ $user->role == 'visitor' ? 'selected' : '' }}>Visitor</option>
                    <option value="officer" {{ $user->role == 'officer' ? 'selected' : '' }}>Officer</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
