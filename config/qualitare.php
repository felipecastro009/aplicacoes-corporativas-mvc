<?php

return [
  'modules' => [
    [
      [
        'header' => 'Dashboard',
        'permission' => 'view_dashboard',
        'items' =>
        [
          [
            'name' => 'Dashboard',
            'path' => 'dashboard',
            'permission' => 'view_dashboard',
            'icon' => 'far fa-chart-bar lga',
            'route' => 'admin.dashboard.index'
          ]
        ],
      ],
      [
        'header' => 'Módulos',
        'permission' => 'view_modules',
        'items' =>
        [

          [
            'name' => 'Produtos',
            'path' => 'products',
            'permission' => 'view_products',
            'icon' => ' far fa-star lga',
            'route' => 'admin.products.index',
            'submodules' => [
              [
                'name' => 'Produtos',
                'path' => 'products',
                'permission' => 'view_products',
                'route' => 'admin.products.index'
              ],
              [
                'name' => 'Categorias',
                'path' => 'categories',
                'permission' => 'view_products_submodules',
                'route' => 'admin.products_categories.index'
              ],
            ],
          ],
        ],
      ],
      [
        'header' => 'Configurações',
        'permission' => 'view_settings',
        'items' =>
        [
          [
            'name' => 'Usuários',
            'path' => 'users',
            'permission' => 'view_users',
            'icon' => 'far fa-user lga',
            'route' => 'admin.users.index'
          ],
          [
            'name' => 'Grupos',
            'path' => 'roles',
            'permission' => 'view_roles',
            'icon' => 'fas fa-users lga',
            'route' => 'admin.roles.index'
          ],
          [
            'name' => 'Permissões',
            'permission' => 'view_permissions',
            'icon' => 'fas fa-key lga',
            'route' => 'admin.permissions.index'
          ],
          [
            'name' => 'Auditoria',
            'path' => 'audits',
            'permission' => 'view_audits',
            'icon' => 'fas fa-redo lga',
            'route' => 'admin.audits.index'
          ],
        ],
      ],
    ],
  ],
  'audit' => [
    'types' => [
      'Product'                                                            => 'Produto',
      'Category'                                                            => 'Categoria',
    ],
    'actions' => [
      'created'       => 'Criação',
      'updated'       => 'Alteração',
      'deleted'       => 'Exclusão',
      'restored'      => 'Reativação'
    ],
  ],
  'email' => [
    'default' => 'suporte@felipecastro.dev'
  ],
  'colors' => [
    'primary'     => '#FFB119',
    'second'      => '#333333',
    'third'       => '#2B2D42',
    'four'        => '#8D99AE',
    'five'        => '#F2F2F6'
  ]
];
