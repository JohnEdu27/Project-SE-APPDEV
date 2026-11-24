<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Connect - Welcome</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(180deg, #0088FF 0%, #FDFDFE 100%);
            min-height: 100vh;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background: transparent;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            letter-spacing: 2px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 1px;
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        .btn-enroll {
            background: white;
            color: #0088FF;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.3s;
        }

        .btn-enroll:hover {
            transform: scale(1.05);
        }

        .hero {
            text-align: center;
            padding: 100px 20px;
            color: white;
        }

        .hero h1 {
            font-size: 72px;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 30px;
            letter-spacing: -2px;
        }

        .hero p {
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto 40px;
            opacity: 0.9;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .btn-primary {
            background: white;
            color: #0088FF;
            padding: 15px 40px;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            padding: 15px 40px;
            border: 2px solid white;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background: white;
            color: #0088FF;
        }

        .features {
            background: #FDFDFE;
            padding: 80px 50px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,136,255,0.1);
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: #0088FF;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 28px;
        }

        .feature-card h3 {
            color: #0088FF;
            margin-bottom: 15px;
            font-size: 22px;
        }

        .feature-card p {
            color: #666;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">IREKLAMO</div>
        <ul class="nav-links">
            <li><a href="#about">ABOUT</a></li>
            <li><a href="#services">SERVICES</a></li>
            <li><a href="#contact">CONTACT</a></li>
            <li><a href="#community">COMMUNITY</a></li>
        </ul>
        <a href="{{ route('login') }}" class="btn-enroll">Login</a>
    </nav>

    <section class="hero">
        <h1>SUBMIT COMPLAINTS,<br>ONLINE!</h1>
        <p>Empowering barangay officials and residents with modern digital tools for better governance, communication, and community development.</p>
        <div class="hero-buttons">
            <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
            <a href="#about" class="btn-secondary">Learn More</a>
        </div>
    </section>

    <section class="features" id="services">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">📋</div>
                <h3>Document Requests</h3>
                <p>Request barangay certificates and documents online with easy tracking and fast processing.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📢</div>
                <h3>Announcements</h3>
                <p>Stay updated with the latest barangay news, events, and important announcements.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🤝</div>
                <h3>Community Services</h3>
                <p>Access various community services and programs designed to improve your quality of life.</p>
            </div>
        </div>
    </section>
</body>
</html>