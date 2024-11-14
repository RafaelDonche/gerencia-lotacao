<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pessoas')->insert([
            [
                'nome' => 'Cristiane Sônia',
                'sobrenome' => 'Santos',
                'id_primeira_sala' => 1,
                'id_segunda_sala' => 1,
                'id_primeiro_intervalo' => 1,
                'id_segundo_intervalo' => 1
            ],
            [
                'nome' => 'Luciana',
                'sobrenome' => 'de Oliveira Souza',
                'id_primeira_sala' => 1,
                'id_segunda_sala' => 2,
                'id_primeiro_intervalo' => null,
                'id_segundo_intervalo' => 1
            ],
            [
                'nome' => 'Roberto',
                'sobrenome' => 'da Costa Silva',
                'id_primeira_sala' => 3,
                'id_segunda_sala' => 3,
                'id_primeiro_intervalo' => 1,
                'id_segundo_intervalo' => null
            ],
            [
                'nome' => 'João',
                'sobrenome' => 'Andrade Britto',
                'id_primeira_sala' => null,
                'id_segunda_sala' => null,
                'id_primeiro_intervalo' => null,
                'id_segundo_intervalo' => null
            ]
        ]);
    }
}
