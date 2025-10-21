<?php

namespace App\Notifications;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReviewNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Review $review
    ) {}

    public function via($notifiable): array
    {
        return ['database', 'broadcast', 'mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Review on Your Topic')
            ->line('A new review has been posted on your topic "' . $this->review->topic->title . '"')
            ->line('Rating: ' . $this->review->rating . ' stars')
            ->action('View Review', route('topics.show', $this->review->topic))
            ->line('Thank you for using our platform!');
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'new_review',
            'review_id' => $this->review->id,
            'topic_id' => $this->review->topic_id,
            'topic_title' => $this->review->topic->title,
            'reviewer_name' => $this->review->user->name,
            'rating' => $this->review->rating,
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }
}