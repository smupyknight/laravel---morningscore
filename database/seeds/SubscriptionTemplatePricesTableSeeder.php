<?php

use Illuminate\Database\Seeder;

class SubscriptionTemplatePricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscription_template_prices')->insert([
            [
                'subscription_template_id'  => 1,
                'price'                     => 0,
                'billing_period'            => 1,
            ],
            
            [
                'subscription_template_id'  => 2,
                'price'                     => 60,
                'billing_period'            => 1,
            ],
            
            [
                'subscription_template_id'  => 3,
                'price'                     => 85,
                'billing_period'            => 1,
            ],
            
            [
                'subscription_template_id'  => 4,
                'price'                     => 150,
                'billing_period'            => 1,
            ],
        ]);
    }
}
