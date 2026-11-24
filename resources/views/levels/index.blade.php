@extends('layouts.app')

@section('content')
<div class="head">
    <div>
        <h1>Membership Levels &amp; Tiers</h1>
        <p class="muted">Configure pricing, billing validity, and benefits per tier</p>
    </div>
    <div>
        <a class="btn" href="{{ route('levels.create') }}">
            <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add level
        </a>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>Level Name</th>
            <th>Membership Fee</th>
            <th>Validity Period</th>
            <th>Included Benefits</th>
            <th style="text-align: right;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($levels as $l)
            <tr>
                <td>
                    <div style="font-weight: 600; color: var(--text-primary);">{{ $l->name }}</div>
                </td>
                <td>
                    <span style="font-weight: 700; color: var(--text-primary); background: var(--silver-100); padding: 3px 8px; border-radius: 4px; border: 1px solid var(--silver-200); font-size: 13px;">
                        ₱{{ number_format($l->fee, 2) }}
                    </span>
                </td>
                <td>
                    <span style="color: var(--text-secondary); font-size: 13.5px;">{{ $l->validity_months }} {{ Str::plural('month', $l->validity_months) }}</span>
                </td>
                <td style="color: var(--text-secondary); max-width: 300px;">
                    {{ $l->benefits ?: 'Standard access privileges' }}
                </td>
                <td style="text-align: right;">
                    <a href="{{ route('levels.edit', $l) }}" style="display: inline-flex; align-items: center; gap: 4px; font-size: 13px; font-weight: 600; padding: 4px 10px; background: var(--silver-100); border: 1px solid var(--silver-200); border-radius: 4px; color: var(--text-primary); text-decoration: none;">
                        Edit &rarr;
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 48px 18px; color: var(--text-muted);">
                    No membership levels configured yet.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top: 20px;">
    {{ $levels->links() }}
</div>
@endsection
