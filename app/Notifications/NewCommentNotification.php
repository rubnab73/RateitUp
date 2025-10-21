<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Comment $comment
    ) {}

    public function via($notifiable): array
    {
        return ['database', 'broadcast', 'mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Comment on Your Review')
            ->line('A new comment has been posted on your review for "' . $this->comment->review->topic->title . '"')
            ->action('View Comment', route('topics.show', $this->comment->review->topic))
            ->line('Thank you for using our platform!');
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'new_comment',
            'comment_id' => $this->comment->id,
            'review_id' => $this->comment->review_id,
            'topic_id' => $this->comment->review->topic_id,
            'topic_title' => $this->comment->review->topic->title,
            'topic_name' => $this->comment->review->topic->title,
            'commenter_name' => $this->comment->user->name,
            'comment_text' => str()->limit($this->comment->comment_text, 150),
            'comment_url' => route('reviews.show', $this->comment->review_id)
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }
}