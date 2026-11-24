@extends('layouts.app')

@section('content')
<div class="head">
    <div>
        <h1>Record Payment</h1>
        <p class="muted">Log incoming payment remittance against an existing transaction</p>
    </div>
    <div>
        <a href="{{ route('payments.index') }}" class="btn secondary">&larr; Back to payments</a>
    </div>
</div>

<form class="card" method="post" action="{{ route('payments.store') }}">
    @csrf

    <div>
        <label for="membership_transaction_id">Associated Transaction *</label>
        <select id="membership_transaction_id" name="membership_transaction_id">
            @foreach($transactions as $t)
                <option value="{{ $t->id }}" @selected(old('membership_transaction_id', $selected) == $t->id)>
                    {{ $t->reference_number }} &mdash; {{ $t->member->name }} (Due: ₱{{ number_format($t->amount, 2) }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="grid">
        <div>
            <label for="amount">Payment Amount (PHP) *</label>
            <input id="amount" type="number" step=".01" name="amount" value="{{ old('amount') }}" required placeholder="0.00">
        </div>

        <div>
            <label for="payment_method">Payment Method *</label>
            <select id="payment_method" name="payment_method">
                <option value="Cash" @selected(old('payment_method') === 'Cash')>Cash</option>
                <option value="Bank Transfer" @selected(old('payment_method') === 'Bank Transfer')>Bank Transfer</option>
                <option value="Card" @selected(old('payment_method') === 'Card')>Credit / Debit Card</option>
                <option value="E-wallet" @selected(old('payment_method') === 'E-wallet')>E-Wallet (GCash / Maya)</option>
            </select>
        </div>

        <div>
            <label for="paid_at">Payment Timestamp *</label>
            <input id="paid_at" type="datetime-local" name="paid_at" value="{{ old('paid_at', $payment->paid_at->format('Y-m-d\\TH:i')) }}" required>
        </div>
    </div>

    <div>
        <label for="notes">Payment Remarks / Reference Code</label>
        <textarea id="notes" name="notes" placeholder="e.g. Bank slip reference, check number, or cashier note">{{ old('notes') }}</textarea>
    </div>

    <div style="display: flex; gap: 12px; align-items: center; padding-top: 18px; border-top: 1px solid var(--border-subtle); margin-top: 16px;">
        <button class="btn" type="submit">Submit &amp; Generate Receipt</button>
        <a href="{{ route('payments.index') }}" class="btn secondary">Cancel</a>
    </div>
</form>
@endsection
