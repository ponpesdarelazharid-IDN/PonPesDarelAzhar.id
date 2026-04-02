<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Salary Manager') — 💰 Gaji Ku</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        :root {
            --bg-base:    #0f0f1a;
            --bg-card:    #1a1a2e;
            --bg-panel:   #16213e;
            --border:     #2a2a4a;
            --accent:     #7c3aed;
            --accent-2:   #06b6d4;
            --accent-3:   #10b981;
            --text-1:     #f1f5f9;
            --text-2:     #94a3b8;
            --text-3:     #64748b;
            --danger:     #ef4444;
            --warning:    #f59e0b;
            --success:    #10b981;
            --radius:     12px;
            --radius-lg:  18px;
            --shadow:     0 4px 24px rgba(0,0,0,0.4);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-base);
            color: var(--text-1);
            min-height: 100vh;
            display: flex;
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: var(--bg-card);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
            transition: transform .3s ease;
        }
        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--border);
        }
        .sidebar-brand h2 {
            font-size: 1.1rem;
            font-weight: 800;
            background: linear-gradient(135deg, #7c3aed, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .sidebar-brand p {
            font-size: .75rem;
            color: var(--text-3);
            margin-top: 2px;
        }
        .sidebar-nav {
            padding: 16px 12px;
            flex: 1;
        }
        .nav-label {
            font-size: .65rem;
            font-weight: 700;
            color: var(--text-3);
            text-transform: uppercase;
            letter-spacing: .1em;
            padding: 0 8px;
            margin: 12px 0 6px;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-2);
            font-size: .875rem;
            font-weight: 500;
            transition: all .2s;
            margin-bottom: 2px;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(124, 58, 237, 0.15);
            color: var(--text-1);
        }
        .nav-link.active { color: #a78bfa; }
        .nav-link .icon { font-size: 1.1rem; width: 20px; text-align: center; }
        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--border);
        }
        .sidebar-footer a {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .8rem;
            color: var(--text-3);
            text-decoration: none;
            padding: 8px;
            border-radius: 8px;
            transition: color .2s;
        }
        .sidebar-footer a:hover { color: var(--text-1); }

        /* ─── MAIN CONTENT ─── */
        .main {
            margin-left: 240px;
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            padding: 16px 28px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(15, 15, 26, 0.8);
            backdrop-filter: blur(8px);
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .topbar-title {
            font-size: 1.25rem;
            font-weight: 700;
        }
        .topbar-month {
            font-size: .8rem;
            color: var(--text-3);
            background: var(--bg-card);
            padding: 6px 14px;
            border-radius: 20px;
            border: 1px solid var(--border);
        }
        .page-content {
            padding: 28px;
            flex: 1;
        }

        /* ─── CARDS ─── */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow);
        }
        .card-sm { padding: 16px 20px; }

        /* ─── STAT CARDS ─── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            position: relative;
            overflow: hidden;
            transition: transform .2s, border-color .2s;
        }
        .stat-card:hover { transform: translateY(-2px); border-color: #7c3aed44; }
        .stat-card::before {
            content:'';
            position:absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--stat-color, var(--accent));
        }
        .stat-icon { font-size: 1.8rem; margin-bottom: 10px; }
        .stat-label { font-size: .75rem; color: var(--text-3); margin-bottom: 4px; }
        .stat-value { font-size: 1.4rem; font-weight: 700; }
        .stat-sub { font-size: .7rem; color: var(--text-3); margin-top: 4px; }

        /* ─── BUTTONS ─── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: .875rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all .2s;
            text-decoration: none;
        }
        .btn-primary {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            color: #fff;
            box-shadow: 0 4px 12px rgba(124,58,237,.3);
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(124,58,237,.4); }
        .btn-success { background: linear-gradient(135deg, #10b981, #059669); color: #fff; }
        .btn-danger { background: rgba(239,68,68,.15); color: #ef4444; border: 1px solid rgba(239,68,68,.3); }
        .btn-danger:hover { background: rgba(239,68,68,.25); }
        .btn-ghost { background: var(--bg-panel); color: var(--text-2); border: 1px solid var(--border); }
        .btn-ghost:hover { color: var(--text-1); border-color: #7c3aed44; }
        .btn-sm { padding: 6px 12px; font-size: .8rem; }

        /* ─── FORMS ─── */
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: .8rem; font-weight: 600; color: var(--text-2); margin-bottom: 6px; }
        .form-control {
            width: 100%;
            background: var(--bg-panel);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 10px 14px;
            color: var(--text-1);
            font-size: .9rem;
            font-family: inherit;
            transition: border-color .2s;
        }
        .form-control:focus { outline: none; border-color: #7c3aed; box-shadow: 0 0 0 3px rgba(124,58,237,.15); }
        .form-control::placeholder { color: var(--text-3); }
        select.form-control { cursor: pointer; }

        /* ─── TABLE ─── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th {
            font-size: .75rem;
            font-weight: 700;
            color: var(--text-3);
            text-transform: uppercase;
            letter-spacing: .05em;
            padding: 10px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }
        td {
            padding: 13px 16px;
            border-bottom: 1px solid rgba(42,42,74,.5);
            font-size: .875rem;
            color: var(--text-2);
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(124,58,237,.04); color: var(--text-1); }

        /* ─── BADGES ─── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: .72rem;
            font-weight: 600;
        }
        .badge-fixed     { background: rgba(99,102,241,.15); color: #818cf8; border: 1px solid rgba(99,102,241,.3); }
        .badge-pct       { background: rgba(16,185,129,.15); color: #34d399; border: 1px solid rgba(16,185,129,.3); }
        .badge-paid      { background: rgba(16,185,129,.15); color: #34d399; border: 1px solid rgba(16,185,129,.3); }
        .badge-unpaid    { background: rgba(239,68,68,.1); color: #f87171; border: 1px solid rgba(239,68,68,.2); }

        /* ─── ALERTS ─── */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: .875rem;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .alert-success { background: rgba(16,185,129,.1); color: #34d399; border: 1px solid rgba(16,185,129,.2); }
        .alert-error   { background: rgba(239,68,68,.1); color: #f87171; border: 1px solid rgba(239,68,68,.2); }

        /* ─── PILL TABS ─── */
        .tabs { display: flex; gap: 8px; margin-bottom: 20px; }
        .tab-btn {
            padding: 8px 18px;
            border-radius: 20px;
            font-size: .82rem;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--text-2);
            transition: all .2s;
        }
        .tab-btn.active, .tab-btn:hover {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            color: #fff;
            border-color: transparent;
        }

        /* ─── PROGRESS BAR ─── */
        .progress { height: 6px; background: var(--border); border-radius: 3px; overflow: hidden; }
        .progress-bar { height: 100%; border-radius: 3px; transition: width .6s ease; }

        /* ─── GRID ─── */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }

        /* ─── SCROLLBAR ─── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-base); }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #4a4a6a; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); }
            .main { margin-left: 0; }
            .grid-2, .grid-3 { grid-template-columns: 1fr; }
        }

        /* ─── ANIMATION ─── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fadeInUp .4s ease both; }
        .fade-in-2 { animation: fadeInUp .4s .1s ease both; }
        .fade-in-3 { animation: fadeInUp .4s .2s ease both; }
    </style>
    @stack('styles')
</head>
<body>

<!-- ─── SIDEBAR ─── -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <h2>💰 Gaji Ku</h2>
        <p>Salary Manager</p>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-label">Menu Utama</div>
        <a href="{{ route('salary.dashboard') }}" class="nav-link {{ request()->routeIs('salary.dashboard') ? 'active' : '' }}">
            <span class="icon">📊</span> Dashboard
        </a>
        <a href="{{ route('salary.index') }}" class="nav-link {{ request()->routeIs('salary.index') ? 'active' : '' }}">
            <span class="icon">💵</span> Input Gaji
        </a>
        <a href="{{ route('salary.categories.index') }}" class="nav-link {{ request()->routeIs('salary.categories*') ? 'active' : '' }}">
            <span class="icon">📋</span> Pos Pengeluaran
        </a>

        <div class="nav-label" style="margin-top:24px">Lainnya</div>
        <a href="{{ url('/') }}" class="nav-link">
            <span class="icon">🏠</span> Kembali ke App
        </a>
    </nav>
    <div class="sidebar-footer">
        <a href="#">
            <span>📅</span>
            {{ now()->translatedFormat('d M Y') }}
        </a>
    </div>
</aside>

<!-- ─── MAIN ─── -->
<div class="main">
    <header class="topbar">
        <div class="topbar-title">@yield('topbar-title', 'Salary Manager')</div>
        <span class="topbar-month">{{ now()->isoformat('MMMM YYYY') }}</span>
    </header>

    <div class="page-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>
