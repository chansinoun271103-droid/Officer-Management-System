<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Officer Management')</title>
    <link rel="stylesheet" href="{{ asset('admin.css') }}">
    <style>
        .form-card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem 2.25rem;
            max-width: 520px;
            box-shadow: 0 4px 20px rgba(0,0,0,.06);
            border: 1px solid #e5e7eb;
        }
        .form-card h1 { margin: 0 0 1.75rem 0; font-size: 1.5rem; font-weight: 600; color: #1e293b; }
        .field { margin-bottom: 1.35rem; }
        .field label { display: block; font-size: 0.875rem; font-weight: 500; color: #475569; margin-bottom: 0.4rem; }
        .field input, .field select, .field textarea {
            width: 100%; padding: 0.65rem 0.9rem; font-size: 0.95rem;
            border: 1px solid #cbd5e1; border-radius: 8px; background: #f8fafc;
            transition: border-color .15s, box-shadow .15s; outline: none;
            box-sizing: border-box; font-family: inherit;
        }
        .field input:focus, .field select:focus, .field textarea:focus {
            border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.15); background: #fff;
        }
        .field .error { display: block; margin-top: 0.35rem; font-size: 0.8rem; color: #dc2626; }
        .form-actions { display: flex; gap: 0.75rem; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; }

        /* Officer form (2 columns) */
        .form-section {
            font-size: 1rem; font-weight: 700; color: #1e3a5f;
            margin: 1.5rem 0 0.9rem; padding-bottom: 0.5rem; border-bottom: 2px solid #e5e7eb;
        }
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0 1.25rem; }
        .form-grid .full { grid-column: 1 / -1; }
        @media (max-width: 700px) { .form-grid { grid-template-columns: 1fr; } }

        .btn {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 0.65rem 1.4rem; font-size: 0.9rem; font-weight: 500;
            border-radius: 8px; border: none; cursor: pointer; text-decoration: none; transition: all .15s;
        }
        .btn-primary { background: #1e3a5f; color: #fff; }
        .btn-primary:hover { background: #152a45; }
        .btn-ghost { background: #fff; color: #475569; border: 1px solid #cbd5e1; }
        .btn-ghost:hover { background: #f1f5f9; }
        .btn-danger { background: #fff; color: #dc2626; border: 1px solid #fca5a5; }
        .btn-danger:hover { background: #fef2f2; }
        .btn-sm { padding: 0.35rem 0.8rem; font-size: 0.8rem; }

        .table-card {
            background: #fff; border-radius: 12px; padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,.06); border: 1px solid #e5e7eb;
        }
        .table-card h1 { margin: 0 0 1.25rem 0; font-size: 1.5rem; font-weight: 600; color: #1e293b; }
        .toolbar { display: flex; gap: 0.6rem; margin-bottom: 1.25rem; flex-wrap: wrap; }
        .toolbar input, .toolbar select {
            padding: 0.6rem 0.9rem; font-size: 0.9rem; border: 1px solid #cbd5e1;
            border-radius: 8px; background: #f8fafc; outline: none; min-width: 200px;
        }
        .toolbar .push { margin-left: auto; }
        .tbl { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
        .tbl th { background: #f1f5f9; color: #475569; text-align: left; padding: 0.75rem 1rem; font-weight: 600; }
        .tbl td { padding: 0.75rem 1rem; border-bottom: 1px solid #e2e8f0; color: #1e293b; }
        .tbl tr:hover td { background: #f8fafc; }
        .actions { display: flex; gap: 0.4rem; }
        .actions form { margin: 0; }
        .alert-ok { background: #dcfce7; color: #166534; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.9rem; }

        /* Pagination */
        .pager { margin-top: 1rem; }
        .pager svg { width: 16px; height: 16px; }

       
        .pager nav > div:first-child { display: none; }

       
        .pager nav > div:last-child > div:first-child { display: none; }

       
        .pager nav > div:last-child > div:last-child span.relative { display: inline-flex; gap: 4px; align-items: center; }
        .pager nav > div:last-child a,
        .pager nav > div:last-child span[aria-current] span,
        .pager nav > div:last-child span[aria-disabled] span {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 34px; height: 34px; padding: 0 0.6rem;
            border: 1px solid #cbd5e1; border-radius: 8px;
            background: #fff; color: #475569; text-decoration: none; font-size: 0.9rem;
        }
        .pager nav > div:last-child span[aria-current] span { background: #1e3a5f; color: #fff; border-color: #1e3a5f; }
    </style>
</head>
<body>
<div class="layout">

    <aside class="side">
        @php $role = auth()->user()->role; @endphp

        <div class="brand">Officer Management</div>

        <a class="nav {{ request()->routeIs('dashboard', 'hr.dashboard') ? 'on' : '' }}"
           href="{{ $role === 'admin' ? route('dashboard') : route('hr.dashboard') }}">Dashboard</a>

        <a class="nav {{ request()->routeIs('officers.*') ? 'on' : '' }}"
           href="{{ route('officers.index') }}">Officers</a>

        @if ($role === 'admin')
            <a class="nav {{ request()->routeIs('departments.*') ? 'on' : '' }}"
               href="{{ route('departments.index') }}">Departments</a>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout">Logout</button>
        </form>

        <div class="badge">User: {{ auth()->user()->username }}</div>
    </aside>

    <main class="main">
        @if (session('success'))
            <div class="alert-ok">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

</div>
</body>
</html>