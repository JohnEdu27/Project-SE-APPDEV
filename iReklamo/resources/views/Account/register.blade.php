<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - iReklamo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0088FF 0%, #FDFDFE 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            background: white;
            border-radius: 30px;
            padding: 50px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,136,255,0.2);
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo h1 {
            color: #0088FF;
            font-size: 28px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #0088FF;
        }

        .form-row {
            display: grid;
            gap: 15px;
        }

        .btn-register {
            width: 100%;
            background: #0088FF;
            color: white;
            padding: 16px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: #0066cc;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,136,255,0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #e0e0e0;
        }

        .login-link p {
            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: #0088FF;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .validation-error {
            color: #c33;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo">
            <h1>CREATE ACCOUNT</h1>
        </div>

        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('Register.submit') }}">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" required>
                @error('address')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>

            <button type="submit" class="btn-register">Create Account</button>
        </form>

        <div class="login-link">
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
    </div>
</body>
</html>