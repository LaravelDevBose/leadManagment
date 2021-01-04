<?php

namespace App\Notifications;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLeadRegistered extends Notification
{
    use Queueable;

    public $lead;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'lead_id'=>$this->lead->lead_id,
            'first_name'=>$this->lead->first_name,
            'last_name'=>$this->lead->last_name,
        ];
    }
}
