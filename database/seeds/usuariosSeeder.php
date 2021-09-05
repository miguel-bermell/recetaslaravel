<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

require_once 'vendor/autoload.php';

class usuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userMain = User::create([
            'name' => 'Miguel',
            'email' => 'test@test.com',
            'password' => bcrypt('123Miguel'),
            'url' => 'http://bermelldev.com',
        ]);

        $userMain->perfil()->create();


        $faker = Faker\Factory::create();

        // for ($i = 0; $i < 10; $i++) {
        //     DB::table('users')->insert([
        //         'name' => $faker->name,
        //         'email' => $faker->email,
        //         'password' => bcrypt('12345' . $faker->name),
        //         'url' => $faker->url,
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ]);
        // }

        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('123Miguel'),
                'url' => $faker->url,
            ]);

            $user->perfil()->create();
        }
    }
}
