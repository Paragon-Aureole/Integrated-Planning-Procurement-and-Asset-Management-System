<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); 

            User::create(
                [
                    'username' => "admin1",
                    'password' => bcrypt('admin1'),
                    'office_id' => '1' ,
                    'wholename' => "System Administrator",
                    'contact_number' => "139",
                ]
            )->assignRole('Admin');

            User::create(
                [
                    'username' => "user1",
                    'password' => bcrypt('users1'),
                    'office_id' => '2' ,
                    'wholename' => "Sample Department User",
                    'contact_number' => "139",
                ]
            )->assignRole('Department');

            User::create(
                [
                    'username' => "bac1",
                    'password' => bcrypt('bacbac'),
                    'office_id' => '2' ,
                    'wholename' => "Sample BAC Secretariat",
                    'contact_number' => "139",
                ]
            )->assignRole('Secretariat');

            User::create(
                [
                    'username' => "gso1",
                    'password' => bcrypt('gsogso'),
                    'office_id' => '25' ,
                    'wholename' => "Sample GSO User",
                    'contact_number' => "139",
                ]
            )->assignRole('Department')->givePermissionTo('asset mgt');

            User::create(
                [
                    'username' => "gso2",
                    'password' => bcrypt('gsogso'),
                    'office_id' => '25' ,
                    'wholename' => "Sample GSO Supervisor",
                    'contact_number' => "139",
                ]
            )->assignRole('Department')->givePermissionTo('asset mgt')->givePermissionTo('gso supervisor');


        Schema::enableForeignKeyConstraints();
    }
}
