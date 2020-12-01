<?php

/**
* Admin Routes
*/
Route::prefix('admin')->group(function() {

  /**
  * Auto login
  */
  Route::name('autologin')->middleware('guest.admin')->get('/autologin/{token}', '\Watson\Autologin\AutologinController@autologin');

  /**
  * Public Routes
  */
  Route::middleware('guest.admin')->namespace('Admin\Sessions')->group(function() {
    // Login
    Route::name('admin.session.login')->get('/acessar', 'SessionController@showLoginForm');
    Route::name('admin.session.login')->post('/acessar', 'SessionController@login');

    // Social Login
    Route::name('admin.social.redirect')->get('/social/redirect/{provider}', 'SocialController@redirectToProvider');
    Route::name('admin.social.handle')->get('/social/handle/{provider}', 'SocialController@handleProviderCallback');

    // Reset Password
    Route::name('admin.password.forgot')->get('/esqueci-minha-senha', 'ForgotPasswordController@showLinkRequestForm');
    Route::name('admin.password.processForgot')->post('/esqueci-minha-senha', 'ForgotPasswordController@sendResetLinkEmail');
    Route::name('admin.password.reset')->get('/cadastrar-senha/{token}/{email}', 'ResetPasswordController@showResetForm');
    Route::name('admin.password.processReset')->post('/cadastrar-senha', 'ResetPasswordController@reset');
  });

  /**
   * Protected Routes
   */
  Route::middleware('auth.admin')->group(function() {

    // First access
    Route::name('admin.activation.create')->get('/primeiro-acesso', 'Admin\Session\ActivationController@showActivationForm');
    Route::name('admin.activation.processCreate')->post('/primeiro-acesso', 'Admin\Session\ActivationController@store');

    // Logout
    Route::name('admin.session.logout')->get('/sair', 'Admin\Sessions\SessionController@logout');

    // Check first access
    Route::middleware('first.access')->namespace('Admin')->group(function() {

      // Dashboards
      Route::name('admin.dashboard.index')->get('/', 'Dashboard\DashboardController@index');

      // Account
      Route::prefix('perfil')->group(function() {
        Route::name('admin.accounts.show')->get('/', 'Users\AccountController@show');
        Route::name('admin.accounts.edit')->get('/atualizar', 'Users\AccountController@edit');
        Route::name('admin.accounts.update')->put('/atualizar', 'Users\AccountController@update');
      });

      // Permissions
      Route::prefix('permissoes')->group(function() {
        Route::name('admin.permissions.index')->get('/', 'Users\PermissionController@index');
        Route::name('admin.permissions.create')->get('/adicionar', 'Users\PermissionController@create');
        Route::name('admin.permissions.store')->post('/adicionar', 'Users\PermissionController@store');
        Route::name('admin.permissions.edit')->get('/editar/{id}', 'Users\PermissionController@edit');
        Route::name('admin.permissions.update')->put('/editar/{id}', 'Users\PermissionController@update');
        Route::name('admin.permissions.destroy')->delete('/excluir/{id}', 'Users\PermissionController@destroy');
      });

      // Roles
      Route::prefix('grupos')->group(function() {
        Route::name('admin.roles.index')->get('/', 'Users\RoleController@index');
        Route::name('admin.roles.create')->get('/adicionar', 'Users\RoleController@create');
        Route::name('admin.roles.store')->post('/adicionar', 'Users\RoleController@store');
        Route::name('admin.roles.edit')->get('/editar/{id}', 'Users\RoleController@edit');
        Route::name('admin.roles.update')->put('/editar/{id}', 'Users\RoleController@update');
      });

      // Users
      Route::prefix('usuarios')->group(function() {
        Route::name('admin.users.index')->get('/', 'Users\UserController@index');
        Route::name('admin.users.create')->get('/adicionar', 'Users\UserController@create');
        Route::name('admin.users.store')->post('/adicionar', 'Users\UserController@store');
        Route::name('admin.users.edit')->get('/editar/{id}', 'Users\UserController@edit');
        Route::name('admin.users.update')->put('/editar/{id}', 'Users\UserController@update');
        Route::name('admin.users.activate')->get('/ativar/{id}', 'Users\UserController@activate');
        Route::name('admin.users.deactivate')->get('/desativar/{id}', 'Users\UserController@deactivate');
        Route::name('admin.users.sendEmail')->get('enviar-email/{id}', 'Users\UserController@sendEmail');
      });

      // Settings
      Route::prefix('configuracoes')->group(function() {
        Route::name('admin.settings.index')->get('/', 'Settings\SettingController@index');
        Route::name('admin.settings.create')->get('/adicionar', 'Settings\SettingController@create');
        Route::name('admin.settings.store')->post('/adicionar', 'Settings\SettingController@store');
        Route::name('admin.settings.edit')->get('/editar/{id}', 'Settings\SettingController@edit');
        Route::name('admin.settings.update')->put('/editar/{id}', 'Settings\SettingController@update');
        Route::name('admin.settings.destroy')->delete('/excluir/{id}', 'Settings\SettingController@destroy');
      });

      // Audit
      Route::prefix('auditoria')->group(function() {
        Route::name('admin.audits.index')->get('/', 'Audits\AuditController@index');
        Route::name('admin.audits.show')->get('/{id}', 'Audits\AuditController@show');
      });

      // Budgets
      Route::prefix('produtos')->group(function() {
        Route::name('admin.products.index')->get('/', 'Products\ProductController@index');
        Route::name('admin.products.create')->get('/adicionar', 'Products\ProductController@create');
        Route::name('admin.products.store')->post('/adicionar', 'Products\ProductController@store');
        Route::name('admin.products.edit')->get('/editar/{id}', 'Products\ProductController@edit');
        Route::name('admin.products.update')->put('/editar/{id}', 'Products\ProductController@update');
        Route::name('admin.products.destroy')->delete('/excluir/{id}', 'Products\ProductController@destroy');

        // Budgets Origins
        Route::prefix('categorias')->group(function() {
          Route::name('admin.products_categories.index')->get('/', 'Products\CategoryController@index');
          Route::name('admin.products_categories.create')->get('/adicionar', 'Products\CategoryController@create');
          Route::name('admin.products_categories.store')->post('/adicionar', 'Products\CategoryController@store');
          Route::name('admin.products_categories.edit')->get('/editar/{id}', 'Products\CategoryController@edit');
          Route::name('admin.products_categories.update')->put('/editar/{id}', 'Products\CategoryController@update');
          Route::name('admin.products_categories.destroy')->delete('/excluir/{id}', 'Products\CategoryController@destroy');
        });
      });
      });
    });
  });
