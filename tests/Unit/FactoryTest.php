<?php

namespace Tests\Unit;

use App\Models\EspacoCafe;
use App\Models\Pessoa;
use App\Models\Sala;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_criar_sala_sem_nome()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Sala::factory()->count(3)->create([
            'nome' => null
        ]);
    }

    public function test_criar_espaco_cafe_sem_lotacao()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        EspacoCafe::factory()->create([
            'lotacao' => null
        ]);
    }
}
