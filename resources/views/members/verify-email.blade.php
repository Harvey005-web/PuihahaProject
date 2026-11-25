<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="no-referrer">
    <title>Verify Email &mdash; MemberFlow</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #f4f5f7;
            --surface-card: #ffffff;
            --border-subtle: #e2e8f0;
            --yellow-accent: #facc15;
            --yellow-primary: #eab308;
            --text-primary: #0f172a;
            --text-secondary: #475569;
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
            color: var(--text-primary);
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .verify-card {
            max-width: 460px;
            width: 100%;
            background: var(--surface-card);
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            padding: 36px 32px;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.06);
            text-align: center;
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 20px;
            color: #0f172a;
            margin-bottom: 24px;
        }

        .brand-badge {
            width: 10px;
            height: 10px;
            background: var(--yellow-primary);
            border-radius: 2px;
            transform: rotate(45deg);
        }

        .status-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .status-icon.success {
            background: #f0fdf4;
            color: #16a34a;
            border: 2px solid #bbf7d0;
        }

        .status-icon.pending {
            background: #fefce8;
            color: #ca8a04;
            border: 2px solid #fef08a;
        }

        h2 {
            font-family: var(--font-display);
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        p {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px;
            background: var(--yellow-accent);
            color: #0f172a;
            border: 1px solid #eab308;
            border-radius: 8px;
            font-family: var(--font-sans);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s ease;
        }

        .btn:hover {
            background: var(--yellow-primary);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <main class="verify-card">
        <div class="brand-logo">
            <span class="brand-badge"></span>
            <span>Member<span style="color: #ca8a04;">Flow</span></span>
        </div>

        @if($confirmed)
            <div class="status-icon success">
                <svg width="28" height="28" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <h2>Email verified successfully</h2>
            <p>Your membership email address has been confirmed and updated in MemberFlow. You can now safely close this window.</p>
        @else
            <div class="status-icon pending">
                <svg width="28" height="28" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
            </div>
            <h2>Verify your email address</h2>
            <p>Please confirm below to complete the verification of this email for your membership record.</p>
            <form method="post" action="{{ request()->getRequestUri() }}">
                @csrf
                <button type="submit" class="btn">Confirm Email Verification</button>
            </form>
        @endif
    </main>
</body>
</html>
