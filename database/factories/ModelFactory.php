<?php
use Illuminate\Support\Facades\Hash;

/*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | Here you may define all of your model factories. Model factories give
  | you a convenient way to create models for testing and seeding your
  | database. Just tell the factory how a default model should look.
  |
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
//        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
//        'password' => $password ?: $password = bcrypt('secret'),
        'password' => Hash::make('123456'),
        'user_type' => $faker->numberBetween(2, 3),
        'remember_token' => str_random(10),
        'google' => str_random(10),
    ];
});
$factory->define(App\Models\Profile::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'avatar' => $faker->imageUrl(),
        'gender' => $faker->randomElement(array("M", "F")),
        'latitude' => $faker->latitude(),
        'longitude' => $faker->longitude(),
        'address' => $faker->address,
        'phone_number' => $faker->phoneNumber,
        'bio' => $faker->paragraph,
        'radius' => $faker->numberBetween(1000, 25000),
        'hourly_rate' => $faker->randomFloat(2, 1, 50),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Question::class, function (Faker\Generator $faker) {

    return [
        'text' => $faker->text,
        'user_type' => $faker->numberBetween(2, 3),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Choice::class, function (Faker\Generator $faker) {

    return [
        'text' => $faker->text,
//        'question_id' => function () {
//            return factory(App\Models\Question::class)->create()->id;
//        }
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Answer::class, function (Faker\Generator $faker) {

    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'question_id' => function () {
            return factory(App\Models\Question::class)->create()->id;
        },
        'choice_id' => function () {
            return factory(App\Models\Choice::class)->create()->id;
        }
    ];
});
