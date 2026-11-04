<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('admin.css') }}">
</head>
<body>
<div class="layout">

    <aside class="side">
        <div class="brand">Officer Management</div>
        <a class="nav on" href="{{ url('/admin/dashboard') }}">Dashboard</a>
        <a class="nav" href="{{ url('/officers') }}">Officers</a>
        <a class="nav" href="{{ url('/departments') }}">Departments</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout">Logout</button>
        </form>
        <div class="badge">User: {{ auth()->user()->username }}</div>
    </aside>

    <main class="main">
        <h1>Admin Dashboard</h1>

        <div class="cards">
            <div class="card"><div class="label">Total officers</div><div class="value">{{ $totalOfficers }}</div></div>
            <div class="card"><div class="label">Departments</div><div class="value">{{ $totalDepartments }}</div></div>
            <div class="card"><div class="label">System users</div><div class="value">{{ $totalUsers }}</div></div>
            <div class="card"><div class="label">Added this month</div><div class="value">{{ $thisMonth }}</div></div>
        </div>

        <div class="row">
            <div class="panel box">
                <h2>Officers by department</h2>
                @forelse ($byDepartment as $dept)
                    <div class="bar-row">
                        <span class="bar-name">{{ $dept->name }}</span>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: {{ ($dept->officers_count / $maxCount) * 100 }}%"></div>
                        </div>
                        <b>{{ $dept->officers_count }}</b>
                    </div>
                @empty
                    <p>No departments yet.</p>
                @endforelse
            </div>

            <div class="panel">
                <h2>Recently added</h2>
                <table>
                    <thead>
                        <tr><th>Name</th><th>Position</th><th>Department</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($recent as $officer)
                            <tr>
                                <td>{{ $officer->name }}</td>
                                <td>{{ $officer->position ?? '-' }}</td>
                                <td>{{ $officer->department->name ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3">No officers yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="actions">
            <a class="btn" href="{{ url('/officers/create') }}">+ Add Officer</a>
            <a class="btn ghost" href="{{ url('/departments/create') }}">+ Add Department</a>
        </div>
    </main>

</div>
</body>
</html>