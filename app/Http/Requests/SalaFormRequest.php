<?php

namespace App\Http\Requests;

use App\Models\Sala;
use Illuminate\Foundation\Http\FormRequest;

class SalaFormRequest extends FormRequest
{
    public function rules()
    {
        if (isset($this->id)) {
            $sala = Sala::findOrFail($this->id);
            $etapa1 = count($sala->pessoas_etapa1);
            $etapa2 = count($sala->pessoas_etapa2);
            $min = max($etapa1, $etapa2, 1);
        }else {
            $min = 1;
        }

        return [
            'nome' => [
                'required',
                isset($this->id) ? 'unique:salas,nome,' . $this->id : 'unique:salas,nome'
            ],
            'lotacao' => [
                'required',
                'integer',
                'min:' . $min,
                'max:2000000000'
            ]
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.unique' => 'Já existe outro cadastro com este nome.',

            'lotacao.required' => 'O campo lotação é obrigatório.',
            'lotacao.integer' => 'O campo lotação deve ser um número inteiro.',
            'lotacao.min' => 'O valor mínimo para este campo é :min.',
            'lotacao.max' => 'O valor máximo para este campo é :max.'
        ];
    }
}
