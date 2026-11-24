<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
class MembershipTransactionSubmitted extends Notification implements ShouldQueue {
    use Queueable;
    public $tries = 3;
    public $backoff = 60;
    public function __construct(public string $memberName, public string $reference, public string $type) {
        $this->afterCommit();
    }
    public function via(object $notifiable): array { return ['mail']; }
    public function toMail(object $notifiable): MailMessage {
        return (new MailMessage)->subject('Membership '.$this->type.' received')
            ->greeting('Hello '.$this->memberName.',')
            ->line('Your membership '.strtolower($this->type).' has been recorded.')
            ->line('Reference: '.$this->reference)
            ->line('Status: Pending payment and approval.')
            ->line('Keep this reference for your records.')
            ->salutation(config('app.name'));
    }
}

