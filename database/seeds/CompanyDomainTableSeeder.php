<?php

use Illuminate\Database\Seeder;

class CompanyDomainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = App\Models\Company::first();
        $domains = App\Models\Domain::pluck('id')->toArray();
        $company->domains()->attach($domains);
    }
}
