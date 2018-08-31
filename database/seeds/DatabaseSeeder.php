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
        // Manually defined seeders 
        $this->call(FeaturesTableSeeder::class);
        $this->call(LocaleTableSeeder::class);
        $this->call(SubscriptionTemplatesTableSeeder::class);
        $this->call(SubscriptionTemplatePricesTableSeeder::class);
        
        // Factory defined seeders
        $this->call(SubscriptionsTableSeeder::class);
        $this->call(CompanyUserTableSeeder::class);
        $this->call(DomainsTableSeeder::class);
        $this->call(CompanyDomainTableSeeder::class);
        $this->call(DomainLocaleTableSeeder::class);
        $this->call(DomainKeywordTableSeeder::class);
        $this->call(SubscriptionModifiersTableSeeder::class);
        
        // Manually and Factory defined seeders
        $this->call(FeatureablesTableSeeder::class);
    }
}
