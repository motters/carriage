<?php

use Illuminate\Database\Seeder;

class ModulePayloadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Emergency Contact
        DB::table('module_payload')->insert([
            'hub_id' => '1',
            'module_id' => '1',
            'payload' => ''
        ]);
    }
}
