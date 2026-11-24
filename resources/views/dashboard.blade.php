@extends('layouts.app')

@section('content')
<div class="head">
    <div>
        <h1>Dashboard</h1>
        <p class="muted">Overview of membership operations, activity, and collections</p>
    </div>
    <div style="display: flex; gap: 10px;">
        <a class="btn" href="{{ route('members.create') }}">
            <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Register member
        </a>
    </div>
</div>

<div class="grid">
    <div class="stat">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span>Total members</span>
            <span style="display: inline-flex; padding: 4px 8px; background: var(--silver-100); border: 1px solid var(--silver-200); border-radius: 4px; font-size: 11px; font-weight: 600; color: var(--silver-500);">All</span>
        </div>
        <b>{{ number_format($members) }}</b>
    </div>

    <div class="stat">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span>Active members</span>
            <span style="display: inline-flex; width: 8px; height: 8px; background: var(--yellow-primary); border-radius: 50%; box-shadow: 0 0 6px rgba(234, 179, 8, 0.6); margin-top: 4px;"></span>
        </div>
        <b>{{ number_format($active) }}</b>
    </div>

    <div class="stat">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span>Pending transactions</span>
            <span style="display: inline-flex; padding: 2px 7px; background: var(--yellow-subtle); border: 1px solid var(--yellow-border); border-radius: 4px; font-size: 11px; font-weight: 600; color: var(--yellow-text);">Review</span>
        </div>
        <b>{{ number_format($pending) }}</b>
    </div>

    <div class="stat">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span>Collected payments</span>
            <span style="display: inline-flex; padding: 4px 8px; background: var(--silver-100); border: 1px solid var(--silver-200); border-radius: 4px; font-size: 11px; font-weight: 600; color: var(--silver-500);">PHP</span>
        </div>
        <b>₱{{ number_format($collections, 2) }}</b>
    </div>
</div>

<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 36px; margin-bottom: 14px;">
    <h2>Recent transactions</h2>
    <a href="{{ route('transactions.index') }}" style="font-size: 13px; font-weight: 600; color: var(--text-secondary); text-decoration: none;">View all transactions &rarr;</a>
</div>

<table>
    <thead>
        <tr>
            <th>Reference</th>
            <th>Member</th>
            <th>Type</th>
            <th>Status</th>
            <th style="text-align: right;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($recent as $t)
            <tr>
                <td>
                    <span style="font-family: monospace; font-size: 12.5px; font-weight: 600; background: var(--silver-100); padding: 3px 8px; border-radius: 4px; border: 1px solid var(--silver-200); color: var(--gray-800);">
                        {{ $t->reference_number }}
                    </span>
                </td>
                <td>
                    <div style="font-weight: 600; color: var(--text-primary);">{{ $t->member->name }}</div>
                </td>
                <td>
                    <span style="color: var(--text-secondary); font-size: 13px;">{{ $t->type }}</span>
                </td>
                <td>
                    @if($t->status === 'Approved' || $t->status === 'Paid')
                        <span class="badge" style="background: var(--yellow-subtle); color: var(--yellow-text); border-color: var(--yellow-border);">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: var(--yellow-primary); display: inline-block;"></span>
                            {{ $t->status }}
                        </span>
                    @elseif($t->status === 'Pending')
                        <span class="badge" style="background: #fffbeb; color: #b45309; border-color: #fde68a;">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: #f59e0b; display: inline-block;"></span>
                            {{ $t->status }}
                        </span>
                    @else
                        <span class="badge">{{ $t->status }}</span>
                    @endif
                </td>
                <td style="text-align: right;">
                    <a href="{{ route('transactions.show', $t) }}" style="display: inline-flex; align-items: center; gap: 4px; font-size: 13px; font-weight: 600; padding: 4px 10px; background: var(--silver-100); border: 1px solid var(--silver-200); border-radius: 4px; color: var(--text-primary); text-decoration: none;">
                        Details &rarr;
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 48px 18px; color: var(--text-muted);">
                    <div style="font-size: 14px; font-weight: 500;">No transactions recorded yet</div>
                    <div style="font-size: 13px; margin-top: 4px; color: var(--text-light);">Transactions created for memberships will appear here.</div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
