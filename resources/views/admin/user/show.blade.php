@extends('layouts.app')

@section('content')
@if (auth()->user()->role === 'admin')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-success">Back</a>
@endif

<div class="container">
    <h1>Daftar Pengguna</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
