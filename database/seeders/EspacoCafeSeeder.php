<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspacoCafeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('espaco_cafes')->insert([
            [
                'nome' => 'Cantina Sul',
                'lotacao' => 25
            ]
        ]);
    }
}
