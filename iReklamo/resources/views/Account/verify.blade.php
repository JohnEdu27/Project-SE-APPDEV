<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - iReklamo</title>
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

        .verify-container {
            background: white;
            border-radius: 30px;
            padding: 50px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,136,255,0.2);
            text-align: center;
        }

        .icon {
            width: 100px;
            height: 100px;
            background: #0088FF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 48px;
        }

        .verify-container h1 {
            color: #0088FF;
            font-size: 32px;
            font-weight: 900;
            margin-bottom: 20px;
        }

        .verify-container p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
            font-size: 16px;
        }

        .email-display {
            background: #f0f8ff;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 30px;
            color: #0088FF;
            font-weight: 600;
        }

        .btn-verify {
            background: #0088FF;
            color: white;
            padding: 16px 40px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }

        .btn-verify:hover {
            background: #0066cc;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,136,255,0.3);
        }

        .resend-link {
            display: block;
            color: #0088FF;
            text-decoration: none;
            font-size: 14px;
            margin-top: 20px;
        }

        .resend-link:hover {
            text-decoration: underline;
        }

        .success-message {
            background: #efe;
            color: #3c3;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="verify-container">
        <div class="icon">✉️</div>
        <h1>Verify Your Email</h1>
        
        @if(session('status') == 'verification-link-sent')
            <div class="success-message">
                A new verification link has been sent to your email address.
            </div>
        @endif

        <p>We've sent a verification link to your email address. Please check your inbox and click the link to verify your account.</p>
        
        <div class="email-display">
            {{ auth()->user()->email }}
        </div>

        <p>If you didn't receive the email, click the button below to request another one.</p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-verify">Resend Verification Email</button>
        </form>

        <a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="resend-link">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</body>
</html>