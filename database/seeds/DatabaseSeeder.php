<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesAndCities::class);
        $this->call(Currencies::class);
        $this->call(PriceCurrencies::class);
        $this->call(Users::class);
        $this->call(Products::class);
        $this->call(Messages::class);
        $this->call(Statuses::class);
    }
}
