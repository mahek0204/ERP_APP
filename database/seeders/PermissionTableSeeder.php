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
           'product-list',
           'product-create',
           'product-edit',
           'product-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'team-list',
           'team-create',
           'team-edit',
           'team-delete',
           'lead-list',
           'lead-create',
           'lead-edit',
           'lead-delete'


        ];
        
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);

        }
    }
}
