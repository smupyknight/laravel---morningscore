<?php

use Illuminate\Database\Seeder;

class SubscriptionTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscription_templates')->insert([
            [
                'slug'              => 'free',
                'is_default'        => true,
            ],
            [
                'slug'              => 'lite',
                'is_default'        => false,
            ],
            [
                'slug'              => 'standard',
                'is_default'        => false,
            ],
            [
                'slug'              => 'pro',
                'is_default'        => false,
            ],
        ]);
    }
}
