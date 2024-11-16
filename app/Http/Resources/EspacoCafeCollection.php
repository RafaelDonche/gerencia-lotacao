<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EspacoCafeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $espacos = [];

        foreach ($this->collection as $item) {
            array_push($espacos, [
                'id' => $item->id,
                'nome' => $item->nome,
                'lotacao' => $item->lotacao,
                'pessoas_primeiro_intervalo' => array_map(fn($item) => $item['nome'], $item->nomes_intervalo1->toArray()),
                'pessoas_segundo_intervalo' => array_map(fn($item) => $item['nome'], $item->nomes_intervalo2->toArray()),
                'cadastradoEm' => $item->created_at != null ? date('d/m/Y H:i:s', strtotime($item->created_at)) : null,
                'atualizadoEm' => $item->updated_at != null ? date('d/m/Y H:i:s', strtotime($item->updated_at)) : null
            ]);
        }

        return [
            'data' => $espacos
        ];
    }
}
