<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-xl">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Edit Profil</h2>
        @if(session('status') === 'profile-updated')
            <div class="mb-4 text-green-600 text-sm">Profil berhasil diperbarui.</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="/" class="text-sm text-gray-500 hover:underline">Kembali</a>
            </div>
        </form>
        <hr class="my-8">

<h2 class="text-xl font-bold mb-4 text-gray-800">Ubah Password</h2>

@if (session('status') === 'password-updated')
    <div class="mb-4 text-green-600 text-sm">Password berhasil diperbarui.</div>
@endif

<form method="POST" action="{{ route('password.update') }}" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
        <input type="password" name="current_password" id="current_password" required
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
        <input type="password" name="password" id="password" required
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ubah Password</button>
        @if (auth()->user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:underline">Kembali</a>
        @endif
        @if (auth()->user()->role === 'petugas')
        <a href="{{ route('petugas.dashboard') }}" class="text-sm text-gray-500 hover:underline">Kembali</a>
        @endif
        @if (auth()->user()->role === 'siswa')
        <a href="{{ route('siswa.dashboard') }}" class="text-sm text-gray-500 hover:underline">Kembali</a>
        @endif
    </div>
</form>

    </div>
</body>
</html>
