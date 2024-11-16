<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SalaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $salas = [];

        foreach ($this->collection as $item) {
            array_push($salas, [
                'id' => $item->id,
                'nome' => $item->nome,
                'lotacao' => $item->lotacao,
                'pessoas_primeira_etapa' => array_map(fn($item) => $item['nome'], $item->nomes_etapa1->toArray()),
                'pessoas_segunda_etapa' => array_map(fn($item) => $item['nome'], $item->nomes_etapa2->toArray()),
                'cadastradoEm' => $item->created_at != null ? date('d/m/Y H:i:s', strtotime($item->created_at)) : null,
                'atualizadoEm' => $item->updated_at != null ? date('d/m/Y H:i:s', strtotime($item->updated_at)) : null
            ]);
        }

        return [
            'data' => $salas
        ];
    }
}
