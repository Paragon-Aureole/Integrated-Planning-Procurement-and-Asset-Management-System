<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        $permissions = [

			['name' => 'full control'],

            ['name' => 'modify'],
            ['name' => 'read'],
            ['name' => 'write'],

            ['name' => 'close'],
            ['name' => 'asset mgt'],
            ['name' => 'gso supervisor'],


        ];

        // create permissions
        foreach ($permissions as $key => $permission) {
        	# code...
        	Permission::create($permission);
        }
        

        // create roles and assign created permissions
        $role = Role::create(['name' => 'Department']);
        $role->givePermissionTo(['read', 'write', 'modify']);

        $role = Role::create(['name' => 'Secretariat'])
        ->givePermissionTo(['read', 'write', 'modify', 'close']);

        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo(Permission::all());

        



        

        
    }
}
