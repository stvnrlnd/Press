<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use stvnrlnd\Press\Models\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'identifier' => Str::random(),
        'slug' => $faker->slug,
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'extra' => json_encode(['key' => 'value'])
    ];
});