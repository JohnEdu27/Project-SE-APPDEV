<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - iReklamo</title>
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

        .forgot-container {
            background: white;
            border-radius: 30px;
            padding: 50px;
            max-width: 450px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,136,255,0.2);
            text-align: center;
        }

        .logo {
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

        .forgot-container h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .forgot-container p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 25px;
            text-align: left;
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

        .btn-submit {
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

        .btn-submit:hover {
            background: #0066cc;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,136,255,0.3);
        }

        .back-link {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e0e0e0;
        }

        .back-link a {
            color: #0088FF;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            text-align: left;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: left;
        }

        .validation-error {
            color: #dc3545;
            font-size: 12px;
            margin-top: 6px;
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <div class="logo">
            <h1>IREKLAMO</h1>
        </div>

        <div class="icon-circle">🔑</div>
        <h2>Forgot Password?</h2>
        <p>No worries! Enter your email address below and we'll send you a link to reset your password.</p>

        @if (session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your registered email">
                @error('email')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Send Reset Link</button>
        </form>

        <div class="back-link">
            <a href="{{ route('login') }}">← Back to Login</a>
        </div>
    </div>
</body>
</html>