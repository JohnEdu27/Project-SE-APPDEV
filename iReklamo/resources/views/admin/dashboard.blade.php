<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - iReklamo</title>
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

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
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
        }

        .btn-action:hover {
            background: #0066cc;
        }

        .activity-list {
            list-style: none;
        }

        .activity-item {
            padding: 15px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-time {
            color: #999;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-logo">ADMIN</div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active">📊 Dashboard</a></li>
            <li><a href="#">👥 Users</a></li>
            <li><a href="#">📋 Documents</a></li>
            <li><a href="#">📢 Announcements</a></li>
            <li><a href="#">🏘️ Barangays</a></li>
            <li><a href="#">⚙️ Settings</a></li>
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
            <h1>Admin Dashboard</h1>
            <div class="user-info">
                <div>
                    <div style="font-weight: 600;">{{ auth()->user()->name }}</div>
                    <div style="font-size: 13px; color: #666;">Administrator</div>
                </div>
                <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Residents</h3>
                <div class="number">1,234</div>
                <div class="change">↑ 12% from last month</div>
            </div>
            <div class="stat-card">
                <h3>Pending Requests</h3>
                <div class="number">45</div>
                <div class="change">↑ 5 new today</div>
            </div>
            <div class="stat-card">
                <h3>Barangay Officials</h3>
                <div class="number">28</div>
                <div class="change">Active accounts</div>
            </div>
            <div class="stat-card">
                <h3>Documents Processed</h3>
                <div class="number">892</div>
                <div class="change">↑ 23% this month</div>
            </div>
        </div>

        <div class="content-grid">
            <div class="card">
                <h2>Recent Document Requests</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Resident</th>
                            <th>Complaint Type</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#001</td>
                            <td>Juan Dela Cruz</td>
                            <td>Garbage Complaint</td>
                            <td>Nov 24, 2026</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td><a href="#" class="btn-action">View</a></td>
                        </tr>
                        <tr>
                            <td>#002</td>
                            <td>Maria Santos</td>
                            <td>Flooding</td>
                            <td>Nov 24, 2026</td>
                            <td><span class="status-badge status-approved">Approved</span></td>
                            <td><a href="#" class="btn-action">View</a></td>
                        </tr>
                        <tr>
                            <td>#003</td>
                            <td>Pedro Reyes</td>
                            <td>Maoy Complaint</td>
                            <td>Nov 23, 2026</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td><a href="#" class="btn-action">View</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card">
                <h2>Recent Activity</h2>
                <ul class="activity-list">
                    <li class="activity-item">
                        <div>New user registration: Juan Dela Cruz</div>
                        <div class="activity-time">2 hours ago</div>
                    </li>
                    <li class="activity-item">
                        <div>Document request approved #002</div>
                        <div class="activity-time">3 hours ago</div>
                    </li>
                    <li class="activity-item">
                        <div>New announcement posted</div>
                        <div class="activity-time">5 hours ago</div>
                    </li>
                    <li class="activity-item">
                        <div>System backup completed</div>
                        <div class="activity-time">1 day ago</div>
                    </li>
                </ul>
            </div>
        </div>
    </main>
</body>
</html>