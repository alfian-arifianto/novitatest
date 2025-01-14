<?php

namespace Database\Seeders;

use App\Models\Matrix;
use Illuminate\Database\Seeder;

class MatrixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 12; $i++) {
            $rand_length = rand(1, 20);
            $rand_height = rand(1, 20);

            $combination = $rand_length.'|'.$rand_height;
            $check = Matrix::where('combination', $combination)->first();
            if(!$check) {
                Matrix::create([
                    'length' => $rand_length,
                    'height' => $rand_height,
                    'combination' => $combination
                ]);
            }
        }
    }
}
