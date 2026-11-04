<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HR Dashboard</title>
    <style>
        :root {
            --navy: #0f2747;
            --navy-2: #1e3a5f;
            --accent: #2563eb;
            --bg: #f3f5f9;
            --text: #1f2937;
            --muted: #6b7280;
            --line: #e5e7eb;
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Segoe UI', Arial, sans-serif; background: var(--bg); color: var(--text); }

        /* Sidebar */
        .sidebar {
            position: fixed; inset: 0 auto 0 0; width: 240px; padding: 24px 16px;
            background: linear-gradient(180deg, var(--navy), var(--navy-2));
            color: #fff; display: flex; flex-direction: column;
        }
        .brand { font-size: 20px; font-weight: 700; padding: 0 10px; margin-bottom: 32px; }
        .brand small { display: block; font-size: 12px; font-weight: 400; color: #93a8c8; margin-top: 4px; }
        .sidebar a {
            display: block; padding: 11px 14px; margin-bottom: 6px; border-radius: 10px;
            color: #c3d0e6; text-decoration: none; font-size: 14px; transition: .15s;
        }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,.14); color: #fff; }
        .logout { margin-top: auto; }
        .logout button {
            width: 100%; padding: 11px; border: 0; border-radius: 10px; cursor: pointer;
            background: #ef4444; color: #fff; font-size: 14px; font-weight: 600;
        }
        .logout button:hover { background: #dc2626; }

        /* Main */
        .main { margin-left: 240px; padding: 28px 36px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .topbar h1 { margin: 0; font-size: 26px; }
        .topbar p { margin: 4px 0 0; color: var(--muted); font-size: 14px; }
        .user-box {
            display: flex; align-items: center; gap: 10px; padding: 8px 16px 8px 8px;
            background: #fff; border-radius: 999px; box-shadow: 0 1px 3px rgba(0,0,0,.08); font-size: 14px;
        }
        .avatar {
            width: 34px; height: 34px; border-radius: 50%; display: grid; place-items: center;
            background: var(--accent); color: #fff; font-weight: 700;
        }
        .role-tag {
            font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 999px;
            background: #dbeafe; color: #1d4ed8; text-transform: uppercase;
        }

        /* Stat cards */
        .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; }
        .card {
            background: #fff; border-radius: 16px; padding: 22px; position: relative; overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,.06); border-left: 5px solid var(--accent);
        }
        .card.green  { border-left-color: #10b981; }
        .card.orange { border-left-color: #f59e0b; }
        .card h3 { margin: 0; font-size: 13px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .05em; }
        .card p  { margin: 10px 0 0; font-size: 38px; font-weight: 700; color: var(--navy); }

        /* Panels */
        .grid-2 { display: grid; grid-template-columns: 1fr 1.4fr; gap: 20px; margin-top: 24px; }
        .panel { background: #fff; border-radius: 16px; padding: 22px; box-shadow: 0 1px 4px rgba(0,0,0,.06); }
        .panel-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
        .panel h2 { margin: 0; font-size: 17px; }
        table { width: 100%; border-collapse: collapse; }
        th {
            text-align: left; padding: 10px 12px; font-size: 12px; text-transform: uppercase;
            letter-spacing: .05em; color: var(--muted); background: #f8fafc; border-bottom: 1px solid var(--line);
        }
        td { padding: 12px; font-size: 14px; border-bottom: 1px solid #f1f5f9; }
        tbody tr:hover { background: #f8fafc; }
        .badge {
            display: inline-block; min-width: 32px; text-align: center; padding: 3px 12px;
            border-radius: 999px; background: #dbeafe; color: #1d4ed8; font-weight: 700; font-size: 13px;
        }
        .muted { text-align: center; color: #9ca3af; }

        .btn {
            display: inline-block; padding: 9px 16px; border-radius: 10px; text-decoration: none;
            background: var(--navy-2); color: #fff; font-size: 14px; font-weight: 600;
        }
        .btn:hover { background: var(--navy); }

        @media (max-width: 900px) {
            .grid-2 { grid-template-columns: 1fr; }
            .sidebar { position: static; width: 100%; flex-direction: row; align-items: center; gap: 8px; }
            .brand { margin: 0 12px 0 0; }
            .brand small { display: none; }
            .logout { margin: 0 0 0 auto; }
            .main { margin-left: 0; padding: 20px 16px; }
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="brand">HR Panel <small>Officer Management</small></div>
    <a href="{{ route('hr.dashboard') }}" class="{{ request()->routeIs('hr.dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('officers.index') }}" class="{{ request()->routeIs('officers.*') ? 'active' : '' }}">Officers</a>

    <div class="logout">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</aside>

<main class="main">
    <div class="topbar">
        <div>
            <h1>HR Dashboard</h1>
            <p>{{ now()->format('l, d M Y') }}</p>
        </div>
        <div class="user-box">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <span>{{ auth()->user()->name }}</span>
            <span class="role-tag">{{ auth()->user()->role }}</span>
        </div>
    </div>

    <div class="cards">
        <div class="card">
            <h3>Total Officers</h3>
            <p>{{ $totalOfficers }}</p>
        </div>
        <div class="card green">
            <h3>Departments</h3>
            <p>{{ $totalDepartments }}</p>
        </div>
        
    </div>

    <div class="grid-2">
        <div class="panel">
            <div class="panel-head"><h2>Officers by Department</h2></div>
            <table>
                <thead><tr><th>Department</th><th>Officers</th></tr></thead>
                <tbody>
                @forelse($departments as $d)
                    <tr>
                        <td>{{ $d->name }}</td>
                        <td><span class="badge">{{ $d->officers_count }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="2" class="muted">No departments yet</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="panel">
            <div class="panel-head">
                <h2>Recent Officers</h2>
                <a href="{{ route('officers.create') }}" class="btn">+ Add Officer</a>
            </div>
            <table>
                <thead><tr><th>Name</th><th>Position</th><th>Department</th></tr></thead>
                <tbody>
                @forelse($recentOfficers as $o)
                    <tr>
                        <td>{{ $o->name }}</td>
                        <td>{{ $o->position ?? '-' }}</td>
                        <td>{{ $o->department->name ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="muted">No officers yet</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

</body>
</html>