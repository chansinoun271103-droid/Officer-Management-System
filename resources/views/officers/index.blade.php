<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
</head>
<body>
    @extends('layouts.admin')
@section('title', 'Officers')

@section('content')
<div class="table-card">
    <h1>Officers</h1>

    <form method="GET" action="{{ route('officers.index') }}" class="toolbar">
        <input type="text" name="search" placeholder="Search name..." value="{{ request('search') }}">

        <select name="dept_id">
            <option value="">All departments</option>
            @foreach($departments as $d)
                <option value="{{ $d->dept_id }}" {{ request('dept_id') == $d->dept_id ? 'selected' : '' }}>
                    {{ $d->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('officers.index') }}" class="btn btn-ghost">Reset</a>
        <a href="{{ route('officers.create') }}" class="btn btn-primary push">+ Add Officer</a>
    </form>

    <table class="tbl">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Position</th>
                <th>Department</th>
                <th>Phone</th>
                <th>Hire Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($officers as $o)
            <tr>
                <td>{{ $officers->firstItem() + $loop->index }}</td>
                <td>{{ $o->name }}</td>
                <td>{{ ucfirst($o->gender) }}</td>
                <td>{{ $o->position }}</td>
                <td>{{ $o->department->name ?? '-' }}</td>
                <td>{{ $o->phone }}</td>
                <td>{{ $o->hire_date }}</td>
                <td>
                    <div class="actions">
                        <a href="{{ route('officers.edit', $o) }}" class="btn btn-ghost btn-sm">Edit</a>

                        @if(auth()->user()->role === 'admin')
                            <form method="POST" action="{{ route('officers.destroy', $o) }}"
                                  onsubmit="return confirm('Delete this officer?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="8">No officers found.</td></tr>
        @endforelse
        </tbody>
    </table>

    <div class="pager">{{ $officers->links() }}</div>
</div>
@endsection
</body>
</html>