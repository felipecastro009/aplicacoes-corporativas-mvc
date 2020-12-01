<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Auth\User;
use App\Models\Product\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
      'name' => $faker->unique()->name(),
      'description' => $faker->text(),
      'active' => $faker->numberBetween(0, 1),
      'user_id' => factory(User::class)->create()->id
    ];
});
