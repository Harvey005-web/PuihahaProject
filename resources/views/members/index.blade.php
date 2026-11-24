@extends('layouts.app')

@section('content')
<div class="head">
    <div>
        <h1>Members</h1>
        <p class="muted">Manage member directory, subscriptions, and profile credentials</p>
    </div>
    <div>
        <a class="btn" href="{{ route('members.create') }}">
            <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Register member
        </a>
    </div>
</div>

<form class="card" method="get" style="padding: 16px 20px; margin-bottom: 24px;">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)) auto; gap: 12px; align-items: center;">
        <div>
            <input type="text" name="search" placeholder="Search by name, email, or member #" value="{{ request('search') }}" style="margin-bottom: 0;">
        </div>
        <div>
            <select name="category" style="margin-bottom: 0;">
                <option value="">All categories</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" @selected(request('category') == $c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <select name="level" style="margin-bottom: 0;">
                <option value="">All levels</option>
                @foreach($levels as $l)
                    <option value="{{ $l->id }}" @selected(request('level') == $l->id)>{{ $l->name }}</option>
                @endforeach
            </select>
        </div>
        <div style="display: flex; gap: 8px;">
            <button class="btn" type="submit" style="padding: 9px 18px;">
                <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
                Filter
            </button>
            @if(request()->hasAny(['search', 'category', 'level']))
                <a href="{{ route('members.index') }}" class="btn secondary" style="padding: 9px 14px;">Reset</a>
            @endif
        </div>
    </div>
</form>

<table>
    <thead>
        <tr>
            <th>Member ID</th>
            <th>Name & Contact</th>
            <th>Category / Tier</th>
            <th>Status</th>
            <th style="text-align: right;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($members as $m)
            <tr>
                <td>
                    <span style="font-family: monospace; font-size: 12px; font-weight: 600; background: var(--silver-100); padding: 3px 8px; border-radius: 4px; border: 1px solid var(--silver-200); color: var(--gray-800);">
                        {{ $m->membership_number }}
                    </span>
                </td>
                <td>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--silver-100); border: 1px solid var(--silver-200); color: var(--gray-700); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 12px;">
                            {{ strtoupper(substr($m->first_name, 0, 1) . substr($m->last_name, 0, 1)) }}
                        </div>
                        <div>
                            <div style="font-weight: 600; color: var(--text-primary);">{{ $m->name }}</div>
                            <div style="font-size: 12.5px; color: var(--text-muted);">{{ $m->email }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <span style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; color: var(--text-secondary);">
                        <span style="font-weight: 500;">{{ $m->category->name }}</span>
                        <span style="color: var(--silver-400);">/</span>
                        <span style="color: var(--text-muted);">{{ $m->level->name }}</span>
                    </span>
                </td>
                <td>
                    @if($m->status === 'Active')
                        <span class="badge" style="background: var(--yellow-subtle); color: var(--yellow-text); border-color: var(--yellow-border);">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: var(--yellow-primary); display: inline-block;"></span>
                            {{ $m->status }}
                        </span>
                    @else
                        <span class="badge" style="background: var(--silver-100); color: var(--silver-500); border-color: var(--silver-200);">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: var(--silver-400); display: inline-block;"></span>
                            {{ $m->status }}
                        </span>
                    @endif
                </td>
                <td style="text-align: right;">
                    <a href="{{ route('members.show', $m) }}" style="display: inline-flex; align-items: center; gap: 4px; font-size: 13px; font-weight: 600; padding: 4px 10px; background: var(--silver-100); border: 1px solid var(--silver-200); border-radius: 4px; color: var(--text-primary); text-decoration: none;">
                        Profile &rarr;
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 48px 18px; color: var(--text-muted);">
                    <div style="font-size: 14px; font-weight: 500;">No members match your criteria</div>
                    <div style="font-size: 13px; margin-top: 4px; color: var(--text-light);">Try adjusting your search query or filters.</div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top: 20px;">
    {{ $members->links() }}
</div>
@endsection
