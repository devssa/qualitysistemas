<?php

use Faker\Generator as Faker;

$factory->define(App\Models\CadastroDependente::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'data_nascimento' => generateDateOfBirth(),
    ];
});
