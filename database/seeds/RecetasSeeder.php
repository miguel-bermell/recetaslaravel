<?php

use App\Receta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecetasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Receta::create([
                'titulo' => $faker->realText($faker->numberBetween(10, 15)),
                'ingredientes' => $faker->sentences($faker->numberBetween(1, 7), true),
                'preparacion' => $faker->text,
                'imagen' => $faker->imageUrl($width = 1000, $height = 550),
                'user_id' => 1,
                'categoria_id' => $faker->numberBetween($min = 1, $max = 7),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
