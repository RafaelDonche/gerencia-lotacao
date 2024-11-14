<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salas')->insert([
            [
                'nome' => 'Andar 5 - A',
                'lotacao' => 5
            ],
            [
                'nome' => 'Andar 5 - B',
                'lotacao' => 10
            ],
            [
                'nome' => 'Andar 5 - C',
                'lotacao' => 15
            ],
        ]);
    }
}
