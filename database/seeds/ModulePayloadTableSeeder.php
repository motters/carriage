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
            'module_connections' => 'SHA-A3',
            'sub_hub_api' => 'okpo',
            'module_type' => '2',
            'payload' => '{
              "1447283613": "24",
              "1447283714": "22",
              "1447283714": "22",
              "1447283714": "22",
              "1447283814": "23",
              "1447283914": "24",
              "1447284114": "23",
              "1447284214": "28",
              "1447284314": "24",
              "1447284414": "23",
              "1447284514": "22"
            }'
        ]);
    }
}
