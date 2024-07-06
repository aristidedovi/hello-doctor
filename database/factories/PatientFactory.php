<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;
use Illuminate\Support\Str;


class PatientFactory extends Factory
{

    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // return [
        //     'code' => function () {
        //         return $this->generateUniqueCode();
        //     },
        //     'last_name' =>  $this->faker->firstName,
        //     'first_name' => $this->faker->lastName,
        //     'age' => $this->faker->numberBetween(18, 80),
        //     'genre' => $this->faker->randomElement(['male', 'female']),
        //     'phone' => $this->faker->phoneNumber,
        //     'address' => $this->faker->address,
        //     //
        // ];
        return false;
    }

    private function generateUniqueCode()
    {

        // Logique de génération personnalisée, par exemple : PREFIXE + Année + Numéro aléatoire
        $prefixe = 'P'; // Exemple de préfixe
        $annee = now()->year;
        $numeroAleatoire = strtoupper(Str::random(4)); // Numéro aléatoire de 4 caractères

        $code = $prefixe . $annee . $numeroAleatoire;

        do {
            $code = $prefixe . $annee . strtoupper(Str::random(4));
        } while (Patient::where('code', $code)->exists());

        return $code;
    }
}
