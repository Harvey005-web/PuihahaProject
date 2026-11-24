@extends('layouts.app')

@section('content')
<div class="head">
    <div style="display: flex; align-items: center; gap: 16px;">
        <div style="width: 48px; height: 48px; border-radius: 50%; background: var(--silver-100); border: 2px solid var(--border-medium); color: var(--gray-800); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 18px;">
            {{ strtoupper(substr($member->first_name, 0, 1) . substr($member->last_name, 0, 1)) }}
        </div>
        <div>
            <h1>{{ $member->name }}</h1>
            <p class="muted">
                <span style="font-family: monospace; font-weight: 600; color: var(--gray-800); background: var(--silver-100); padding: 2px 7px; border-radius: 4px; border: 1px solid var(--silver-200);">
                    {{ $member->membership_number }}
                </span>
                &middot; Joined {{ optional($member->joined_at)->format('M d, Y') ?? 'Recently' }}
            </p>
        </div>
    </div>
    <div style="display: flex; gap: 8px;">
        <a class="btn secondary" href="{{ route('members.edit', $member) }}">Edit Profile</a>
        <a class="btn secondary" href="{{ route('members.history', $member) }}">History</a>
        @if($member->status === 'Active')
            <form class="inline" method="post" action="{{ route('members.deactivate', $member) }}" onsubmit="return confirm('Are you sure you want to deactivate this membership?');">
                @csrf
                @method('PATCH')
                <button class="btn danger" type="submit">Deactivate</button>
            </form>
        @endif
    </div>
</div>

<div class="card">
    <div class="grid">
        <div>
            <div style="font-size: 11.5px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.04em; color: var(--text-muted); margin-bottom: 4px;">Tier & Category</div>
            <div style="font-size: 15px; font-weight: 600; color: var(--text-primary);">
                {{ $member->category->name }} &middot; {{ $member->level->name }}
            </div>
        </div>

        <div>
            <div style="font-size: 11.5px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.04em; color: var(--text-muted); margin-bottom: 4px;">Benefits</div>
            <div style="font-size: 14px; color: var(--text-secondary);">
                {{ $member->level->benefits ?: 'Standard member privileges.' }}
            </div>
        </div>

        <div>
            <div style="font-size: 11.5px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.04em; color: var(--text-muted); margin-bottom: 4px;">Status</div>
            <div>
                @if($member->status === 'Active')
                    <span class="badge" style="background: var(--yellow-subtle); color: var(--yellow-text); border-color: var(--yellow-border);">
                        <span style="width: 6px; height: 6px; border-radius: 50%; background: var(--yellow-primary); display: inline-block;"></span>
                        {{ $member->status }}
                    </span>
                @else
                    <span class="badge">{{ $member->status }}</span>
                @endif
            </div>
        </div>

        <div>
            <div style="font-size: 11.5px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.04em; color: var(--text-muted); margin-bottom: 4px;">Expires At</div>
            <div style="font-size: 14px; font-weight: 600; color: var(--text-primary);">
                {{ optional($member->expires_at)->format('M d, Y') ?? '—' }}
            </div>
        </div>

        <div>
            <div style="font-size: 11.5px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.04em; color: var(--text-muted); margin-bottom: 4px;">Contact Details</div>
            <div style="font-size: 13.5px; color: var(--text-primary);">
                <div>{{ $member->email }}</div>
                <div style="color: var(--text-muted);">{{ $member->phone ?: 'No phone provided' }}</div>
            </div>
        </div>

        <div>
            <div style="font-size: 11.5px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.04em; color: var(--text-muted); margin-bottom: 4px;">Mailing Address</div>
            <div style="font-size: 13.5px; color: var(--text-secondary);">
                {{ $member->address ?: 'No address specified' }}
            </div>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div style="font-size: 15px; font-weight: 700; color: var(--text-primary);">Email Verification Status</div>
            <p class="muted">Confirm that the member's primary email address is verified</p>
        </div>
        <div>
            @if($member->email_verified_at)
                <span class="badge" style="background: #f0fdf4; color: #166534; border-color: #bbf7d0; padding: 6px 12px;">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Verified on {{ $member->email_verified_at->format('M d, Y h:i A') }}
                </span>
            @else
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span class="badge" style="background: var(--silver-100); color: var(--silver-500); border-color: var(--silver-200); padding: 6px 12px;">
                        Unverified
                    </span>
                    <form method="post" action="{{ route('members.verification.resend', $member) }}" class="inline">
                        @csrf
                        <button class="btn" type="submit" style="padding: 6px 12px; font-size: 12.5px;">
                            Send verification email
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 36px; margin-bottom: 14px;">
    <h2>Transactions for {{ $member->first_name }}</h2>
    <a href="{{ route('members.history', $member) }}" style="font-size: 13px; font-weight: 600; color: var(--text-secondary);">Full transaction history &rarr;</a>
</div>

<table>
    <thead>
        <tr>
            <th>Reference</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Status</th>
            <th style="text-align: right;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($member->transactions as $t)
            <tr>
                <td>
                    <span style="font-family: monospace; font-size: 12px; font-weight: 600; background: var(--silver-100); padding: 3px 8px; border-radius: 4px; border: 1px solid var(--silver-200); color: var(--gray-800);">
                        {{ $t->reference_number }}
                    </span>
                </td>
                <td>{{ $t->type }}</td>
                <td style="font-weight: 600;">₱{{ number_format($t->amount, 2) }}</td>
                <td>
                    @if($t->status === 'Paid' || $t->status === 'Approved')
                        <span class="badge" style="background: var(--yellow-subtle); color: var(--yellow-text); border-color: var(--yellow-border);">
                            {{ $t->status }}
                        </span>
                    @else
                        <span class="badge">{{ $t->status }}</span>
                    @endif
                </td>
                <td style="text-align: right;">
                    <a href="{{ route('transactions.show', $t) }}" style="display: inline-flex; align-items: center; gap: 4px; font-size: 13px; font-weight: 600; padding: 4px 10px; background: var(--silver-100); border: 1px solid var(--silver-200); border-radius: 4px; color: var(--text-primary); text-decoration: none;">
                        View &rarr;
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 36px 18px; color: var(--text-muted);">
                    No transactions found for this member.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
