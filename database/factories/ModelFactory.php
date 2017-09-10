<?php

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

// Cria os tipos de informações que seram geradas para cada emdidade

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CodeFin\Models\User::class, function (Faker\Generator $faker){
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->state(\CodeFin\Models\User::class, 'admin', function (Faker\Generator $faker){
	return [
		'role' => \CodeFin\Models\User::ROLE_ADMIN
	];
});

// $factory->define(CodeFin\Models\Bank::class, function (Faker\Generator $faker) {
// Definida na migrãção
//     return [
//         'name' => $faker->name,
//         'logo' => md5(time()).'.jpeg'
//     ];
// });

$factory->define(CodeFin\Models\BankAccount::class, function (Faker\Generator $faker){

    return [
        'name'      => $faker->city,
        'agency'    => rand(10000, 60000).'-'.rand(0, 9),
        'account'   => rand(70000, 260000).'-'.rand(0, 9)
    ];
});


$factory->define(CodeFin\Models\Client::class, function (Faker\Generator $faker){

    return [
        'name' => $faker->name,
    ];
});


$factory->define(CodeFin\Models\Category::class, function (Faker\Generator $faker){

    return [
        'name' => $faker->name,
    ];
});

