<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;




class Patient extends Model
{
    use HasFactory;
    use Notifiable;


    protected $fillable = [
        'code',
        'last_name',
        'first_name',
        'age',
        'genre',
        'phone',
        'address',
        // Add other attributes as needed
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->generateUniqueCode();
        });
    }

    public function generateUniqueCode()
    {
        // Logique de génération personnalisée, par exemple : PREFIXE + Année + Numéro aléatoire
        $prefixe = 'P'; // Exemple de préfixe
        $annee = now()->year;
        $numeroAleatoire = strtoupper(Str::random(4)); // Numéro aléatoire de 4 caractères

        $code = $prefixe . $annee . $numeroAleatoire;

        do {
            $code = $prefixe . $annee . strtoupper(Str::random(4));
        } while (self::where('code', $code)->exists());

        $this->code = $code;
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // Custom method to route email notifications
    public function routeNotificationForMail($notification)
    {
        return 'dovi.aristide@gmail.com';
        //return '221778580286';
        // return $this->email_address; // or whatever field you use for the email
    }

    public function routeNotificationForWhatsApp()
    {
        return '221778580286'; // Assumes the User model has a phone_number attribute
        //return $this->phone;
    }

    
}
