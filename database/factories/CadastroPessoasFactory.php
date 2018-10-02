<?php

use Faker\Generator as Faker;

$factory->define(App\Models\CadastroPessoa::class, function (Faker $faker) {

    $faker->addProvider(new Bluemmb\Faker\PicsumPhotosProvider($faker));

    return [
        'nome' => $faker->name,
        'data_nascimento' => generateDateOfBirth(),
        'email' => $faker->unique()->safeEmail,
        'foto' => $faker->imageUrl(250, 250),
        'is_active' => rand(0, 1) == 1,
    ];
});
