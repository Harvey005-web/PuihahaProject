<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receipt &mdash; {{ $transaction->reference_number }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-page: #f8fafc;
            --surface-sheet: #ffffff;
            --silver-border: #e2e8f0;
            --silver-dark: #64748b;
            --charcoal: #0f172a;
            --yellow-accent: #eab308;
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
            background: var(--bg-page);
            color: var(--charcoal);
            padding: 40px 20px;
            font-size: 14px;
            line-height: 1.5;
        }

        .sheet {
            max-width: 680px;
            margin: 0 auto;
            background: var(--surface-sheet);
            border: 1px solid var(--silver-border);
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
            position: relative;
        }

        .sheet::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--yellow-accent);
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .print-bar {
            max-width: 680px;
            margin: 0 auto 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-print {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--charcoal);
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn-print:hover {
            background: #27272a;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 24px;
            border-bottom: 2px solid var(--silver-border);
            margin-bottom: 24px;
        }

        .brand-logo {
            font-family: var(--font-display);
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .brand-badge {
            width: 10px;
            height: 10px;
            background: var(--yellow-accent);
            border-radius: 2px;
            transform: rotate(45deg);
        }

        .title-doc {
            text-align: right;
        }

        .title-doc h2 {
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--charcoal);
        }

        .title-doc p {
            font-size: 12.5px;
            color: var(--silver-dark);
            margin-top: 2px;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            background: #f8fafc;
            border: 1px solid var(--silver-border);
            border-radius: 8px;
            padding: 18px;
            margin-bottom: 28px;
        }

        .meta-item label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--silver-dark);
            margin-bottom: 2px;
        }

        .meta-item span {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--charcoal);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        th {
            text-align: left;
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--silver-dark);
            border-bottom: 1px solid var(--silver-border);
            padding: 10px 12px;
            background: #f8fafc;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13.5px;
        }

        .summary-box {
            display: flex;
            justify-content: flex-end;
            padding-top: 14px;
            border-top: 2px solid var(--silver-border);
        }

        .summary-row {
            text-align: right;
        }

        .summary-row span {
            font-size: 13px;
            color: var(--silver-dark);
            display: block;
        }

        .summary-row strong {
            font-family: var(--font-display);
            font-size: 24px;
            font-weight: 700;
            color: var(--charcoal);
        }

        .footer-note {
            margin-top: 36px;
            padding-top: 16px;
            border-top: 1px dashed var(--silver-border);
            text-align: center;
            font-size: 12px;
            color: var(--silver-dark);
        }

        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }
            .print-bar {
                display: none;
            }
            .sheet {
                border: none;
                box-shadow: none;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="print-bar">
        <a href="javascript:window.close()" style="color: var(--silver-dark); text-decoration: none; font-size: 13px; font-weight: 500;">&larr; Close Window</a>
        <button class="btn-print" onclick="window.print()">
            <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
            </svg>
            Print Receipt
        </button>
    </div>

    <div class="sheet">
        <div class="header">
            <div class="brand-logo">
                <span class="brand-badge"></span>
                <span>Member<span style="color: var(--yellow-accent);">Flow</span></span>
            </div>
            <div class="title-doc">
                <h2>Official Receipt</h2>
                <p>Transaction #{{ $transaction->reference_number }}</p>
            </div>
        </div>

        <div class="meta-grid">
            <div class="meta-item">
                <label>Member Name</label>
                <span>{{ $transaction->member->name }}</span>
            </div>
            <div class="meta-item">
                <label>Member Number</label>
                <span>{{ $transaction->member->membership_number }}</span>
            </div>
            <div class="meta-item">
                <label>Membership Tier</label>
                <span>{{ $transaction->level->name }}</span>
            </div>
            <div class="meta-item">
                <label>Transaction Status</label>
                <span style="display: inline-flex; align-items: center; gap: 5px;">
                    <span style="width: 6px; height: 6px; border-radius: 50%; background: var(--yellow-accent);"></span>
                    {{ $transaction->status }}
                </span>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Receipt Code</th>
                    <th>Date Settled</th>
                    <th>Payment Method</th>
                    <th style="text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaction->payments as $p)
                    <tr>
                        <td><span style="font-family: monospace; font-weight: 600;">{{ $p->receipt_number }}</span></td>
                        <td>{{ $p->paid_at->format('M d, Y') }}</td>
                        <td>{{ $p->payment_method }}</td>
                        <td style="text-align: right; font-weight: 600;">₱{{ number_format($p->amount, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; color: var(--silver-dark); padding: 18px;">No payment remittance logged yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="summary-box">
            <div class="summary-row">
                <span>Total Amount Due</span>
                <strong>₱{{ number_format($transaction->amount, 2) }}</strong>
            </div>
        </div>

        <div class="footer-note">
            This is an electronically generated official transaction record issued by MemberFlow.
        </div>
    </div>
</body>
</html>
