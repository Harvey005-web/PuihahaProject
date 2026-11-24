@extends('layouts.app')

@section('content')
<div class="head">
    <div>
        <h1>Payments Ledger</h1>
        <p class="muted">All verified receipt entries, payment methods, and revenue collections</p>
    </div>
    <div>
        <a class="btn" href="{{ route('payments.create') }}">
            <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Record payment
        </a>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>Receipt #</th>
            <th>Transaction Reference</th>
            <th>Member Name</th>
            <th>Payment Method</th>
            <th>Amount Paid</th>
            <th>Date Paid</th>
            <th style="text-align: right;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($payments as $p)
            <tr>
                <td>
                    <span style="font-family: monospace; font-size: 12px; font-weight: 600; background: var(--silver-100); padding: 3px 8px; border-radius: 4px; border: 1px solid var(--silver-200); color: var(--gray-800);">
                        {{ $p->receipt_number }}
                    </span>
                </td>
                <td>
                    <span style="font-family: monospace; font-size: 12px; color: var(--text-muted);">
                        {{ $p->transaction->reference_number }}
                    </span>
                </td>
                <td>
                    <div style="font-weight: 600; color: var(--text-primary);">{{ $p->transaction->member->name }}</div>
                </td>
                <td>
                    <span style="background: var(--silver-100); border: 1px solid var(--silver-200); padding: 2px 8px; border-radius: 4px; font-size: 12.5px; font-weight: 500;">
                        {{ $p->payment_method }}
                    </span>
                </td>
                <td>
                    <span style="font-weight: 700; color: var(--text-primary);">₱{{ number_format($p->amount, 2) }}</span>
                </td>
                <td style="color: var(--text-secondary); font-size: 13px;">
                    {{ $p->paid_at->format('M d, Y') }}
                </td>
                <td style="text-align: right;">
                    <a href="{{ route('payments.show', $p) }}" style="display: inline-flex; align-items: center; gap: 4px; font-size: 13px; font-weight: 600; padding: 4px 10px; background: var(--silver-100); border: 1px solid var(--silver-200); border-radius: 4px; color: var(--text-primary); text-decoration: none;">
                        Receipt &rarr;
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 48px 18px; color: var(--text-muted);">
                    No payment records entered yet.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top: 20px;">
    {{ $payments->links() }}
</div>
@endsection
