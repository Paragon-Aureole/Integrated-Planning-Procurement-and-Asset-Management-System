<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(OfficesTableSeeder::class);
        $this->call(MeasurementUnitSeeder::class);
        $this->call(ProcurementModesSeeder::class);
        $this->call(SignatorySeeder::class);
        
    }
}
