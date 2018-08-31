<?php

use Illuminate\Database\Seeder;

class SubscriptionModifiersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\SubscriptionModifier::class, 10)->create();
    }
}
