@extends('layouts.app')

@section('content')
<div class="head">
    <div>
        <h1>{{ $transaction->exists ? 'Edit Transaction' : 'Create New Transaction' }}</h1>
        <p class="muted">{{ $transaction->exists ? 'Update transaction details and status' : 'Generate an application or renewal bill for a member' }}</p>
    </div>
    <div>
        <a href="{{ route('transactions.index') }}" class="btn secondary">&larr; Back to transactions</a>
    </div>
</div>

<form class="card" method="post" action="{{ $transaction->exists ? route('transactions.update', $transaction) : route('transactions.store') }}">
    @csrf
    @if($transaction->exists)
        @method('PUT')
    @endif

    <div class="grid">
        <div>
            <label for="member_id">Member *</label>
            <select id="member_id" name="member_id">
                @foreach($members as $m)
                    <option value="{{ $m->id }}" @selected(old('member_id', $transaction->member_id) == $m->id)>
                        {{ $m->membership_number }} &mdash; {{ $m->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="membership_level_id">Membership Tier &amp; Fee *</label>
            <select id="membership_level_id" name="membership_level_id">
                @foreach($levels as $l)
                    <option value="{{ $l->id }}" @selected(old('membership_level_id', $transaction->membership_level_id) == $l->id)>
                        {{ $l->name }} &mdash; ₱{{ number_format($l->fee, 2) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="type">Transaction Type *</label>
            <select id="type" name="type">
                <option value="Application" @selected(old('type', $transaction->type) === 'Application')>Application</option>
                <option value="Renewal" @selected(old('type', $transaction->type) === 'Renewal')>Renewal</option>
            </select>
        </div>

        @if($transaction->exists)
            <div>
                <label for="status">Transaction Status *</label>
                <select id="status" name="status">
                    @foreach(['Pending', 'Paid', 'Approved', 'Expired', 'Cancelled'] as $s)
                        <option value="{{ $s }}" @selected($transaction->status === $s)>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
        @endif
    </div>

    <div>
        <label for="notes">Internal Remarks / Notes</label>
        <textarea id="notes" name="notes" placeholder="Optional audit or operational notes">{{ old('notes', $transaction->notes) }}</textarea>
    </div>

    @include('transactions.location')

    <div style="display: flex; gap: 12px; align-items: center; padding-top: 18px; border-top: 1px solid var(--border-subtle); margin-top: 16px;">
        <button class="btn" type="submit">{{ $transaction->exists ? 'Update Transaction' : 'Record Transaction' }}</button>
        <a href="{{ route('transactions.index') }}" class="btn secondary">Cancel</a>
    </div>
</form>
@endsection
