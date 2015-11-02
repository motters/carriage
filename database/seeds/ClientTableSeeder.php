<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'client' => 'Virgin Trains',
        ]);

        DB::table('clients')->insert([
            'client' => 'Transpennine Express',
        ]);

        DB::table('clients')->insert([
            'client' => 'Northern Rail',
        ]);
    }
}
