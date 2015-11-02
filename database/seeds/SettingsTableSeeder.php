<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Emergency Contact
        DB::table('settings')->insert([
            'settings_type' => '1',
            'setting' => 'sammottley@gmail.com'
        ]);


        // Add supported modules
        $modules = [ [2, 'temperature'], [2, 'vibration'], [2, 'sound'], [2, 'voltage']  ];
        foreach($modules as $no => $data)
        {
            DB::table('settings')->insert([
                'settings_type' => $data[0],
                'setting' => $data[1]
            ]);
        }
    }
}
