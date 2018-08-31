<?php

use Illuminate\Database\Seeder;

class CompanyUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\User::assigned('customer')
            ->first()
            ->companies()
            ->attach(
                App\Models\Company::inRandomOrder()->first()->id
            );
    }
}
