@extends('layouts.app')

@section('content')
<div class="head">
    <div>
        <div style="display: flex; align-items: center; gap: 10px;">
            <span style="font-family: monospace; font-size: 14px; font-weight: 700; background: var(--silver-100); padding: 4px 10px; border-radius: 4px; border: 1px solid var(--silver-200); color: var(--gray-800);">
                {{ $transaction->reference_number }}
            </span>
            <h1>Transaction Overview</h1>
        </div>
        <p class="muted">{{ $transaction->type }} for <strong>{{ $transaction->member->name }}</strong> ({{ $transaction->member->membership_number }})</p>
    </div>
    <div style="display: flex; gap: 8px;">
        <a class="btn secondary" href="{{ route('transactions.edit', $transaction) }}">Edit</a>
        <a class="btn" href="{{ route('payments.create', ['transaction' => $transaction->id]) }}">
            <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Record payment
        </a>
    </div>
</div>

<div class="card">
    <div class="grid">
        <div>
            <div style="font-size: 11.5px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.04em; color: var(--text-muted); margin-bottom: 4px;">Total Amount Due</div>
            <div style="font-family: var(--font-display); font-size: 26px; font-weight: 700; color: var(--text-primary);">
                ₱{{ number_format($transaction->amount, 2) }}
            </div>
        </div>

        <div>
            <div style="font-size: 11.5px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.04em; color: var(--text-muted); margin-bottom: 4px;">Total Collected</div>
            <div style="font-family: var(--font-display); font-size: 26px; font-weight: 700; color: var(--yellow-text);">
                ₱{{ number_format($transaction->payments->sum('amount'), 2) }}
            </div>
        </div>

        <div>
            <div style="font-size: 11.5px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.04em; color: var(--text-muted); margin-bottom: 4px;">Status</div>
            <div style="margin-top: 4px;">
                @if($transaction->status === 'Approved' || $transaction->status === 'Paid')
                    <span class="badge" style="background: var(--yellow-subtle); color: var(--yellow-text); border-color: var(--yellow-border);">
                        <span style="width: 6px; height: 6px; border-radius: 50%; background: var(--yellow-primary); display: inline-block;"></span>
                        {{ $transaction->status }}
                    </span>
                @else
                    <span class="badge">{{ $transaction->status }}</span>
                @endif
            </div>
        </div>

        <div>
            <div style="font-size: 11.5px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.04em; color: var(--text-muted); margin-bottom: 4px;">Tier &amp; Level</div>
            <div style="font-size: 15px; font-weight: 600; color: var(--text-primary); margin-top: 2px;">
                {{ $transaction->level->name }}
            </div>
        </div>
    </div>

    @if($transaction->status === 'Paid')
        <div style="margin-top: 20px; padding-top: 18px; border-top: 1px solid var(--border-subtle); display: flex; align-items: center; justify-content: space-between;">
            <div>
                <strong style="color: var(--text-primary);">Payment Completed:</strong>
                <span style="color: var(--text-secondary); font-size: 13.5px;">All dues for this transaction have been settled.</span>
            </div>
            <form method="post" action="{{ route('transactions.approve', $transaction) }}" class="inline">
                @csrf
                @method('PATCH')
                <button class="btn" type="submit">
                    <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Approve Membership Transaction
                </button>
            </form>
        </div>
    @endif
</div>

<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 36px; margin-bottom: 14px;">
    <h2>Payment Records</h2>
    <a href="{{ route('transactions.receipt', $transaction) }}" target="_blank" style="font-size: 13px; font-weight: 600; color: var(--text-secondary);">
        Print Official Record &rarr;
    </a>
</div>

<table>
    <thead>
        <tr>
            <th>Receipt Number</th>
            <th>Date Paid</th>
            <th>Payment Method</th>
            <th>Amount</th>
            <th style="text-align: right;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($transaction->payments as $p)
            <tr>
                <td>
                    <span style="font-family: monospace; font-size: 12px; font-weight: 600; background: var(--silver-100); padding: 3px 8px; border-radius: 4px; border: 1px solid var(--silver-200); color: var(--gray-800);">
                        {{ $p->receipt_number }}
                    </span>
                </td>
                <td>{{ $p->paid_at->format('M d, Y h:i A') }}</td>
                <td>
                    <span style="background: var(--silver-100); border: 1px solid var(--silver-200); padding: 2px 8px; border-radius: 4px; font-size: 12.5px; font-weight: 500;">
                        {{ $p->payment_method }}
                    </span>
                </td>
                <td style="font-weight: 700; color: var(--text-primary);">₱{{ number_format($p->amount, 2) }}</td>
                <td style="text-align: right;">
                    <a href="{{ route('payments.show', $p) }}" style="display: inline-flex; align-items: center; gap: 4px; font-size: 13px; font-weight: 600; padding: 4px 10px; background: var(--silver-100); border: 1px solid var(--silver-200); border-radius: 4px; color: var(--text-primary); text-decoration: none;">
                        Receipt &rarr;
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 36px 18px; color: var(--text-muted);">
                    No payments have been recorded for this transaction yet.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
