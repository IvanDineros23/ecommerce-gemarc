<html>
<head>
    <meta charset="utf-8">
    <title>Audit Logs</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #eee; }
        .logo { height: 48px; margin-bottom: 8px; }
        .header { font-size: 20px; font-weight: bold; margin-bottom: 8px; }
    </style>
</head>
<body>
    @php
        $logoPath = public_path('images/highlights/gemarclogo.png');
        $logoData = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;
    @endphp

    <div style="text-align:center; margin-bottom: 8px;">
        @if($logoData)
            <img src="data:image/png;base64,{{ $logoData }}" class="logo" alt="Gemarc Logo" style="display:inline-block; height:48px;">
        @else
            <img src="{{ asset('images/highlights/gemarclogo.png') }}" class="logo" alt="Gemarc Logo" style="display:inline-block; height:48px;">
        @endif
        <div class="header" style="font-size:20px; font-weight:bold; margin-top:8px;">Admin Logs</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Timestamp</th>
                <th>User</th>
                <th>Role</th>
                <th>Action</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->created_at }}</td>
                <td>{{ $log->actor->name ?? 'N/A' }}</td>
                <td>{{ $log->actor->role ?? 'N/A' }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->details ?? 'No details' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
