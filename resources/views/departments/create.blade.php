<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Department</title>
</head>

<body>
   @extends('layouts.admin')
@section('title', 'Add Department')

@section('content')
<div class="table-card form-card">
    <h1>Add Department</h1>

    <form method="POST" action="{{ route('departments.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Department Name</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name') }}" placeholder="e.g. IT, HR, Finance" required autofocus>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save</button>
            <a class="btn btn-ghost" href="{{ route('departments.index') }}">Cancel</a>
        </div>
    </form>
</div>
@endsection
</body>

</html>