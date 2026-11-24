<?php
use App\Http\Controllers\{AuthController,CategoryController,DashboardController,LevelController,MemberController,PaymentController,TransactionController};
use Illuminate\Support\Facades\Route;
Route::redirect('/', '/dashboard');
Route::middleware('guest')->group(function () { Route::get('/login',[AuthController::class,'create'])->name('login'); Route::post('/login',[AuthController::class,'store'])->name('login.store'); });
Route::post('/logout',[AuthController::class,'destroy'])->middleware('auth')->name('logout');
Route::middleware('auth')->group(function () {
 Route::get('/account/password', [\App\Http\Controllers\PasswordController::class, 'edit'])->name('password.edit');
 Route::put('/account/password', [\App\Http\Controllers\PasswordController::class, 'update'])->middleware('throttle:5,1')->name('password.update');
 Route::get('/dashboard',DashboardController::class)->name('dashboard'); Route::resource('members',MemberController::class); Route::patch('members/{member}/deactivate',[MemberController::class,'deactivate'])->name('members.deactivate'); Route::get('members/{member}/history',[MemberController::class,'history'])->name('members.history');
 Route::resource('categories',CategoryController::class)->except('show'); Route::resource('levels',LevelController::class)->except('show'); Route::resource('transactions',TransactionController::class)->except('destroy'); Route::patch('transactions/{transaction}/approve',[TransactionController::class,'approve'])->name('transactions.approve'); Route::resource('payments',PaymentController::class)->only(['index','create','store','show']); Route::get('transactions/{transaction}/receipt',[PaymentController::class,'receipt'])->name('transactions.receipt');
});

Route::get('/weather', \App\Http\Controllers\WeatherController::class)->middleware(['auth','throttle:30,1'])->name('weather.show');

Route::get('/member-email/verify/{member}/{token}',[\App\Http\Controllers\MemberVerificationController::class,'show'])->middleware(['signed','throttle:20,1'])->name('members.verification.show');
Route::post('/member-email/verify/{member}/{token}',[\App\Http\Controllers\MemberVerificationController::class,'confirm'])->middleware(['signed','throttle:20,1'])->name('members.verification.confirm');
Route::post('/members/{member}/verification-email',[\App\Http\Controllers\MemberVerificationController::class,'resend'])->middleware(['auth','throttle:3,1'])->name('members.verification.resend');
