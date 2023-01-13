<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run() {

        $this->call(OfferingSeeder::class);
        // $this->call(RegistrationSeeder::class);
    //   $this->call(StudentMarksSeeder::class);

    }
}
