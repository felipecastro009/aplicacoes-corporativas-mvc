<?php

use Illuminate\Database\Seeder;
use App\Models\Auth\Permission;

class PermissionsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Reset cached roles and permissions
    app()['cache']->forget('spatie.permission.cache');

    // Permissions
    $permissions = [

      // Audit
      ['name' => 'view_audits', 'details' => 'Auditorias [view]'],

      // Dashboard
      ['name' => 'view_dashboard', 'details' => 'Dashboard [view]'],

      // Analytics
      ['name' => 'view_analytics', 'details' => 'Acessos [view]'],

      // Modules
      ['name' => 'view_modules', 'details' => 'Módulos [view]'],


      // Settings
      ['name' => 'view_settings', 'details' => 'Configurações [view]'],
      ['name' => 'add_settings', 'details' => 'Configurações [add]'],
      ['name' => 'edit_settings', 'details' => 'Configurações [edit]'],
      ['name' => 'delete_settings', 'details' => 'Configurações [delete]'],

      // Permissions
      ['name' => 'view_permissions', 'details' => 'Permissões [view]'],
      ['name' => 'add_permissions', 'details' => 'Permissões [add]'],
      ['name' => 'edit_permissions', 'details' => 'Permissões [edit]'],
      ['name' => 'delete_permissions', 'details' => 'Permissões [delete]'],

      // Roles
      ['name' => 'view_roles', 'details' => 'Grupos [view]'],
      ['name' => 'add_roles', 'details' => 'Grupos [add]'],
      ['name' => 'edit_roles', 'details' => 'Grupos [edit]'],
      ['name' => 'delete_roles', 'details' => 'Grupos [delete]'],

      // Users
      ['name' => 'view_users', 'details' => 'Usuários [view]'],
      ['name' => 'add_users', 'details' => 'Usuários [add]'],
      ['name' => 'edit_users', 'details' => 'Usuários [edit]'],
      ['name' => 'delete_users', 'details' => 'Usuários [delete]'],

      // Services
      ['name' => 'view_products', 'details' => 'Produtos [view]'],
      ['name' => 'add_products', 'details' => 'Produtos [add]'],
      ['name' => 'edit_products', 'details' => 'Produtos [edit]'],
      ['name' => 'delete_products', 'details' => 'Produtos [delete]'],

      // Services Submodules
      ['name' => 'view_products_submodules', 'details' => 'Produtos Categorias [view]'],
      ['name' => 'add_products_submodules', 'details' => 'Produtos Categorias [add]'],
      ['name' => 'edit_products_submodules', 'details' => 'Produtos Categorias [edit]'],
      ['name' => 'delete_products_submodules', 'details' => 'Produtos Categorias [delete]'],
    ];

    foreach($permissions as $permission):
      Permission::create([
        'name' => $permission['name'],
        'details' => $permission['details'],
        'guard_name' => 'dashboard'
      ]);
    endforeach;
  }
}
