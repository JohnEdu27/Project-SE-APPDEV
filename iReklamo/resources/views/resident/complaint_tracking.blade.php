<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Complaints & Status - iReklamo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #FDFDFE;
            min-height: 100vh;
        }

        /* Top Navigation */
        .navbar {
            background: #0088FF;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0,136,255,0.15);
        }

        .logo {
            color: white;
            font-size: 22px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-left: 25px;
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 30px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            color: #0088FF;
            font-size: 32px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #666;
            font-size: 16px;
        }

        /* Card Container */
        .data-card {
            background: white;
            border-radius: 25px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(0,136,255,0.08);
            overflow: hidden;
        }

        /* Table Styles */
        .table-wrapper {
            overflow-x: auto;
        }

        .tracking-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .tracking-table thead {
            background: #FDFDFE;
        }

        .tracking-table th {
            padding: 18px 25px;
            color: #666;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #e0e0e0;
        }

        .tracking-table td {
            padding: 22px 25px;
            color: #333;
            font-size: 15px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .tracking-table tbody tr {
            transition: background 0.2s;
        }

        .tracking-table tbody tr:hover {
            background: #f8fbff;
        }

        .tracking-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Specific Column Styles */
        .tracking-id {
            font-weight: 800;
            color: #0088FF;
            font-family: 'Courier New', Courier, monospace;
            font-size: 16px;
            background: #f0f8ff;
            padding: 6px 12px;
            border-radius: 8px;
            display: inline-block;
        }

        .user-name {
            font-weight: 600;
            color: #333;
        }

        .official-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .official-avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #0088FF, #0066cc);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            box-shadow: 0 4px 10px rgba(0,136,255,0.2);
        }

        .official-details {
            display: flex;
            flex-direction: column;
        }

        .official-name {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .official-role {
            font-size: 12px;
            color: #999;
        }

        /* Status Badges */
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending { background: #fff3cd; color: #856404; }
        .status-processing { background: #d1ecf1; color: #0c5460; }
        .status-approved { background: #d4edda; color: #155724; }
        .status-released { background: #e2e3e5; color: #383d41; }
        .status-rejected { background: #f8d7da; color: #721c24; }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-icon {
            width: 100px;
            height: 100px;
            background: #f0f8ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 48px;
        }

        .empty-state h3 {
            color: #333;
            font-size: 22px;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #666;
            margin-bottom: 25px;
        }

        .btn-primary {
            background: #0088FF;
            color: white;
            padding: 14px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-primary:hover {
            background: #0066cc;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,136,255,0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar { padding: 15px 20px; }
            .nav-links { display: none; }
            .main-content { padding: 0 15px; margin: 20px auto; }
            .data-card { padding: 20px 15px; border-radius: 20px; }
            .tracking-table th, .tracking-table td { padding: 15px; font-size: 13px; }
        }
    </style>
</head>
<body>

    <!-- Top Navigation -->
    <nav class="navbar">
        <div class="logo">IREKLAMO</div>
        <div class="nav-links">
            <a href="{{ route('homepage') }}">Home</a>
            <a href="{{ route('submit.complaint') }}">Submit Complaint</a>
            <a href="{{ route('my.complaints') }}" style="opacity: 0.7;">Track Status</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="page-header">
            <h1>My Complaints & Requests</h1>
            <p>Track the real-time progress of your submitted complaints and document requests.</p>
        </div>

        <div class="data-card">
            <div class="table-wrapper">
                <table class="tracking-table">
                    <thead>
                        <tr>
                            <th>Tracking ID</th>
                            <th>Applicant Name</th>
                            <th>Assigned Official</th>
                            <th>Status</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
                            <tr>
                                <td>
                                    <span class="tracking-id">
                                        {{ $complaint->tracking_id ?? 'BRGY-' . str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="user-name">{{ $complaint->user->name }}</span>
                                </td>
                                <td>
                                    <div class="official-info">
                                        <div class="official-avatar">{{ substr($complaint->official->name ?? 'U', 0, 1) }}</div>
                                        <div class="official-details">
                                            <span class="official-name">{{ $complaint->official->name ?? 'Unassigned' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $complaint->status }}">
                                        {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="remarks-info">{{ $complaint->remarks ?? 'None' }} </span>
                                </td>
                            </tr>
                        
                        @empty
                            <tr><td colspan="4">You haven't submitted any complaints yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $complaints->links() }}
        </div>
    </main>

</body>
</html>