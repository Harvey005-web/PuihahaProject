@extends('layouts.app')

@section('content')
<div class="head">
    <div>
        <h1>Membership Categories</h1>
        <p class="muted">Organize and segment membership types across your organization</p>
    </div>
    <div>
        <a class="btn" href="{{ route('categories.create') }}">
            <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add category
        </a>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>Category Name</th>
            <th>Description</th>
            <th>Active Members</th>
            <th>Status</th>
            <th style="text-align: right;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $c)
            <tr>
                <td>
                    <span style="font-weight: 600; color: var(--text-primary);">{{ $c->name }}</span>
                </td>
                <td style="color: var(--text-secondary); max-width: 320px;">
                    {{ $c->description ?: 'No description provided' }}
                </td>
                <td>
                    <span style="font-weight: 600; background: var(--silver-100); padding: 3px 9px; border-radius: 4px; border: 1px solid var(--silver-200); font-size: 13px;">
                        {{ $c->members_count }} {{ Str::plural('member', $c->members_count) }}
                    </span>
                </td>
                <td>
                    @if($c->is_active)
                        <span class="badge" style="background: var(--yellow-subtle); color: var(--yellow-text); border-color: var(--yellow-border);">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: var(--yellow-primary); display: inline-block;"></span>
                            Active
                        </span>
                    @else
                        <span class="badge">Inactive</span>
                    @endif
                </td>
                <td style="text-align: right;">
                    <a href="{{ route('categories.edit', $c) }}" style="display: inline-flex; align-items: center; gap: 4px; font-size: 13px; font-weight: 600; padding: 4px 10px; background: var(--silver-100); border: 1px solid var(--silver-200); border-radius: 4px; color: var(--text-primary); text-decoration: none;">
                        Edit &rarr;
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 48px 18px; color: var(--text-muted);">
                    No categories found. Click &ldquo;Add category&rdquo; to create your first one.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top: 20px;">
    {{ $categories->links() }}
</div>
@endsection
