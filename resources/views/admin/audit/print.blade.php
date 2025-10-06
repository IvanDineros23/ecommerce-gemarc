<html>
<head>
    <meta charset="utf-8">
    <title>Audit Logs</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Audit Logs</h2>
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
                <td>{{ $log->actor ? $log->actor->name : 'N/A' }}</td>
                <td>{{ $log->actor ? $log->actor->role : 'N/A' }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->details ?? 'No details' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
