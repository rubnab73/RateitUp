<?php

namespace App\Notifications;

use App\Models\ReviewModeration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewModerationNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected ReviewModeration $moderation
    ) {}

    public function via($notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $action = ucfirst($this->moderation->action);
        $review = $this->moderation->review;
        
        return (new MailMessage)
            ->subject("Review {$action} Notice")
            ->line("Your review on '{$review->topic->title}' has been flagged for moderation.")
            ->line("Reason: {$this->moderation->reason}")
            ->action('View Review', route('reviews.show', $review))
            ->line('If you believe this is a mistake, please contact support.');
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'review_moderation',
            'review_id' => $this->moderation->review_id,
            'action' => $this->moderation->action,
            'reason' => $this->moderation->reason,
        ];
    }
}
