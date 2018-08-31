<?php

use Illuminate\Database\Seeder;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\Domain::class, 1)->create();
        $id = DB::table('domains')->insertGetId([
            'domain' => 'morningtrain.dk',
        ]);
        
        DB::table('domains')->insert([
            [
                'domain'        => 'waimea.dk',
                'competitor_for' => $id,
            ],
            [
                'domain'        => 'connect-media.dk',
                'competitor_for' => $id,
            ],
            [
                'domain'        => 'redweb.dk',
                'competitor_for' => $id,
            ],
            [
                'domain'        => 'obsidian.dk',
                'competitor_for' => $id,
            ],
        ]);
    }
}


