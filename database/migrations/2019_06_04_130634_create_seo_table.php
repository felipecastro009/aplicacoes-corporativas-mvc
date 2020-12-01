<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('seo', function (Blueprint $table) {
      $table->increments('id');
      $table->morphs('seoable');
      $table->string('meta_title');
      $table->string('meta_description')->nullable();
      $table->string('meta_keywords')->nullable();
      $table->string('og_title')->nullable();
      $table->string('og_description')->nullable();
      $table->string('og_type')->nullable();
      $table->string('twitter_title')->nullable();
      $table->string('twitter_description')->nullable();
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
    Schema::dropIfExists('seo');
  }
}
