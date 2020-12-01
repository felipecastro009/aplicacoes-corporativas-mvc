<?php

use Illuminate\Database\Seeder;
use App\Models\Auth\Role;
use App\Models\Auth\Permission;

class RolesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Create Root Role
    $root = Role::create([
      'name' => 'root',
      'details' => 'Root',
      'guard_name' => 'dashboard'
    ]);

    $root->syncPermissions(Permission::all());

    // Create Gestor Role
    $gestor = Role::create([
      'name' => 'gestor',
      'details' => 'Gestor',
      'guard_name' => 'dashboard'
    ]);

    // Sync permissions
    $gestor->syncPermissions(Permission::whereNotIn('name', [
      'view_permissions', 'add_permissions', 'edit_permissions', 'delete_permissions',
      'view_settings', 'add_settings', 'edit_settings', 'delete_settings',
    ])->get());
  }
}
