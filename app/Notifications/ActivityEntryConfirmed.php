<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActivityEntryConfirmed extends Notification
{
    use Queueable;

    /**
     * The activity entry id.
     *
     * @var int
     */
    protected $activity_entry_id;

    /**
     * The activity title.
     *
     * @var string
     */
    protected $activity_title;

    /**
     * Create a new notification instance.
     */
    public function __construct($activity_entry_id, $activity_title)
    {
        $this->activity_entry_id = $activity_entry_id;
        $this->activity_title = $activity_title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject(sprintf('Aanmelding voor \'%s\' succesvol', $this->activity_title))
            ->line([
                sprintf('Bedankt voor je aanmelding, je hebt je succesvol aangemeld voor \'%s\'.', $this->activity_title),
                'Veel plezier bij deze activiteit!',
            ])
            ->line('Klik op de knop hieronder om naar de details van je aanmelding te gaan:')
            ->action('Bekijk aanmelding', route('activity_entry.show', $this->activity_entry_id));
    }
}
