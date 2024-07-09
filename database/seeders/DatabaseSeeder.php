<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //\App\Models\Patient::factory(10)->create();
        //\App\Models\Appointment::factory(5)->create();
        //\App\Models\User::factory(1)->create();
        \App\Models\Item::factory(5)->create();
        //\App\Models\Motifs::factory(5)->create();

    }
}
