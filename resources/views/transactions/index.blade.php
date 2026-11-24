@extends('layouts.app')

@section('content')
<div class="head">
    <div>
        <h1>Transactions</h1>
        <p class="muted">Track applications, renewals, and financial transaction lifecycles</p>
    </div>
    <div>
        <a class="btn" href="{{ route('transactions.create') }}">
            <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Create transaction
        </a>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>Reference Number</th>
            <th>Member</th>
            <th>Type</th>
            <th>Amount Due</th>
            <th>Status</th>
            <th style="text-align: right;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($transactions as $t)
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
                    <span style="color: var(--text-secondary); font-size: 13.5px;">{{ $t->type }}</span>
                </td>
                <td>
                    <span style="font-weight: 700; color: var(--text-primary);">₱{{ number_format($t->amount, 2) }}</span>
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
                <td colspan="6" style="text-align: center; padding: 48px 18px; color: var(--text-muted);">
                    No transactions recorded yet.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top: 20px;">
    {{ $transactions->links() }}
</div>
@endsection
