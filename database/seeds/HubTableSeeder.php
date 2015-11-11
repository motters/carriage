<?php

use Illuminate\Database\Seeder;

class HubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hubs')->insert([
            'carriage_name' => 'Deluxe-B-56',
            'client_id' => '1',
            'desc' => 'Demo hub',
            'module_configuration' => '{"sub_hubs":[{"name":"Front","api_key":"okpo","api_enc":"kpo","api_user":"kop","api_pass":"k"}],"modules":[{"name":"Temperature","module_id":"5554689","sub_hub":"okpo","module":"2","interval":"10"}]}',
            'api_key' => '1234567890qwertyuiopasdfg',
            'api_enc' => 'qwertyuiop1234567890asdfg',
            'api_user' => 'hub_1',
            'api_pass' => 'hub_1_password',
        ]);

        DB::table('hubs')->insert([
            'carriage_name' => 'Standard-A-2',
            'client_id' => '2',
            'desc' => 'Another hub',
            'module_configuration' => '{"sub_hubs":[{"name":"Front","api_key":"okpo","api_enc":"kpo","api_user":"kop","api_pass":"k"}],"modules":[{"name":"Temperature","module_id":"125486","sub_hub":"okpo","module":"2","interval":"10"}]}',
            'api_key' => 'lkjhgfdsamnbvcxz123456789',
            'api_enc' => '0987654321poiuytrewqlkjhg',
            'api_user' => 'hub_2',
            'api_pass' => 'hub_2_password',
        ]);

        DB::table('hubs')->insert([
            'carriage_name' => 'Deluxe-B-56',
            'client_id' => '1',
            'desc' => 'Another hub somewhere in the world',
            'module_configuration' => '{"sub_hubs":[{"name":"Front","api_key":"okpo","api_enc":"kpo","api_user":"kop","api_pass":"k"}],"modules":[{"name":"Temperature","module_id":"785948","sub_hub":"okpo","module":"2","interval":"10"}]}',
            'api_key' => '0987654321zxcvbnmlkjhgtre',
            'api_enc' => 'lkjhgfdsamnbvcxzqwertyuio',
            'api_user' => 'hub_3',
            'api_pass' => 'hub_3_password',
        ]);
    }
}
