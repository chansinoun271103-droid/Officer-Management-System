<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Departments</title>
</head>
<body>
    @extends('layouts.admin')
@section('title', 'Departments')

@section('content')
<h1>Departments</h1>

<div class="card">
    <form method="GET" action="{{ route('departments.index') }}" class="filters">
        <input type="text" name="search" placeholder="Search name..." value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Search</button>
        <a class="btn" href="{{ route('departments.index') }}">Reset</a>
        <a class="btn btn-primary" style="margin-left:auto" href="{{ route('departments.create') }}">+ Add Department</a>
    </form>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Officers</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($departments as $d)
            <tr>
                <td>{{ $d->dept_id }}</td>
                <td>{{ $d->name }}</td>
                <td>{{ $d->officers_count }}</td>
                <td class="actions">
                    <a class="btn btn-sm" href="{{ route('departments.edit', $d) }}">Edit</a>
                    <form method="POST" action="{{ route('departments.destroy', $d) }}"
                          onsubmit="return confirm('Delete this department and all its officers?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No departments found.</td></tr>
        @endforelse
        </tbody>
    </table>

    <div class="pagination">{{ $departments->links() }}</div>
</div>
@endsection
</body>
</html>