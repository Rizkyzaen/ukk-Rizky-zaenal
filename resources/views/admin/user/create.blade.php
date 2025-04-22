<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pengguna</title>
</head>
<body>
    <h1>List User</h1>
    @foreach ($users as $user)
        <p>{{ $user->name }} - {{ $user->email }}</p>
    @endforeach
</body>
</html>
