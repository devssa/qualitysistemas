<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CadastroPessoas extends Seeder
{
    private $pessoas;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CadastroPessoa::class, 100)->create()->each(function($pessoa) {
            factory(App\Models\CadastroDependente::class, 10)->create()
                ->each(function($dependente) use ($pessoa) {
                    $pessoa->dependentes()->save($dependente)->save();
                });
        });

//        $faker = Faker\Factory::create();
//        $fakerCreate = 10;
//        for($i=0; $i < $fakerCreate; $i++) {
//            $date = generateDateOfBirth();
//            DB::table('cadastro_pessoas')->insert([
//               'nome'               => $faker->name,
//               'email'              => $faker->email,
//                'data_nascimento'   => $date,
//                'foto'              => $faker->imageUrl(250,250),
//                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
//            ]);
//        }

    }
}
