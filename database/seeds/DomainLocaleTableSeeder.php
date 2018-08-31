<?php

use Illuminate\Database\Seeder;

class DomainLocaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $domains = App\Models\Domain::get();
        foreach ($domains as $domain) {
            $domain->locales()->attach(
                App\Models\Locale::where('hl', 'da')->where('gl', 'DK')->first()->id
            );
        }
    }
}
