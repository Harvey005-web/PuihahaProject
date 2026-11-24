@extends('layouts.app')

@section('content')
<div class="head">
    <div>
        <h1>{{ $member->exists ? 'Edit Member Profile' : 'Register New Member' }}</h1>
        <p class="muted">{{ $member->exists ? 'Update membership credentials and personal information' : 'Create an active membership profile in MemberFlow' }}</p>
    </div>
    <div>
        <a href="{{ route('members.index') }}" class="btn secondary">
            &larr; Back to members
        </a>
    </div>
</div>

<form class="card" method="post" action="{{ $member->exists ? route('members.update', $member) : route('members.store') }}">
    @csrf
    @if($member->exists)
        @method('PUT')
    @endif

    <div class="grid">
        <div>
            <label for="first_name">First Name *</label>
            <input id="first_name" type="text" name="first_name" value="{{ old('first_name', $member->first_name) }}" required placeholder="Jane">
        </div>
        <div>
            <label for="last_name">Last Name *</label>
            <input id="last_name" type="text" name="last_name" value="{{ old('last_name', $member->last_name) }}" required placeholder="Doe">
        </div>
        <div>
            <label for="email">Email Address *</label>
            <input id="email" type="email" name="email" value="{{ old('email', $member->email) }}" required placeholder="jane.doe@example.com">
        </div>
        <div>
            <label for="phone">Phone Number</label>
            <input id="phone" type="tel" name="phone" value="{{ old('phone', $member->phone) }}" placeholder="+63 900 000 0000">
        </div>
        <div>
            <label for="membership_category_id">Membership Category *</label>
            <select id="membership_category_id" name="membership_category_id">
                @foreach($categories as $x)
                    <option value="{{ $x->id }}" @selected(old('membership_category_id', $member->membership_category_id) == $x->id)>{{ $x->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="membership_level_id">Membership Tier / Level *</label>
            <select id="membership_level_id" name="membership_level_id">
                @foreach($levels as $x)
                    <option value="{{ $x->id }}" @selected(old('membership_level_id', $member->membership_level_id) == $x->id)>{{ $x->name }} (₱{{ number_format($x->fee, 2) }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="joined_at">Joined Date *</label>
            <input id="joined_at" type="date" name="joined_at" value="{{ old('joined_at', optional($member->joined_at)->format('Y-m-d') ?? date('Y-m-d')) }}" required>
        </div>
        <div>
            <label for="status">Membership Status *</label>
            <select id="status" name="status">
                <option value="Active" @selected(old('status', $member->status) === 'Active')>Active</option>
                <option value="Inactive" @selected(old('status', $member->status) === 'Inactive')>Inactive</option>
            </select>
        </div>
    </div>

    <div style="margin-top: 6px;">
        <label for="address">Mailing Address</label>
        <textarea id="address" name="address" placeholder="Unit, street, city, postal code">{{ old('address', $member->address) }}</textarea>
    </div>

    <div style="display: flex; gap: 12px; align-items: center; margin-top: 18px; padding-top: 18px; border-top: 1px solid var(--border-subtle);">
        <button class="btn" type="submit">
            {{ $member->exists ? 'Save Changes' : 'Complete Registration' }}
        </button>
        <a href="{{ route('members.index') }}" class="btn secondary">Cancel</a>
    </div>
</form>
@endsection
