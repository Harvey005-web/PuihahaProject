<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MemberFlow') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Palette: Gray, Silver, Yellow */
            --bg-canvas: #f4f5f7;
            --bg-surface: #ffffff;
            --bg-surface-alt: #f9fafb;
            --bg-surface-elevated: #ffffff;
            
            --silver-50: #f8fafc;
            --silver-100: #f1f5f9;
            --silver-200: #e2e8f0;
            --silver-300: #cbd5e1;
            --silver-400: #94a3b8;
            --silver-500: #64748b;
            
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            
            --yellow-accent: #facc15;
            --yellow-primary: #eab308;
            --yellow-hover: #ca8a04;
            --yellow-subtle: #fefce8;
            --yellow-border: #fef08a;
            --yellow-text: #854d0e;
            --yellow-glow: rgba(234, 179, 8, 0.22);

            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #64748b;
            --text-light: #94a3b8;

            --border-subtle: #e2e8f0;
            --border-medium: #cbd5e1;
            --border-strong: #94a3b8;

            --shadow-subtle: 0 1px 3px rgba(15, 23, 42, 0.05);
            --shadow-card: 0 4px 6px -1px rgba(15, 23, 42, 0.04), 0 2px 4px -2px rgba(15, 23, 42, 0.03);
            --shadow-dropdown: 0 10px 15px -3px rgba(15, 23, 42, 0.08), 0 4px 6px -4px rgba(15, 23, 42, 0.04);

            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 14px;
            --radius-full: 9999px;
            
            --font-sans: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            --font-display: 'Space Grotesk', -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg-canvas);
            color: var(--text-primary);
            font-family: var(--font-sans);
            font-size: 14px;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navigation Header */
        header.app-header {
            background: #111317;
            border-bottom: 1px solid #232730;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        nav.nav-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 24px;
            height: 64px;
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #ffffff;
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 18px;
            letter-spacing: -0.02em;
        }

        .brand-badge {
            width: 10px;
            height: 10px;
            background: var(--yellow-accent);
            border-radius: 2px;
            transform: rotate(45deg);
            box-shadow: 0 0 10px rgba(250, 204, 21, 0.6);
        }

        .brand-logo span.accent {
            color: var(--yellow-accent);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            padding: 7px 12px;
            border-radius: var(--radius-sm);
            transition: all 0.15s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-links a.active {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
            font-weight: 600;
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -13px;
            left: 50%;
            transform: translateX(-50%);
            width: 18px;
            height: 2px;
            background: var(--yellow-accent);
            border-radius: 2px;
        }

        .nav-user {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .user-pill {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 4px 12px 4px 6px;
            background: #1b1e26;
            border: 1px solid #2b303c;
            border-radius: var(--radius-full);
            color: #e2e8f0;
            font-size: 13px;
            font-weight: 500;
        }

        .user-avatar {
            width: 26px;
            height: 26px;
            border-radius: var(--radius-full);
            background: #2b303c;
            color: var(--yellow-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11.5px;
            font-weight: 700;
            border: 1px solid rgba(250, 204, 21, 0.3);
        }

        .btn-logout {
            background: transparent;
            color: #94a3b8;
            border: 1px solid #2d3340;
            border-radius: var(--radius-sm);
            padding: 6px 12px;
            font-size: 12.5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn-logout:hover {
            background: #1f242e;
            color: #ffffff;
            border-color: #475569;
        }

        /* Layout & Container */
        main.main-content {
            max-width: 1240px;
            width: 100%;
            margin: 0 auto;
            padding: 32px 24px 60px;
            flex: 1;
        }

        /* Page Headers */
        .head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
            gap: 16px;
            flex-wrap: wrap;
        }

        h1 {
            font-family: var(--font-display);
            font-size: 26px;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.03em;
            line-height: 1.2;
        }

        h2 {
            font-family: var(--font-display);
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.02em;
            margin: 28px 0 14px;
        }

        p.muted {
            color: var(--text-muted);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--yellow-accent);
            color: #111317;
            font-family: var(--font-sans);
            font-weight: 600;
            font-size: 13.5px;
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            border: 1px solid #eab308;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.05);
            line-height: 1.4;
        }

        .btn:hover {
            background: var(--yellow-primary);
            border-color: #ca8a04;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px var(--yellow-glow);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn.secondary, a.btn-secondary {
            background: #ffffff;
            color: var(--text-secondary);
            border: 1px solid var(--border-medium);
            box-shadow: var(--shadow-subtle);
        }

        .btn.secondary:hover, a.btn-secondary:hover {
            background: var(--silver-100);
            color: var(--text-primary);
            border-color: var(--border-strong);
            box-shadow: var(--shadow-card);
        }

        .btn.danger {
            background: #ffffff;
            color: #dc2626;
            border: 1px solid #fca5a5;
            box-shadow: none;
        }

        .btn.danger:hover {
            background: #fef2f2;
            border-color: #ef4444;
            box-shadow: 0 2px 6px rgba(220, 38, 38, 0.12);
        }

        /* Cards & Surfaces */
        .card {
            background: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-md);
            padding: 24px;
            box-shadow: var(--shadow-card);
            margin-bottom: 24px;
        }

        /* Form Controls */
        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 6px;
        }

        input:not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([type="button"]):not([type="file"]):not([type="hidden"]),
        select,
        textarea {
            width: 100%;
            box-sizing: border-box;
            height: 42px;
            padding: 9px 13px;
            font-family: var(--font-sans);
            font-size: 14px;
            color: var(--text-primary);
            background-color: #ffffff;
            border: 1px solid var(--border-medium);
            border-radius: var(--radius-sm);
            outline: none;
            transition: all 0.15s ease;
            box-shadow: inset 0 1px 2px rgba(15, 23, 42, 0.03);
            margin-bottom: 16px;
        }

        input:not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([type="button"]):not([type="file"]):not([type="hidden"]):focus,
        select:focus,
        textarea:focus {
            border-color: var(--yellow-primary);
            box-shadow: 0 0 0 3px var(--yellow-glow);
        }

        textarea {
            height: auto;
            min-height: 84px;
            resize: vertical;
        }

        /* Grid */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 18px;
            margin-bottom: 16px;
        }

        /* Stat Cards */
        .stat {
            background: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-md);
            padding: 20px 22px;
            box-shadow: var(--shadow-card);
            position: relative;
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .stat::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--yellow-accent), #e2e8f0);
            opacity: 0.85;
        }

        .stat:hover {
            transform: translateY(-2px);
            border-color: var(--border-medium);
            box-shadow: var(--shadow-dropdown);
        }

        .stat span {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            display: block;
            margin-bottom: 8px;
        }

        .stat b {
            font-family: var(--font-display);
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        /* Tables */
        .table-container {
            background: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-card);
            overflow: hidden;
            margin-bottom: 24px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-card);
            overflow: hidden;
            margin-bottom: 20px;
        }

        th {
            background: #f8fafc;
            color: var(--text-muted);
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 12px 18px;
            text-align: left;
            border-bottom: 1px solid var(--border-subtle);
        }

        td {
            padding: 14px 18px;
            color: var(--text-primary);
            font-size: 13.5px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background-color: #fbfcfd;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: var(--radius-full);
            font-size: 12px;
            font-weight: 600;
            background: var(--silver-100);
            color: var(--gray-700);
            border: 1px solid var(--silver-200);
            line-height: 1.3;
        }

        .badge.active, .badge:contains("Active"), .badge:contains("Paid"), .badge:contains("Approved") {
            background: var(--yellow-subtle);
            color: var(--yellow-text);
            border-color: var(--yellow-border);
        }

        /* Links */
        a {
            color: #0f172a;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.15s ease;
        }

        a:hover {
            color: #b45309;
        }

        td a {
            color: #0f172a;
            font-weight: 600;
            text-decoration: none;
            border-bottom: 1px dashed var(--silver-400);
            padding-bottom: 1px;
            transition: all 0.15s ease;
        }

        td a:hover {
            color: #000;
            border-bottom-color: var(--yellow-primary);
        }

        /* Notice / Alerts */
        .notice {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
            box-shadow: var(--shadow-subtle);
        }

        .notice.error {
            background: #fef2f2;
            color: #991b1b;
            border-color: #fecaca;
        }

        form.inline {
            display: inline-block;
            margin: 0;
        }

        /* Pagination Styling */
        nav[role="navigation"] {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            gap: 10px;
        }

        nav[role="navigation"] a,
        nav[role="navigation"] span {
            padding: 6px 12px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            border: 1px solid var(--border-subtle);
            background: var(--bg-surface);
            color: var(--text-secondary);
        }

        nav[role="navigation"] a:hover {
            border-color: var(--yellow-primary);
            color: var(--text-primary);
            background: var(--yellow-subtle);
        }

        /* Responsive */
        @media (max-width: 768px) {
            nav.nav-container {
                height: auto;
                padding: 14px 16px;
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }
            .nav-user {
                margin-left: 0;
                width: 100%;
                justify-content: space-between;
            }
            main.main-content {
                padding: 20px 16px 40px;
            }
            .head {
                flex-direction: column;
                align-items: stretch;
            }
            .head .btn {
                width: 100%;
                text-align: center;
            }
            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <header class="app-header">
        <nav class="nav-container">
            <a class="brand-logo" href="{{ route('dashboard') }}">
                <span class="brand-badge"></span>
                <span>Member<span class="accent">Flow</span></span>
            </a>

            <div class="nav-links">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('members.index') }}" class="{{ request()->routeIs('members.*') ? 'active' : '' }}">Members</a>
                <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">Categories</a>
                <a href="{{ route('levels.index') }}" class="{{ request()->routeIs('levels.*') ? 'active' : '' }}">Levels</a>
                <a href="{{ route('transactions.index') }}" class="{{ request()->routeIs('transactions.*') ? 'active' : '' }}">Transactions</a>
                <a href="{{ route('payments.index') }}" class="{{ request()->routeIs('payments.*') ? 'active' : '' }}">Payments</a>
            </div>

            <div class="nav-user">
                <div class="user-pill">
                    <span class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</span>
                    <span>{{ auth()->user()->name }}</span>
                </div>
                <form class="inline" method="post" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn-logout" type="submit">Sign out</button>
                </form>
            </div>
        </nav>
    </header>

    <main class="main-content">
        @if(session('success'))
            <div class="notice">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="notice error">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="notice error">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
