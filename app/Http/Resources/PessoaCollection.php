<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PessoaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $pessoas = [];

        foreach ($this->collection as $item) {
            array_push($pessoas, [
                'id' => $item->id,
                'nome' => $item->nome,
                'sobrenome' => $item->sobrenome,
                'sala_primeira_etapa' => isset($item->primeira_sala) ? array_intersect_key($item->primeira_sala->toArray(), array_flip(["id", "nome"])) : null,
                'sala_segunda_etapa' => isset($item->segunda_sala) ? array_intersect_key($item->segunda_sala->toArray(), array_flip(["id", "nome"])) : null,
                'espaco_primeiro_intervalo' => isset($item->primeiro_intervalo) ? array_intersect_key($item->primeiro_intervalo->toArray(), array_flip(["id", "nome"])) : null,
                'espaco_segundo_intervalo' => isset($item->segundo_intervalo) ? array_intersect_key($item->segundo_intervalo->toArray(), array_flip(["id", "nome"])) : null,
                'cadastradoEm' => $item->created_at != null ? date('d/m/Y H:i:s', strtotime($item->created_at)) : null,
                'atualizadoEm' => $item->updated_at != null ? date('d/m/Y H:i:s', strtotime($item->updated_at)) : null
            ]);
        }

        return [
            'data' => $pessoas
        ];
    }
}
