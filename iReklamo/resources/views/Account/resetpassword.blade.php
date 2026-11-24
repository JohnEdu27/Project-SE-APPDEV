<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - iReklamo</title>
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

        .reset-container {
            background: white;
            border-radius: 30px;
            padding: 50px;
            max-width: 450px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,136,255,0.2);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            color: #0088FF;
            font-size: 28px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background: #0088FF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 36px;
        }

        .reset-container h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
            text-align: center;
        }

        .reset-container > p {
            color: #666;
            text-align: center;
            margin-bottom: 30px;
            font-size: 15px;
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

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #0088FF;
        }

        .form-group input[readonly] {
            background: #f8f9fa;
            color: #666;
            cursor: not-allowed;
        }

        .btn-reset {
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

        .btn-reset:hover {
            background: #0066cc;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,136,255,0.3);
        }

        .validation-error {
            color: #dc3545;
            font-size: 12px;
            margin-top: 6px;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="logo">
            <h1>IREKLAMO</h1>
        </div>

        <div class="icon-circle">🔒</div>
        <h2>Reset Password</h2>
        <p>Create a new strong password for your account.</p>

        @if ($errors->any())
            <div class="error-message">
                <ul style="list-style: none; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email', $email) }}" required readonly>
                @error('email')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter new password">
                @error('password')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm new password">
            </div>

            <button type="submit" class="btn-reset">Reset Password</button>
        </form>
    </div>
</body>
</html>