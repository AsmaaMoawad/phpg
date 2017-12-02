<?php


use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            'name' => 'Admin',
            'display_name' => 'Admin Site',
            'description' => 'Control All.'
        ]);

        DB::table('roles')->insert([
            'name' => 'Shipper',
            'display_name' => 'shipper',
            'description' => 'Add Shipment.'
        ]);

        DB::table('roles')->insert([
            'name' => 'Driver',
            'display_name' => 'Driver',
            'description' => 'Transport The Shipment.'
        ]);

        
    }
}
