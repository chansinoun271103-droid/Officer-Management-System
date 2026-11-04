<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Department</title>
</head>

<body>
    @extends('layouts.admin')
    @section('title', 'Edit Department')

    @section('content')
        <h1>Edit Department</h1>

        <div class="card">
            <form method="POST" action="{{ route('departments.update', $department) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $department->name) }}">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary" type="submit">Update</button>
                <a class="btn" href="{{ route('departments.index') }}">Cancel</a>
            </form>
        </div>
    @endsection
</body>

</html>