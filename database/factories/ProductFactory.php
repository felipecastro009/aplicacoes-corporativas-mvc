<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Auth\User;
use App\Models\Product\Category;
use App\Models\Product\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
      'name' => $faker->unique()->name(),
      'price' => $faker->randomNumber(3),
      'description' => $faker->text(),
      'active' => $faker->numberBetween(0, 1),
      'category_id' => factory(Category::class)->create()->id,
      'user_id' => factory(User::class)->create()->id
    ];
});
