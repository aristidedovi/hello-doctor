<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;



class PatientSms extends Notification
{
    //use Queueable;
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
        return [\App\Broadcasting\WhatsAppChannel::class];
    }

    public function toWhatsapp($notifiable)
    {
        // return WhatsAppTextMessage::create()
        //     ->message('Hello, this is a test message')
        //     ->to('221778580286');
        //setlocale(LC_TIME, 'fr_FR.utf8'); // Définir la locale française
        setlocale(LC_ALL,'fr.UTF-8');
        $dateFormatted = strftime('%A %d %B %Y', strtotime($this->appointment->date));

        return [
            'name' => 'patient_notification',
            'language' => 'fr',
            'parameters' => [
                [
                    'type' => 'text',
                    'text' => $this->appointment->patient->first_name
                ],
                [
                    'type' => 'text',
                    'text' => $this->appointment->patient->last_name
                ],
                [
                    'type' => 'text',
                    'text' => $dateFormatted // Format de la date, selon vos besoins
                ]
            ]
        ];
    }
}
