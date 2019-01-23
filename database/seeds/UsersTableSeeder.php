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
        $users = [
            [
                'username' => "systemadmin",
                'password' => bcrypt('systemadmin98'),
                'office_id' => '1' ,
                'wholename' => "System Administrator",
                'contact_number' => "139",
            ],
        ];

        foreach($users as $user){
            User::create($user)->assignRole('Admin');
        }

        Schema::enableForeignKeyConstraints();
    }
}
