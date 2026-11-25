<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints Dashboard - iReklamo</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #FDFDFE;
            color: #333;
        }

        /* Sidebar Layout */
        .sidebar {
            position: fixed; left: 0; top: 0; width: 260px; height: 100vh;
            background: #0088FF; padding: 30px 20px; overflow-y: auto; z-index: 100;
        }
        .sidebar-logo {
            color: white; font-size: 22px; font-weight: 900; letter-spacing: 2px;
            margin-bottom: 50px; text-align: center;
        }
        .sidebar-menu { list-style: none; }
        .sidebar-menu li { margin-bottom: 10px; }
        .sidebar-menu a {
            display: block; color: white; text-decoration: none; padding: 15px 20px;
            border-radius: 12px; transition: all 0.3s; font-size: 15px;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255,255,255,0.2); }

        /* Main Content */
        .main-content { margin-left: 260px; padding: 30px; }

        .header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #e0e0e0;
        }
        .header h1 { color: #0088FF; font-size: 28px; font-weight: 900; }
        .header p { color: #666; font-size: 14px; margin-top: 5px; }

        /* Alerts */
        .alert { padding: 15px 20px; border-radius: 12px; margin-bottom: 25px; font-size: 14px; font-weight: 600; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        /* Stats Cards */
        .stats-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px; margin-bottom: 30px;
        }
        .stat-card {
            background: white; padding: 25px; border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,136,255,0.08); text-align: center;
            transition: transform 0.3s;
        }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-card h3 { color: #666; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; }
        .stat-card .number { color: #0088FF; font-size: 36px; font-weight: 900; }

        /* Filters */
        .filters-card {
            background: white; padding: 25px; border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,136,255,0.08); margin-bottom: 25px;
        }
        .filters-form { display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end; }
        .filter-group { flex: 1; min-width: 180px; }
        .filter-group label { display: block; font-size: 12px; font-weight: 700; color: #666; margin-bottom: 8px; text-transform: uppercase; }
        .filter-group select {
            width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 10px;
            font-size: 14px; background: #FDFDFE; transition: border-color 0.3s;
        }
        .filter-group select:focus { outline: none; border-color: #0088FF; }
        .btn-filter {
            background: #0088FF; color: white; border: none; padding: 12px 30px;
            border-radius: 10px; font-weight: 700; cursor: pointer; transition: all 0.3s;
        }
        .btn-filter:hover { background: #0066cc; transform: translateY(-2px); }

        /* Table */
        .table-card {
            background: white; border-radius: 20px; overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,136,255,0.08);
        }
        .table-wrapper { overflow-x: auto; }
        .complaints-table { width: 100%; border-collapse: collapse; text-align: left; }
        .complaints-table th {
            background: #FDFDFE; padding: 18px 20px; color: #666; font-size: 12px;
            font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
            border-bottom: 2px solid #e0e0e0;
        }
        .complaints-table td {
            padding: 18px 20px; border-bottom: 1px solid #f0f0f0; font-size: 14px; vertical-align: middle;
        }
        .complaints-table tbody tr:hover { background: #f8fbff; }
        .complaints-table tbody tr:last-child td { border-bottom: none; }

        /* Badges */
        .badge { padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; display: inline-block; text-transform: uppercase; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-high { background: #f8d7da; color: #721c24; }
        .badge-medium { background: #fff3cd; color: #856404; }
        .badge-low { background: #d4edda; color: #155724; }

        .status-badge { padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: capitalize; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-processing { background: #d1ecf1; color: #0c5460; }
        .status-approved, .status-resolved { background: #d4edda; color: #155724; }
        .status-rejected { background: #f8d7da; color: #721c24; }

        /* Update Form inside Table */
        .update-form { display: flex; gap: 8px; align-items: center; }
        .status-select {
            padding: 8px 12px; border: 2px solid #e0e0e0; border-radius: 8px;
            font-size: 13px; background: #FDFDFE; min-width: 140px;
        }
        .status-select:focus { outline: none; border-color: #0088FF; }
        .btn-save {
            background: #0088FF; color: white; border: none; padding: 8px 16px;
            border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s;
        }
        .btn-save:hover { background: #0066cc; }

        .empty-state { text-align: center; padding: 60px 20px; color: #999; font-size: 16px; }

        /* Pagination */
        .pagination-wrapper { padding: 20px; display: flex; justify-content: center; }
        .pagination-wrapper nav { display: flex; gap: 5px; }
        .pagination-wrapper span, .pagination-wrapper a {
            padding: 8px 14px; border: 1px solid #e0e0e0; border-radius: 8px;
            font-size: 13px; color: #666; text-decoration: none; transition: all 0.3s;
        }
        .pagination-wrapper a:hover { background: #0088FF; color: white; border-color: #0088FF; }
        .pagination-wrapper span.active { background: #0088FF; color: white; border-color: #0088FF; }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; padding: 20px; }
            .filters-form { flex-direction: column; }
            .filter-group { width: 100%; }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-logo">OFFICIAL</div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('official.dashboard') }}" class="active">📊 Dashboard</a></li>
            <li><a href="#">📢 Announcements</a></li>
            <li><a href="#">👥 Residents</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Logout</a></li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <div>
                <h1>Complaints Dashboard</h1>
                <p>Review complaints and update their status. Residents see the changes on their tracking page.</p>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        {{-- Stats Cards --}}
        <div class="stats-grid">
            @foreach($statuses as $s)
                <div class="stat-card">
                    <h3>{{ ucfirst(str_replace('_', ' ', $s)) }}</h3>
                    <div class="number">{{ $counts[$s] ?? 0 }}</div>
                </div>
            @endforeach
        </div>

        {{-- Filters --}}
        <div class="filters-card">
            <form method="GET" action="{{ route('official.dashboard') }}" class="filters-form">
                <div class="filter-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="">All statuses</option>
                        @foreach($statuses as $s)
                            <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $s)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label>Urgency</label>
                    <select name="urgency">
                        <option value="">All urgency</option>
                        @foreach($urgencies as $u)
                            <option value="{{ $u }}" {{ request('urgency') == $u ? 'selected' : '' }}>
                                {{ ucfirst($u) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label>Category</label>
                    <select name="category">
                        <option value="">All categories</option>
                        @foreach($categories as $c)
                            <option value="{{ $c }}" {{ request('category') == $c ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $c)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn-filter">Filter</button>
            </form>
        </div>

        {{-- Data Table --}}
        <div class="table-card">
            <div class="table-wrapper">
                <table class="complaints-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Resident</th>
                            <th>Complaint</th>
                            <th>Category</th>
                            <th>Urgency</th>
                            <th>Assigned to</th>
                            <th>Status</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
                            <tr>
                                <td><strong>{{ $complaint->id }}</strong></td>
                                <td>
                                    <strong>{{ $complaint->user->name }}</strong>
                                    @if($complaint->purok)
                                        <br><small style="color:#666;">{{ $complaint->purok }}</small>
                                    @endif
                                </td>
                                <td style="max-width: 250px;">{{ \Illuminate\Support\Str::limit($complaint->text, 140) }}</td>
                                <td>
                                    {{ $complaint->category ? ucfirst(str_replace('_', ' ', $complaint->category)) : '—' }}
                                    @if($complaint->needs_review && !$complaint->final_category)
                                        <br><span class="badge badge-warning">Needs Review</span>
                                    @endif
                                </td>
                                <td>
                                    @if($complaint->urgency)
                                        <span class="badge badge-{{ $complaint->urgency }}">{{ ucfirst($complaint->urgency) }}</span>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>{{ $complaint->official->name ?? 'Unassigned' }}</td>
                                <td>
                                    <span class="status-badge status-{{ $complaint->status }}">
                                        {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('official.complaints.status', $complaint) }}" class="update-form">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="status-select" required>
                                            @foreach($statuses as $s)
                                                <option value="{{ $s }}" @selected($complaint->status === $s)>
                                                    {{ ucfirst(str_replace('_', ' ', $s)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="remarks" value="{{ $complaint->remarks }}" placeholder="Remarks (optional)">
                                        <button type="submit" class="btn-save">Save</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty-state">No complaints found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($complaints->hasPages())
                <div class="pagination-wrapper">
                    {{ $complaints->links() }}
                </div>
            @endif
        </div>
    </main>

</body>
</html>