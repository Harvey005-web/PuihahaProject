@extends('layouts.app')

@section('content')
<div class="head">
    <div>
        <h1>{{ $category->exists ? 'Edit Category' : 'Create Category' }}</h1>
        <p class="muted">{{ $category->exists ? 'Update classification rules and properties' : 'Define a new category to group members' }}</p>
    </div>
    <div>
        <a href="{{ route('categories.index') }}" class="btn secondary">&larr; Back to categories</a>
    </div>
</div>

<form class="card" method="post" action="{{ $category->exists ? route('categories.update', $category) : route('categories.store') }}" style="max-width: 640px;">
    @csrf
    @if($category->exists)
        @method('PUT')
    @endif

    <div>
        <label for="name">Category Name *</label>
        <input id="name" type="text" name="name" value="{{ old('name', $category->name) }}" required placeholder="e.g. Corporate, Individual, Student">
    </div>

    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Briefly describe the purpose of this membership category">{{ old('description', $category->description) }}</textarea>
    </div>

    <div style="margin-top: 4px; margin-bottom: 20px;">
        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-weight: 500;">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true)) style="width: 16px; height: 16px; margin: 0; accent-color: var(--yellow-primary);">
            <span>Active category (available for registration and assignment)</span>
        </label>
    </div>

    <div style="display: flex; gap: 12px; align-items: center; padding-top: 18px; border-top: 1px solid var(--border-subtle);">
        <button class="btn" type="submit">{{ $category->exists ? 'Update Category' : 'Create Category' }}</button>
        <a href="{{ route('categories.index') }}" class="btn secondary">Cancel</a>
    </div>
</form>
@endsection
