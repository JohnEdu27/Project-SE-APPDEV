<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied | Barangay Connect</title>
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

        .error-container {
            background: white;
            border-radius: 30px;
            padding: 60px 50px;
            max-width: 550px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,136,255,0.2);
            text-align: center;
        }

        .logo {
            margin-bottom: 40px;
        }

        .logo h1 {
            color: #0088FF;
            font-size: 24px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .icon-circle {
            width: 100px;
            height: 100px;
            background: #0088FF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 48px;
            box-shadow: 0 10px 30px rgba(0,136,255,0.3);
        }

        .error-code {
            font-size: 120px;
            font-weight: 900;
            color: #0088FF;
            line-height: 1;
            margin-bottom: 10px;
            letter-spacing: -5px;
            text-shadow: 4px 4px 0px rgba(0,136,255,0.1);
        }

        .error-container h2 {
            color: #333;
            font-size: 28px;
            margin-bottom: 15px;
            font-weight: 800;
        }

        .error-container p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 40px;
            font-size: 16px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 16px 35px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-primary {
            background: #0088FF;
            color: white;
            border: 2px solid #0088FF;
        }

        .btn-primary:hover {
            background: #0066cc;
            border-color: #0066cc;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,136,255,0.3);
        }

        .btn-outline {
            background: transparent;
            color: #0088FF;
            border: 2px solid #0088FF;
        }

        .btn-outline:hover {
            background: #0088FF;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,136,255,0.3);
        }

        .footer-text {
            margin-top: 40px;
            padding-top: 25px;
            border-top: 1px solid #e0e0e0;
            color: #999;
            font-size: 13px;
        }

        .footer-text a {
            color: #0088FF;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .error-container {
                padding: 40px 25px;
            }
            .error-code {
                font-size: 90px;
            }
            .button-group {
                flex-direction: column;
            }
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="logo">
            <h1>BARANGAY CONNECT</h1>
        </div>

        <div class="icon-circle">🔒</div>
        
        <div class="error-code">403</div>
        
        <h2>Access Denied</h2>
        
        <p>
            You do not have the required permissions to view this page. 
            If you believe this is a mistake, please contact your barangay administrator.
        </p>

        <div class="button-group">
            <a href="{{ url('/homepage') }}" class="btn btn-primary">Go to Homepage</a>
            <a href="javascript:history.back()" class="btn btn-outline">Go Back</a>
        </div>

        <div class="footer-text">
            Need help? <a href="mailto:support@barangayconnect.com">Contact Support</a>
        </div>
    </div>
</body>
</html>