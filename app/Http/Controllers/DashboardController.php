<?php
namespace App\Http\Controllers; use App\Models\{Member,MembershipTransaction,Payment};
class DashboardController extends Controller { public function __invoke(){return view('dashboard',['members'=>Member::count(),'active'=>Member::where('status','Active')->count(),'pending'=>MembershipTransaction::where('status','Pending')->count(),'collections'=>Payment::sum('amount'),'recent'=>MembershipTransaction::with('member')->latest()->take(5)->get()]);} }
