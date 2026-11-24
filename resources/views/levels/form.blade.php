@extends('layouts.app')

@section('content')
<div class="head">
    <div>
        <h1>{{ $level->exists ? 'Edit Membership Level' : 'Add Membership Level' }}</h1>
        <p class="muted">{{ $level->exists ? 'Update pricing tiers and privileges' : 'Create a new tier with defined fees and validity period' }}</p>
    </div>
    <div>
        <a href="{{ route('levels.index') }}" class="btn secondary">&larr; Back to levels</a>
    </div>
</div>

<form class="card" method="post" action="{{ $level->exists ? route('levels.update', $level) : route('levels.store') }}">
    @csrf
    @if($level->exists)
        @method('PUT')
    @endif

    <div class="grid">
        <div>
            <label for="name">Tier Name *</label>
            <input id="name" type="text" name="name" value="{{ old('name', $level->name) }}" required placeholder="e.g. Silver, Gold, Platinum">
        </div>
        <div>
            <label for="fee">Membership Fee (PHP) *</label>
            <input id="fee" type="number" step=".01" name="fee" value="{{ old('fee', $level->fee) }}" required placeholder="0.00">
        </div>
        <div>
            <label for="validity_months">Validity (Months) *</label>
            <input id="validity_months" type="number" name="validity_months" value="{{ old('validity_months', $level->validity_months ?? 12) }}" required placeholder="12">
        </div>
    </div>

    <div>
        <label for="benefits">Benefits &amp; Privileges</label>
        <textarea id="benefits" name="benefits" placeholder="List the perks, facilities, or discounts included in this tier">{{ old('benefits', $level->benefits) }}</textarea>
    </div>

    <div style="margin-top: 4px; margin-bottom: 20px;">
        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-weight: 500;">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $level->is_active ?? true)) style="width: 16px; height: 16px; margin: 0; accent-color: var(--yellow-primary);">
            <span>Active level (available for registration and renewal)</span>
        </label>
    </div>

    <div style="display: flex; gap: 12px; align-items: center; padding-top: 18px; border-top: 1px solid var(--border-subtle);">
        <button class="btn" type="submit">{{ $level->exists ? 'Update Level' : 'Save Level' }}</button>
        <a href="{{ route('levels.index') }}" class="btn secondary">Cancel</a>
    </div>
</form>
@endsection
