<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Al-Amin Bimbingan Belajar') }} &mdash; Bimbel SMP&ndash;SMA Bangil</title>
    <meta name="description" content="Bimbingan belajar SMP&ndash;SMA di Bangil, Pasuruan. Kelas kecil, tentor kenal tiap siswa, sejak 2012.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-bg text-ink">
    {{ $slot }}
</body>
</html>
