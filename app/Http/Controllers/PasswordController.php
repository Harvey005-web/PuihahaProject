<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => ['required', 'string', 'confirmed', 'different:current_password', 'max:72', Password::min(12)->mixedCase()->numbers()->symbols()],
        ]);

        DB::transaction(function () use ($request, $data) {
            $request->user()->forceFill([
                'password' => Hash::make($data['password']),
                'remember_token' => Str::random(60),
            ])->save();
            if (config('session.driver') === 'database') {
                DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                    ->where('user_id', $request->user()->id)
                    ->where('id', '!=', $request->session()->getId())->delete();
            }
        });
        $request->session()->regenerate();
        $request->session()->regenerateToken();

        return redirect()->route('password.edit')->with('success', 'Password changed successfully. Other saved sessions have been signed out.');
    }
}
