<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Officer Management System</title>
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 540px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin: 20px;
        }

        
        .brand-panel {
            flex: 1.1;
            background: #2563eb;
            color: #fff;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 18px;
        }

        .brand-logo i {
            font-size: 22px;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 10px;
        }

        .brand-content h1 {
            font-size: 34px;
            margin: 0 0 12px 0;
            font-weight: 700;
        }

        .brand-content p {
            font-size: 14px;
            line-height: 1.5;
            opacity: 0.9;
            margin: 0;
            max-width: 300px;
        }

        /* ផ្នែកខាងស្តាំ (Form Login Panel) */
        .form-panel {
            flex: 1;
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-panel h2 {
            font-size: 28px;
            color: #1e293b;
            margin: 0 0 6px 0;
        }

        .subtitle {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 28px;
        }

        .subtitle a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .subtitle a:hover {
            text-decoration: underline;
        }

        .input-group {
            position: relative;
            margin-bottom: 18px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 30px 12px 0;
            border: none;
            border-bottom: 1px solid #cbd5e1;
            font-size: 14px;
            outline: none;
            background: transparent;
            transition: border-color 0.2s;
        }

        .input-group input:focus {
            border-bottom-color: #2563eb;
        }

        .input-group i {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 15px;
        }

        .toggle-password {
            cursor: pointer;
            pointer-events: auto;
        }

        .toggle-password:hover {
            color: #2563eb;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 16px 0 24px 0;
            font-size: 13px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #64748b;
            cursor: pointer;
        }

        .forgot-pass {
            color: #2563eb;
            text-decoration: none;
        }

        .forgot-pass:hover {
            text-decoration: underline;
        }

       
        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: #fff;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            margin-bottom: 10px;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

       
        .btn-register-outline {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #fff;
            color: #334155;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: block;
            transition: background 0.2s, border-color 0.2s;
        }

        .btn-register-outline:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }

        .error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 420px;
            }
            .brand-panel {
                padding: 30px;
                min-height: 180px;
            }
            .form-panel {
                padding: 30px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
       
        <div class="brand-panel">
            <div class="brand-logo">
                <i class="fa-solid fa-users-gear"></i> Officer Management
            </div>
            <div class="brand-content">
                <h1>Welcome!</h1>
                <p>Manage your officer records, duties, and hierarchy securely in one centralized platform.</p>
            </div>
            <div style="display: flex; gap: 8px;">
                <div style="width: 24px; height: 8px; background: #fff; border-radius: 4px;"></div>
                <div style="width: 8px; height: 8px; background: rgba(255,255,255,0.4); border-radius: 50%;"></div>
            </div>
        </div>

        
        <div class="form-panel">
            <h2>Log In</h2>
            <div class="subtitle">
                Don't have an account? <a href="{{ route('register') }}">Create an account</a>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Username -->
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>
                    <i class="fa-regular fa-user"></i>
                </div>
                @error('username')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Password -->
                <div class="input-group" style="margin-top: 10px;">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class="fa-solid fa-eye-slash toggle-password" id="togglePassword"></i>
                </div>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Remember me & Forgot Password -->
                <div class="form-actions">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" id="remember"> Remember password
                    </label>
                    <a href="#" class="forgot-pass">Forget your password?</a>
                </div>

                <!-- button Login -->
                <button type="submit" class="btn-login">Log In</button>

                <!-- button  Register -->
                <a href="{{ route('register') }}" class="btn-register-outline">Register</a>
            </form>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePassword');

        toggleIcon.addEventListener('click', function () {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';
            this.classList.toggle('fa-eye', isHidden);
            this.classList.toggle('fa-eye-slash', !isHidden);
        });
    </script>

</body>

</html>