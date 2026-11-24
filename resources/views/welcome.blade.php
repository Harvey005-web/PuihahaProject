<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MemberFlow') }} &mdash; Membership Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-canvas: #0d0f12;
            --surface-card: #15181f;
            --border-subtle: #242935;
            --yellow-accent: #facc15;
            --yellow-primary: #eab308;
            --silver-50: #f8fafc;
            --silver-200: #e2e8f0;
            --silver-400: #94a3b8;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --font-sans: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            --font-display: 'Space Grotesk', -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-sans);
            background: var(--bg-canvas);
            background-image: 
                radial-gradient(circle at 50% 0%, rgba(250, 204, 21, 0.08) 0%, transparent 60%),
                radial-gradient(circle at 100% 100%, rgba(148, 163, 184, 0.04) 0%, transparent 50%);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        header {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 24px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #ffffff;
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 20px;
        }

        .brand-badge {
            width: 11px;
            height: 11px;
            background: var(--yellow-accent);
            border-radius: 2px;
            transform: rotate(45deg);
            box-shadow: 0 0 10px rgba(250, 204, 21, 0.6);
        }

        .btn-nav {
            padding: 8px 18px;
            background: var(--surface-card);
            border: 1px solid var(--border-subtle);
            color: #e2e8f0;
            border-radius: 6px;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.15s ease;
        }

        .btn-nav:hover {
            border-color: var(--yellow-accent);
            color: #ffffff;
        }

        .hero {
            max-width: 900px;
            margin: 40px auto 60px;
            padding: 0 24px;
            text-align: center;
        }

        .tag-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            background: #1c202a;
            border: 1px solid #2d3342;
            border-radius: 9999px;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--yellow-accent);
            margin-bottom: 24px;
        }

        .tag-pill span.dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--yellow-accent);
        }

        h1 {
            font-family: var(--font-display);
            font-size: clamp(36px, 6vw, 56px);
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.15;
            color: #ffffff;
            margin-bottom: 20px;
        }

        h1 span.highlight {
            color: var(--yellow-accent);
        }

        p.subtitle {
            font-size: clamp(16px, 2vw, 19px);
            color: var(--text-secondary);
            max-width: 620px;
            margin: 0 auto 36px;
            line-height: 1.6;
        }

        .cta-group {
            display: flex;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--yellow-accent);
            color: #0d0f12;
            font-weight: 700;
            padding: 12px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            box-shadow: 0 4px 14px rgba(250, 204, 21, 0.35);
            transition: all 0.15s ease;
        }

        .btn-primary:hover {
            background: var(--yellow-primary);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(250, 204, 21, 0.45);
        }

        footer {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 24px 32px;
            border-top: 1px solid var(--border-subtle);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: var(--silver-400);
        }
    </style>
</head>
<body>
    <header>
        <a class="brand-logo" href="{{ url('/') }}">
            <span class="brand-badge"></span>
            <span>Member<span style="color: var(--yellow-accent);">Flow</span></span>
        </a>
        <nav>
            @auth
                <a href="{{ route('dashboard') }}" class="btn-nav">Open Dashboard &rarr;</a>
            @else
                <a href="{{ route('login') }}" class="btn-nav">Sign in</a>
            @endauth
        </nav>
    </header>

    <main class="hero">
        <div class="tag-pill">
            <span class="dot"></span>
            <span>Minimal Membership Management</span>
        </div>
        <h1>Streamlined membership operations with <span class="highlight">precision</span></h1>
        <p class="subtitle">Complete oversight of membership registrations, subscription tiers, renewal pipelines, and verified payment collections.</p>
        <div class="cta-group">
            <a href="{{ route('dashboard') }}" class="btn-primary">
                Access Portal
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </main>

    <footer>
        <div>&copy; {{ date('Y') }} MemberFlow. Minimal Gray, Silver &amp; Yellow Edition.</div>
        <div>All rights reserved.</div>
    </footer>
</body>
</html>
