<?php

use Illuminate\Database\Seeder;

class DomainKeywordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\DomainKeyword::class, 20)->create();
        $keywords = [
            'adwords markedsføring',
            'bedste seo værktøj',
            'hvad er amp',
            'markedsføringsbureau',
            'outlook signatur',
            'seo konsulenter',
            'signatur i outlook 2016',
            'social media marketing',
            'grafisk design',
            'design logo',
            'markedsføring via sociale medier',
            'webudvikler',
            'hjemmeside design',
            'professionel hjemmeside design',
            'api integration',
            'dedicated server',
            'drupal udvikling',
            'php laravel',
            'udvikling af webshop',
            'vps hosting',
        ];
        
        $domain = App\Models\Domain::first();
        $data = [];
        foreach ($keywords as $keyword) {
            $data[] = [
                'domain_id' => $domain->id,
                'locale_id' => $domain->locales()->first()->id,
                'keyword'   => $keyword,
            ];
        }
        
        DB::table('domain_keywords')->insert($data);
    }
}
