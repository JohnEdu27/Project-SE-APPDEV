<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Homepage - iReklamo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #FDFDFE;
        }

        .navbar {
            background: #0088FF;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,136,255,0.2);
        }

        .logo {
            color: white;
            font-size: 22px;
            font-weight: 900;
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
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0088FF;
            font-weight: 600;
        }

        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 50px;
        }

        .welcome-section {
            background: linear-gradient(135deg, #0088FF 0%, #0066cc 100%);
            padding: 50px;
            border-radius: 30px;
            color: white;
            margin-bottom: 40px;
        }

        .welcome-section h1 {
            font-size: 42px;
            font-weight: 900;
            margin-bottom: 15px;
        }

        .welcome-section p {
            font-size: 18px;
            opacity: 0.9;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .service-card {
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,136,255,0.1);
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,136,255,0.2);
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: #0088FF;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .service-card h3 {
            color: #0088FF;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .service-card p {
            color: #666;
            line-height: 1.6;
            font-size: 14px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,136,255,0.1);
        }

        .card h2 {
            color: #0088FF;
            margin-bottom: 25px;
            font-size: 22px;
        }

        .announcement-item {
            padding: 20px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .announcement-item:last-child {
            border-bottom: none;
        }

        .announcement-item h4 {
            color: #333;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .announcement-item p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        .announcement-date {
            color: #999;
            font-size: 12px;
            margin-top: 8px;
        }

        .request-status {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .request-status:last-child {
            border-bottom: none;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background: #d4edda;
            color: #155724;
        }

        .status-processing {
            background: #d1ecf1;
            color: #0c5460;
        }

        .btn-request {
            background: #0088FF;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-request:hover {
            background: #0066cc;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">IREKLAMO</div>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Announcements</a></li>
            <li><a href="#">Profile</a></li>
            <li><form method="POST" action="/logout">
            @csrf
            <button type="submit">Log out</button>
            </form></li>

        </ul>
        <div class="user-menu">
            <div>
                <div style="color: white; font-weight: 600; font-size: 14px;">{{ auth()->user()->name }}</div>
                <div style="color: rgba(255,255,255,0.8); font-size: 12px;">{{ Auth::user()->role }}</div>
            </div>
            <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
        </div>
    </nav>

    <main class="main-content">
        <div class="welcome-section">
            <h1>Welcome, {{ auth()->user()->name }}! 👋</h1>
            <p>Your one-stop platform for all barangay services and community updates.</p>
        </div>

        <div class="services-grid">
            <a href="/submit-complaint" class="service-card">
                <div class="service-icon">📋</div>
                <h3>Submit Complaints</h3>
                <p>you can now submit complaints via online.</p>
            </a>
            <a href="/my-complaints" class="service-card">
                <div class="service-icon">📢</div>
                <h3>Monitor Complaint Status</h3>
                <p>Stay updated in the status of your Complaints.</p>
            </a>
            <a href="#" class="service-card">
                <div class="service-icon">🚨</div>
                <h3>Report Issues</h3>
                <p>Report community concerns, emergencies, or maintenance issues directly to officials.</p>
            </a>
            <a href="#" class="service-card">
                <div class="service-icon">📅</div>
                <h3>Community Events</h3>
                <p>Discover and participate in upcoming barangay events and activities.</p>
            </a>
        </div>

        <div class="content-grid">
            <div class="card">
                <h2>Latest Announcements</h2>
                <div class="announcement-item">
                    <h4>Community Clean-up Drive</h4>
                    <p>Join us this Saturday for our monthly community clean-up drive. Meet at the barangay hall at 7:00 AM.</p>
                    <div class="announcement-date">Posted 2 hours ago</div>
                </div>
                <div class="announcement-item">
                    <h4>Free Health Check-up</h4>
                    <p>Free health check-up services will be available at the barangay health center from November 25-27.</p>
                    <div class="announcement-date">Posted 1 day ago</div>
                </div>
                <div class="announcement-item">
                    <h4>Water Interruption Notice</h4>
                    <p>Scheduled water interruption on November 26, 2026 from 8:00 AM to 5:00 PM for pipeline maintenance.</p>
                    <div class="announcement-date">Posted 2 days ago</div>
                </div>
            </div>

            <div class="card">
                <h2>My Requests</h2>
                <div class="request-status">
                    <div>
                        <div style="font-weight: 600; font-size: 14px;">Barangay Certificate</div>
                        <div style="font-size: 12px; color: #999;">Nov 24, 2026</div>
                    </div>
                    <span class="status-badge status-pending">Pending</span>
                </div>
                <div class="request-status">
                    <div>
                        <div style="font-weight: 600; font-size: 14px;">Certificate of Residency</div>
                        <div style="font-size: 12px; color: #999;">Nov 20, 2026</div>
                    </div>
                    <span class="status-badge status-approved">Approved</span>
                </div>
                <div class="request-status">
                    <div>
                        <div style="font-weight: 600; font-size: 14px;">Business Permit</div>
                        <div style="font-size: 12px; color: #999;">Nov 18, 2026</div>
                    </div>
                    <span class="status-badge status-processing">Processing</span>
                </div>
                <div style="margin-top: 20px; text-align: center;">
                    <a href="#" class="btn-request">New Request</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>