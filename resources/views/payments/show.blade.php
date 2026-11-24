@extends('layouts.app')

@section('content')
<div class="head">
    <div>
        <div style="display: flex; align-items: center; gap: 10px;">
            <span style="font-family: monospace; font-size: 14px; font-weight: 700; background: var(--silver-100); padding: 4px 10px; border-radius: 4px; border: 1px solid var(--silver-200); color: var(--gray-800);">
                {{ $payment->receipt_number }}
            </span>
            <h1>Payment Receipt Details</h1>
        </div>
        <p class="muted">Recorded on {{ $payment->paid_at->format('F d, Y \a\t h:i A') }}</p>
    </div>
    <div style="display: flex; gap: 8px;">
        <a class="btn secondary" href="{{ route('payments.index') }}">&larr; Payments</a>
        <a class="btn" href="{{ route('transactions.receipt', $payment->transaction) }}" target="_blank">
            <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
            </svg>
            Printable record
        </a>
    </div>
</div>

<div class="card" style="max-width: 680px;">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; padding-bottom: 20px; border-bottom: 1px solid var(--border-subtle); margin-bottom: 20px;">
        <div>
            <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">Amount Paid</div>
            <div style="font-family: var(--font-display); font-size: 32px; font-weight: 800; color: var(--text-primary); margin-top: 4px;">
                ₱{{ number_format($payment->amount, 2) }}
            </div>
        </div>
        <span class="badge" style="background: var(--yellow-subtle); color: var(--yellow-text); border-color: var(--yellow-border); padding: 6px 14px; font-size: 13px;">
            <span style="width: 6px; height: 6px; border-radius: 50%; background: var(--yellow-primary); display: inline-block;"></span>
            Confirmed
        </span>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px 24px;">
        <div>
            <div style="font-size: 11.5px; font-weight: 700; text-transform: uppercase; color: var(--text-muted); margin-bottom: 3px;">Member Name</div>
            <div style="font-size: 14.5px; font-weight: 600; color: var(--text-primary);">
                <a href="{{ route('members.show', $payment->transaction->member) }}" style="color: var(--text-primary); border-bottom: 1px dashed var(--silver-400);">
                    {{ $payment->transaction->member->name }}
                </a>
            </div>
            <div style="font-size: 12px; color: var(--text-muted); margin-top: 2px;">
                Member #: {{ $payment->transaction->member->membership_number }}
            </div>
        </div>

        <div>
            <div style="font-size: 11.5px; font-weight: 700; text-transform: uppercase; color: var(--text-muted); margin-bottom: 3px;">Linked Transaction</div>
            <div style="font-size: 14.5px; font-weight: 600;">
                <a href="{{ route('transactions.show', $payment->transaction) }}" style="color: var(--text-primary); border-bottom: 1px dashed var(--silver-400);">
                    {{ $payment->transaction->reference_number }}
                </a>
            </div>
            <div style="font-size: 12px; color: var(--text-muted); margin-top: 2px;">
                Type: {{ $payment->transaction->type }}
            </div>
        </div>

        <div>
            <div style="font-size: 11.5px; font-weight: 700; text-transform: uppercase; color: var(--text-muted); margin-bottom: 3px;">Payment Method</div>
            <div style="font-size: 14px; color: var(--text-primary); font-weight: 500;">
                {{ $payment->payment_method }}
            </div>
        </div>

        <div>
            <div style="font-size: 11.5px; font-weight: 700; text-transform: uppercase; color: var(--text-muted); margin-bottom: 3px;">Cashier / Receiver</div>
            <div style="font-size: 14px; color: var(--text-primary);">
                {{ $payment->received_by ?: 'System Admin' }}
            </div>
        </div>
    </div>

    @if($payment->notes)
        <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid var(--border-subtle);">
            <div style="font-size: 11.5px; font-weight: 700; text-transform: uppercase; color: var(--text-muted); margin-bottom: 4px;">Payment Notes</div>
            <div style="font-size: 13.5px; color: var(--text-secondary); background: var(--silver-50); padding: 10px 14px; border-radius: 6px; border: 1px solid var(--border-subtle);">
                {{ $payment->notes }}
            </div>
        </div>
    @endif
</div>
@endsection
