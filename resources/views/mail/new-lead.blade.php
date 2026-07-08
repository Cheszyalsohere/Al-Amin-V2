@php
    $waLink = 'https://wa.me/'.ltrim($lead->no_hp, '0');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Lead baru: {{ $lead->nama }}</title>
</head>
<body style="font-family: sans-serif; color: #111;">
    <h2>Lead baru masuk</h2>
    <table cellpadding="4" cellspacing="0">
        <tr><td><strong>Nama</strong></td><td>{{ $lead->nama }}</td></tr>
        <tr><td><strong>Kelas</strong></td><td>{{ $lead->kelas }}</td></tr>
        <tr><td><strong>No. WA</strong></td><td>{{ $lead->no_hp }}</td></tr>
        <tr><td><strong>No. WA Ortu</strong></td><td>{{ $lead->no_hp_ortu }}</td></tr>
        <tr><td><strong>Sumber</strong></td><td>{{ $lead->sumber }}</td></tr>
    </table>
    <p><a href="{{ $waLink }}">Hubungi via WhatsApp</a></p>
</body>
</html>
