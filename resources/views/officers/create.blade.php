<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create</title>
</head>

<body>
    @extends('layouts.admin')
    @section('title', 'Add Officer')

    @section('content')
        <div class="form-card" style="max-width:760px;">
            <h1>Add Officer</h1>

            <form method="POST" action="{{ route('officers.store') }}">
                @csrf

                @include('officers._form')

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save Officer</button>
                    <a href="{{ route('officers.index') }}" class="btn btn-ghost">Cancel</a>
                </div>
            </form>
        </div>
    @endsection
</body>

</html>