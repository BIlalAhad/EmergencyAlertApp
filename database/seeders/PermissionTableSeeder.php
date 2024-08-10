<?php



namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;



class PermissionTableSeeder extends Seeder

{

    /**

     * Run the database seeds.

     */

    public function run(): void

    {

        $permissions = [

            'role-list',

            'role-create',

            'role-edit',

            'role-delete',

            'organization-list',

            'organization-create',

            'organization-edit',

            'organization-delete',
            
            'OrganizationDetail-list',

            'OrganizationDetail-create',

            'OrganizationDetail-edit',

            'OrganizationDetail-delete',

        ];



        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission]);
        }
    }
}