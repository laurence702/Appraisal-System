<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;

class SlackNotifier extends Notification
{
    use Queueable;

    public $myerrorbag;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($e = "Some message")
    {
        $this->myerrorbag = $e;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
                ->from('NEW ERP', ':ghost:')
                ->to('#app-error-logs')
                ->content($this->myerrorbag);
    }

}
