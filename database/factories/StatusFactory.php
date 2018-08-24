<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Status::class, function (Faker $faker) {
    $user_ids = ['1','2','3'];
    $faker = app(Faker::class);
    $data_time=$faker->date.' '.$faker->time;
    return [
        'content' => $faker->text(),
        'created_at' => $data_time,
        'updated_at' => $data_time,
         'user_id' => $faker->randomElement($user_ids)
    ];
});
