<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Leads &mdash; Al-Amin Bimbingan Belajar</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #111;
        }

        h1 {
            font-size: 16px;
            margin: 0 0 4px;
        }

        p.meta {
            margin: 0 0 16px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        .empty {
            text-align: center;
            padding: 16px;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Leads &mdash; Al-Amin Bimbingan Belajar</h1>
    <p class="meta">Dibuat pada {{ $generatedAt->format('d/m/Y H:i') }}</p>

    @if ($leads->isEmpty())
        <p class="empty">Belum ada lead.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Program</th>
                    <th>Sumber</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $lead)
                    <tr>
                        <td>{{ $lead->nama }}</td>
                        <td>{{ $lead->kelas }}</td>
                        <td>{{ $lead->program_minat ? (\App\Enums\ProgramType::tryFrom($lead->program_minat)?->label() ?? $lead->program_minat) : '-' }}</td>
                        <td>{{ \App\Enums\LeadSource::tryFrom($lead->sumber)?->label() ?? $lead->sumber }}</td>
                        <td>{{ $lead->status->label() }}</td>
                        <td>{{ $lead->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
