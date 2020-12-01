<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('categories', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name')->unique();
        $table->string('slug');
        $table->text('description');
        $table->boolean('active')->default(0);
        $table->unsignedInteger('user_id')->index();
        $table->foreign('user_id')->references('id')->on('users');
        $table->timestamps();
    });

    Schema::create('products', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name')->unique();
        $table->string('slug');
        $table->decimal('price', 10, 2);
        $table->text('description');
        $table->boolean('active')->default(0);
        $table->unsignedInteger('category_id')->index();
        $table->foreign('category_id')->references('id')->on('categories');
        $table->unsignedInteger('user_id')->index();
        $table->foreign('user_id')->references('id')->on('users');
        $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('products');
    Schema::dropIfExists('categories');
  }
}
