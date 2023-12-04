<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Patient extends Model
{
    use HasFactory;

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

    
}
