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
            'sub_hub_api' => '1',
            'module_id' => '1',
            'module_type' => '1',
            'payload' => ''
        ]);
    }
}
