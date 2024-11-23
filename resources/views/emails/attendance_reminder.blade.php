<!DOCTYPE html>
<html>
<head>
    <title>Peringatan Kehadiran</title>
</head>
<body>
    @php
        // dd($user->name);
    @endphp
    <p>Halo, {{ $user->name }}</p>
    <p>Kami perhatikan bahwa kehadiran Anda kurang dari standar.</p>
    <p><a href="{{ url('/pegawai/attendance') }}">Lihat Kehadiran</a></p>
    <p>Mohon tingkatkan kehadiran Anda !!!</p>
</body>
</html>
