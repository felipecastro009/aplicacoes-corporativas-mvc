<?php

Breadcrumbs::for('dashboard', function ($breadcrumb) {
  $breadcrumb->push('Dashboard', route('admin.dashboard.index'));
});

Breadcrumbs::for('audits.index', function ($breadcrumb) {
  $breadcrumb->parent('dashboard');
  $breadcrumb->push('Auditoria', route('admin.audits.index'));
});

Breadcrumbs::for('accounts.show', function ($breadcrumb) {
  $breadcrumb->parent('dashboard');
  $breadcrumb->push('Meu Perfil', route('admin.accounts.show'));
});

Breadcrumbs::for('accounts.edit', function ($breadcrumb, $result) {
  $breadcrumb->parent('accounts.show');
  $breadcrumb->push('Editar Perfil', route('admin.accounts.edit', ['id' => $result->id]));
});

Breadcrumbs::for('audits.show', function ($breadcrumb, $result) {
  $breadcrumb->parent('audits.index');
  $breadcrumb->push('Visualizar Log', route('admin.audits.show', ['id' => $result->id]));
});

Breadcrumbs::for('users.index', function ($breadcrumb) {
  $breadcrumb->parent('dashboard');
  $breadcrumb->push('Usuários', route('admin.users.index'));
});

Breadcrumbs::for('users.create', function ($breadcrumb) {
  $breadcrumb->parent('users.index');
  $breadcrumb->push('Novo Usuário', route('admin.users.create'));
});

Breadcrumbs::for('users.edit', function ($breadcrumb, $result) {
  $breadcrumb->parent('users.index');
  $breadcrumb->push('Editar Usuário', route('admin.users.edit', ['id' => $result->id]));
});

Breadcrumbs::for('roles.index', function ($breadcrumb) {
  $breadcrumb->parent('dashboard');
  $breadcrumb->push('Grupos', route('admin.roles.index'));
});

Breadcrumbs::for('roles.create', function ($breadcrumb) {
  $breadcrumb->parent('roles.index');
  $breadcrumb->push('Novo Grupo', route('admin.roles.create'));
});

Breadcrumbs::for('roles.edit', function ($breadcrumb, $result) {
  $breadcrumb->parent('roles.index');
  $breadcrumb->push('Editar Grupo', route('admin.roles.edit', ['id' => $result->id]));
});

Breadcrumbs::for('permissions.index', function ($breadcrumb) {
  $breadcrumb->parent('dashboard');
  $breadcrumb->push('Permissões', route('admin.permissions.index'));
});

Breadcrumbs::for('permissions.create', function ($breadcrumb) {
  $breadcrumb->parent('permissions.index');
  $breadcrumb->push('Nova Permissão', route('admin.permissions.create'));
});

Breadcrumbs::for('permissions.edit', function ($breadcrumb, $result) {
  $breadcrumb->parent('permissions.index');
  $breadcrumb->push('Editar Permissão', route('admin.permissions.edit', ['id' => $result->id]));
});

Breadcrumbs::for('products.index', function ($breadcrumb) {
  $breadcrumb->parent('dashboard');
  $breadcrumb->push('Produtos', route('admin.products.index'));
});

Breadcrumbs::for('products.create', function ($breadcrumb) {
  $breadcrumb->parent('products.index');
  $breadcrumb->push('Novo Produto', route('admin.products.create'));
});

Breadcrumbs::for('products.edit', function ($breadcrumb, $result) {
  $breadcrumb->parent('products.index');
  $breadcrumb->push('Editar Produto', route('admin.products.edit', ['id' => $result->id]));
});

Breadcrumbs::for('products_categories.index', function ($breadcrumb) {
  $breadcrumb->parent('dashboard');
  $breadcrumb->push('Categorias', route('admin.products_categories.index'));
});

Breadcrumbs::for('products_categories.create', function ($breadcrumb) {
  $breadcrumb->parent('products_categories.index');
  $breadcrumb->push('Nova Categoria', route('admin.products_categories.create'));
});

Breadcrumbs::for('products_categories.edit', function ($breadcrumb, $result) {
  $breadcrumb->parent('products_categories.index');
  $breadcrumb->push('Editar Categoria', route('admin.products_categories.edit', ['id' => $result->id]));
});


