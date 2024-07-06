<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PatientNotification extends Notification
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
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
        try {
            return (new MailMessage)
                //->from('dovi.aristide@gmail.com', 'Hello Doctor')
                ->line('Your appointment has been created.')
                ->line('Appointment Details:')
                ->line('Date: ' . $this->appointment->date)
                ->line('Motif: ' . $this->appointment->motif)
                ->action('View Appointment', url('/appointments/' . $this->appointment->id))
                ->line('Thank you for using our application!');
        } catch (\Exception $e) {
            Log::error('Failed to build mail message: ' . $e->getMessage());
        }
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
            'appointment_id' => $this->appointment->id,
            'date' => $this->appointment->date,
            'motif' => $this->appointment->motif,
        ];
    }
}
