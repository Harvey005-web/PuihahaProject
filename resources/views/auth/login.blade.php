<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In — MemberFlow</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #0d0f12;
            --surface-card: #16181f;
            --surface-input: #1f232b;
            --border-subtle: #292e3a;
            --border-focus: #eab308;
            --yellow-accent: #facc15;
            --yellow-glow: rgba(250, 204, 21, 0.25);
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
            background-color: var(--bg-body);
            background-image: 
                radial-gradient(circle at 50% 0%, rgba(250, 204, 21, 0.08) 0%, transparent 60%),
                radial-gradient(circle at 100% 100%, rgba(148, 163, 184, 0.04) 0%, transparent 50%);
            color: var(--text-primary);
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: var(--surface-card);
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            padding: 36px 32px;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.05);
            position: relative;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 24px;
            right: 24px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--yellow-accent), transparent);
            opacity: 0.8;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        .brand-mark {
            width: 14px;
            height: 14px;
            background: var(--yellow-accent);
            border-radius: 3px;
            transform: rotate(45deg);
            box-shadow: 0 0 12px var(--yellow-glow);
        }

        .brand-title {
            font-family: var(--font-display);
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #ffffff;
        }

        .brand-title span {
            color: var(--yellow-accent);
        }

        h1 {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #ffffff;
            margin-bottom: 6px;
        }

        p.desc {
            font-size: 13.5px;
            color: var(--text-secondary);
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 7px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            background: var(--surface-input);
            border: 1px solid var(--border-subtle);
            border-radius: 8px;
            padding: 11px 14px;
            color: #ffffff;
            font-size: 14px;
            font-family: var(--font-sans);
            outline: none;
            transition: all 0.15s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: var(--yellow-accent);
            box-shadow: 0 0 0 3px var(--yellow-glow);
            background: #252b36;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--text-secondary);
            margin: 16px 0 24px;
            cursor: pointer;
        }

        .remember-row input[type="checkbox"] {
            accent-color: var(--yellow-accent);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: var(--yellow-accent);
            color: #0d0f12;
            border: 1px solid #eab308;
            border-radius: 8px;
            font-family: var(--font-sans);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s ease;
            box-shadow: 0 2px 10px var(--yellow-glow);
        }

        .btn-submit:hover {
            background: #eab308;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(250, 204, 21, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .error-banner {
            padding: 10px 14px;
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 8px;
            color: #fca5a5;
            font-size: 13px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <form class="login-card" method="post" action="{{ route('login.store') }}">
        @csrf
        <div class="brand-header">
            <div class="brand-mark"></div>
            <div class="brand-title">Member<span>Flow</span></div>
        </div>

        <h1>Administrator sign in</h1>
        <p class="desc">Enter your credentials to access the management portal</p>

        @error('email')
            <div class="error-banner">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus placeholder="admin@example.com">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required placeholder="••••••••">
        </div>

        <label class="remember-row">
            <input type="checkbox" name="remember">
            <span>Keep me signed in</span>
        </label>

        <button type="submit" class="btn-submit">Sign in</button>
    </form>
</body>
</html>
