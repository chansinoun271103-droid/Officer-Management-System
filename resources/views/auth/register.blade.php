<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Officer Management System</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: system-ui, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: #f1f5f9;
        }

        .card {
            width: 100%;
            max-width: 380px;
            background: #fff;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .08);
        }

        h2 {
            margin: 0 0 20px;
            text-align: center;
        }

        label {
            display: block;
            margin: 14px 0 6px;
            font-size: 14px;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 11px;
            border: 0;
            border-radius: 8px;
            background: #2563eb;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }

        .link {
            margin-top: 16px;
            text-align: center;
            font-size: 14px;
        }

        .link a {
            color: #2563eb;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <form class="card" method="POST" action="{{ route('register') }}">
        @csrf
        <h2>Register</h2>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
        @error('name')
        <div class="error">{{ $message }}</div> @enderror

        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="{{ old('username') }}" required>
        @error('username')
        <div class="error">{{ $message }}</div> @enderror

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        @error('password')
        <div class="error">{{ $message }}</div> @enderror

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <button type="submit">Register</button>

        <div class="link">
            មាន account រួចហើយ? <a href="{{ route('login') }}">Login</a>
        </div>
    </form>
</body>

</html>