<?php

use Illuminate\Database\Seeder;

class FeatureablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->manualInput();
    }
    
    public function manualInput()
    {
        DB::table('featureables')->insert([
            //  feature_id      slug
            //
            //  1               keywords
            //  2               competitor_analysis
            //  3               link_analysis
            //  4               api_usage

            //  subscription_template_id        slug
            //
            //  1                               free_passenger
            //  2                               coach_passenger
            //  3                               lounge_passenger
            //  4                               express_passenger
            
            [
                'feature_id'        => 1,
                'featureable_id'    => 1,
                'featureable_type'  => 'App\Models\SubscriptionTemplate',
                'quantity'          => 2,
            ],
            [
                'feature_id'        => 1,
                'featureable_id'    => 2,
                'featureable_type'  => 'App\Models\SubscriptionTemplate',
                'quantity'          => 10,
            ],
            [
                'feature_id'        => 2,
                'featureable_id'    => 2,
                'featureable_type'  => 'App\Models\SubscriptionTemplate',
                'quantity'          => 1,
            ],
            
            [
                'feature_id'        => 1,
                'featureable_id'    => 3,
                'featureable_type'  => 'App\Models\SubscriptionTemplate',
                'quantity'          => 25,
            ],
            [
                'feature_id'        => 2,
                'featureable_id'    => 3,
                'featureable_type'  => 'App\Models\SubscriptionTemplate',
                'quantity'          => 1,
            ],
            [
                'feature_id'        => 3,
                'featureable_id'    => 3,
                'featureable_type'  => 'App\Models\SubscriptionTemplate',
                'quantity'          => 1,
            ],
            
            [
                'feature_id'        => 1,
                'featureable_id'    => 4,
                'featureable_type'  => 'App\Models\SubscriptionTemplate',
                'quantity'          => 50,
            ],
            [
                'feature_id'        => 2,
                'featureable_id'    => 4,
                'featureable_type'  => 'App\Models\SubscriptionTemplate',
                'quantity'          => 1,
            ],
            [
                'feature_id'        => 3,
                'featureable_id'    => 4,
                'featureable_type'  => 'App\Models\SubscriptionTemplate',
                'quantity'          => 1,
            ],
            [
                'feature_id'        => 4,
                'featureable_id'    => 4,
                'featureable_type'  => 'App\Models\SubscriptionTemplate',
                'quantity'          => 1,
            ],
        ]);
    }
}
