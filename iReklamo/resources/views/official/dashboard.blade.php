<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Official Dashboard - Barangay Connect</title>
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

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: #0088FF;
            padding: 30px 20px;
            overflow-y: auto;
        }

        .sidebar-logo {
            color: white;
            font-size: 22px;
            font-weight: 900;
            letter-spacing: 2px;
            margin-bottom: 50px;
            text-align: center;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 10px;
        }

        .sidebar-menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            border-radius: 12px;
            transition: all 0.3s;
            font-size: 15px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,0.2);
        }

        .main-content {
            margin-left: 260px;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e0e0e0;
        }

        .header h1 {
            color: #0088FF;
            font-size: 32px;
            font-weight: 900;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: #0088FF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,136,255,0.1);
        }

        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-card .number {
            color: #0088FF;
            font-size: 42px;
            font-weight: 900;
        }

        .stat-card .change {
            color: #3c3;
            font-size: 14px;
            margin-top: 10px;
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

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        .table th {
            color: #666;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
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

        .btn-action {
            background: #0088FF;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
            margin-right: 5px;
        }

        .btn-action:hover {
            background: #0066cc;
        }

        .btn-approve {
            background: #28a745;
        }

        .btn-approve:hover {
            background: #218838;
        }

        .btn-reject {
            background: #dc3545;
        }

        .btn-reject:hover {
            background: #c82333;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .action-btn {
            background: #0088FF;
            color: white;
            padding: 20px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s;
        }

        .action-btn:hover {
            background: #0066cc;
            transform: translateY(-3px);
        }

        .action-btn .icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .action-btn .label {
            font-size: 14px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-logo">OFFICIAL</div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active">📊 Dashboard</a></li>
            <li><a href="#">📋 Document Requests</a></li>
            <li><a href="#">📢 Announcements</a></li>
            <li><a href="#">👥 Residents</a></li>
            <li><a href="#">📅 Events</a></li>
            <li><a href="#">📊 Reports</a></li>
            <li><a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   🚪 Logout
               </a></li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </aside>

    <main class="main-content">
        <div class="header">
            <h1>Barangay Official Dashboard</h1>
            <div class="user-info">
                <div>
                    <div style="font-weight: 600;">{{ auth()->user()->name }}</div>
                    <div style="font-size: 13px; color: #666;">Barangay Official</div>
                </div>
                <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Pending Requests</h3>
                <div class="number">12</div>
                <div class="change">Needs attention</div>
            </div>
            <div class="stat-card">
                <h3>Today's Requests</h3>
                <div class="number">8</div>
                <div class="change">↑ 3 from yesterday</div>
            </div>
            <div class="stat-card">
                <h3>Approved This Week</h3>
                <div class="number">45</div>
                <div class="change">↑ 15% increase</div>
            </div>
            <div class="stat-card">
                <h3>Active Residents</h3>
                <div class="number">234</div>
                <div class="change">Registered users</div>
            </div>
        </div>

        <div class="content-grid">
            <div class="card">
                <h2>Pending Document Requests</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Resident</th>
                            <th>Document</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#001</td>
                            <td>Juan Dela Cruz</td>
                            <td>Barangay Certificate</td>
                            <td>Nov 24, 2026</td>
                            <td>
                                <a href="#" class="btn-action btn-approve">Approve</a>
                                <a href="#" class="btn-action btn-reject">Reject</a>
                            </td>
                        </tr>
                        <tr>
                            <td>#003</td>
                            <td>Pedro Reyes</td>
                            <td>Business Permit</td>
                            <td>Nov 23, 2026</td>
                            <td>
                                <a href="#" class="btn-action btn-approve">Approve</a>
                                <a href="#" class="btn-action btn-reject">Reject</a>
                            </td>
                        </tr>
                        <tr>
                            <td>#004</td>
                            <td>Ana Garcia</td>
                            <td>Certificate of Indigency</td>
                            <td>Nov 23, 2026</td>
                            <td>
                                <a href="#" class="btn-action btn-approve">Approve</a>
                                <a href="#" class="btn-action btn-reject">Reject</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card">
                <h2>Quick Actions</h2>
                <div class="quick-actions">
                    <a href="#" class="action-btn">
                        <div class="icon">📢</div>
                        <div class="label">Post Announcement</div>
                    </a>
                    <a href="#" class="action-btn">
                        <div class="icon">📋</div>
                        <div class="label">Process Documents</div>
                    </a>
                    <a href="#" class="action-btn">
                        <div class="icon">📅</div>
                        <div class="label">Schedule Event</div>
                    </a>
                    <a href="#" class="action-btn">
                        <div class="icon">📊</div>
                        <div class="label">View Reports</div>
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>