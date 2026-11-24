<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
class VerifyMemberEmail extends Notification implements ShouldQueue {
 use Queueable;
 public $tries=3;
 public function __construct(public string $url){$this->afterCommit();}
 public function via(object $notifiable): array{return ['mail'];}
 public function toMail(object $notifiable): MailMessage {
  return (new MailMessage)->subject('Verify your MemberFlow email')
   ->line('Please confirm that this email address belongs to you.')
   ->action('Verify Email',$this->url)
   ->line('This link expires in 60 minutes. If you did not request it, you may ignore this message.');
 }
}
