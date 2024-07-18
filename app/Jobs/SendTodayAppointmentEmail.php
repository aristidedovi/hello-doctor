<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Appointment;
//use App\Notifications\PatientNotification;
//use App\Notifications\PatientSms;
use App\Notifications\WhatsAppNotification;




class SendTodayAppointmentEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $appointment;
    //protected $notifiable;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
        //$this->notifiable = $notifiable;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Log::info('Handling job for appointment ID: ' . $this->appointment->id);

        $patient = $this->appointment->patient;
        //$patient->notify(new PatientNotification($this->appointment));
        //$patient->notify(new PatientSms($this->appointment));
        $patient->notify(new WhatsAppNotification($this->appointment));

        

        //$this->notifiable->notify(new PatientSms());

        // Log::info('Notification sent to patient ID: ' . $patient->id);

    }
}
