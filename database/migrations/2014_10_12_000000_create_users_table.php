<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
     Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->string('first_name');
      $table->string('last_name');
      $table->string('identification')->unique()->nullable();
      $table->string('phone')->nullable();
      $table->date('brithday')->nullable();
      $table->string('email')->unique();
      $table->string('password');
      $table->boolean('active')->nullable()->default(0);
      $table->boolean('receive_messages')->nullable()->default(0);
      $table->timestamp('latest_login')->nullable();
      $table->rememberToken();
      $table->timestamps();
    });

    Schema::create('autologin_tokens', function (Blueprint $table) {
      $table->increments('id');
      $table->string('token')->unique();
      $table->string('path')->nullable();
      $table->integer('count')->nullable()->default(0);
      $table->unsignedInteger('user_id')->index();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->timestamps();
      $table->index(['token']);
    });

    Schema::create('password_resets', function (Blueprint $table) {
      $table->string('email')->index();
      $table->string('token');
      $table->timestamp('created_at')->nullable();
    });

    Schema::create('sessions', function ($table) {
      $table->string('id')->unique();
      $table->unsignedInteger('user_id')->nullable();
      $table->string('ip_address')->nullable();
      $table->text('user_agent')->nullable();
      $table->text('payload');
      $table->integer('last_activity');
    });

    Schema::create('permissions', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name')->unique();
      $table->string('details');
      $table->string('guard_name');
      $table->timestamps();
    });

    Schema::create('roles', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name')->unique();
      $table->string('details');
      $table->string('guard_name');
      $table->timestamps();
    });

    Schema::create('model_has_permissions', function (Blueprint $table) {
      $table->unsignedInteger('permission_id');
      $table->morphs('model');
      $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
      $table->primary(['permission_id', 'model_id', 'model_type']);
    });

    Schema::create('model_has_roles', function (Blueprint $table) {
      $table->unsignedInteger('role_id');
      $table->morphs('model');
      $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
      $table->primary(['role_id', 'model_id', 'model_type']);
    });

    Schema::create('role_has_permissions', function (Blueprint $table) {
      $table->unsignedInteger('permission_id');
      $table->unsignedInteger('role_id');
      $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
      $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
      $table->primary(['permission_id', 'role_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('role_has_permissions');
    Schema::dropIfExists('model_has_roles');
    Schema::dropIfExists('model_has_permissions');
    Schema::dropIfExists('roles');
    Schema::dropIfExists('permissions');
    Schema::dropIfExists('sessions');
    Schema::dropIfExists('password_resets');
    Schema::dropIfExists('autologin_tokens');
    Schema::dropIfExists('users');
  }
}
