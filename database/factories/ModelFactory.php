<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'admin'          => 0,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'user_id'       => 1,
        'title'         => $faker->word,
        'summary'       => $faker->sentence,
        'body'          => $faker->paragraphs(5, true),
        'thumbnail_url' => 'http://i.imgur.com/i0YU4Zt.gif',
        'publish_date'  => Carbon\Carbon::now(),
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});
