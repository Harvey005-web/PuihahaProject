<?php
namespace App\Http\Controllers;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Notifications\VerifyMemberEmail;
class MemberVerificationController extends Controller {
 public static function send(Member $member): void {
  DB::transaction(function() use($member){
   $fresh=Member::whereKey($member->id)->lockForUpdate()->firstOrFail();
   if($fresh->email_verified_at)return;
   $token=Str::random(64);
   $fresh->forceFill(['email_verification_token'=>hash('sha256',$token)])->save();
   $url=URL::temporarySignedRoute('members.verification.show',now()->addMinutes(60),['member'=>$fresh->id,'token'=>$token]);
   Notification::route('mail',$fresh->email)->notify(new VerifyMemberEmail($url));
  });
 }
 public function resend(Member $member){
  if($member->email_verified_at)return back()->with('success','Email is already verified.');
  self::send($member);
  return back()->with('success','Verification email queued. Any previous verification link has been replaced.');
 }
 private function valid(Member $member,string $token): bool {
  return $member->email_verification_token && hash_equals($member->email_verification_token,hash('sha256',$token));
 }
 public function show(Request $request,Member $member,string $token){
  abort_unless($this->valid($member,$token),403,'This verification link has been replaced or already used. Ask the administrator for a new link.');
  return view('members.verify-email',['confirmed'=>false]);
 }
 public function confirm(Request $request,Member $member,string $token){
  DB::transaction(function()use($member,$token){
   $fresh=Member::whereKey($member->id)->lockForUpdate()->firstOrFail();
   abort_unless($this->valid($fresh,$token),403,'This verification link is no longer valid.');
   $fresh->forceFill(['email_verified_at'=>now(),'email_verification_token'=>null])->save();
  });
  return view('members.verify-email',['confirmed'=>true]);
 }
}
