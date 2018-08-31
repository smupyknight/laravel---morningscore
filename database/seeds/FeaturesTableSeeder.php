<?php

use Illuminate\Database\Seeder;

class FeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('features')->insert([
            [
                'slug'      => 'keywords',
                'is_public' => true,
            ],
            [
                'slug'      => 'competitor_analysis',
                'is_public' => true,
            ],
            [
                'slug'      => 'link_analysis',
                'is_public' => true,
            ],
            [
                'slug'      => 'api_usage',
                'is_public' => false,
            ],
        ]);
    }
}
