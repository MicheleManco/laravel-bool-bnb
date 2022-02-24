<?php

use Illuminate\Database\Seeder;

use App\Apartment;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Apartment::class, 10) -> create();
    }
}
