@extends('layouts.app')
@section('content')
<div class="head"><div><h1>Change password</h1><p class="muted">Update the password for your administrator account.</p></div></div>
<form class="card" style="max-width:600px" method="post" action="{{ route('password.update') }}">
    @csrf
    @method('PUT')
    <label for="current_password">Current password</label>
    <input id="current_password" name="current_password" type="password" autocomplete="current-password" required autofocus>
    @error('current_password')<p role="alert">{{ $message }}</p>@enderror
    <label for="password">New password</label>
    <input id="password" name="password" type="password" autocomplete="new-password" minlength="12" maxlength="72" aria-describedby="password-help" required>
    <p id="password-help" class="muted">Use 12–72 characters with uppercase and lowercase letters, a number, and a symbol. Choose a different password from your current one.</p>
    @error('password')<p role="alert">{{ $message }}</p>@enderror
    <label for="password_confirmation">Confirm new password</label>
    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="12" maxlength="72" required>
    <button class="btn" type="submit">Change password</button>
    <a href="{{ route('dashboard') }}">Cancel</a>
</form>
@endsection
