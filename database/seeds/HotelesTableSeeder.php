<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class HotelesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cantidad = 100;
        $estrellas = [
            1 => "Una estrella",
            2 => "Dos estrellas",
            3 => "Tres estrellas",
            4 => "Cuatro estrellas",
            5 => "Cinco estrellas",
        ];
        for ($i = 0; $i < $cantidad; $i++) {
            $faker = Faker::create('LaravelHotel\Models\Hotel');
            DB::table('hoteles')->insert([
                'nombre' => $faker->streetName,
                'costo' => $faker->numberBetween(1, 9999999),
                'estrellas' => $estrellas[$faker->numberBetween(1, 5)],
                'direccion' => $faker->address,
                'ciudad' => $faker->city,
                'calificacion' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
