<?php

namespace Tests\Unit;

use App\Models\EspacoCafe;
use App\Models\Pessoa;
use App\Models\Sala;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RelacionamentoTest extends TestCase
{
    use RefreshDatabase;

    public function test_relacionamento_sala_hasMany()
    {
        $sala = Sala::factory()
            ->has(Pessoa::factory()->count(3), 'pessoas_etapa1')
            ->create();

        $this->assertTrue(count($sala->pessoas_etapa1) == 3);
    }

    public function test_etapa_lotada()
    {
        $sala = Sala::factory()->create();

        Pessoa::factory()->count($sala->lotacao)->create([
            'id_primeira_sala' => $sala->id
        ]);

        $this->assertTrue($sala->etapa1_lotada());
    }

    public function test_sala_vazia()
    {
        $sala = Sala::factory()->create();

        $this->assertTrue($sala->vazia());
    }

    public function test_media_lotacao()
    {
        $espaco = EspacoCafe::factory()->create();

        Pessoa::factory()->count($espaco->lotacao)->create([
            'id_primeiro_intervalo' => $espaco->id,
            'id_segundo_intervalo' => $espaco->id
        ]);

        $this->assertTrue($espaco->media_lotacao() == 100);
    }
}
