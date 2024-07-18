<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
//use App\Services\WhatsAppService;
use App\Broadcasting\WhatsAppChannel;


class WhatsAppNotification extends Notification
{
    use Queueable;

    protected $appointment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WhatsAppChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    public function toWhatsApp($notifiable)
    {
        //$whatsappService = new WhatsAppService();
        setlocale(LC_ALL,'fr.UTF-8');
        $dateFormatted = strftime('%A %d %B %Y', strtotime($this->appointment->date));

        //$message = "Bonjour ". $this->appointment->patient->first_name ." Votre rendez-vous est prévu pour le " . $dateFormatted . ".";
        //$whatsAppService->sendMessage($notifiable->phone, $message);
        $message = "*CABINET DENTAIRE*\n\n".
                    "Bonjour *".$this->appointment->patient->first_name ." ". $this->appointment->patient->last_name.
                    "*,\nVotre prochaine rendez-vous pour les soins dentaire est prévu pour le *".$dateFormatted."*.\n".
                    "Merci!";

        return $message;
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
            //
        ];
    }
}
