<?php

namespace App\Http\Requests;

use App\Models\Sala;
use Illuminate\Foundation\Http\FormRequest;

class SalaEtapa1FormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome' => [
                'required',
                isset($this->id) ? 'unique:salas,nome,' . $this->id : 'unique:salas,nome'
            ],
            'lotacao' => [
                'integer',
                isset($this->id) ? 'min:' . count(Sala::find($this->id)->pessoas_etapa1) : ''
            ]
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.unique' => 'Já existe outro cadastro com este nome.',

            'lotacao.required' => 'O campo lotação é obrigatório.',
            'lotacao.min' => 'O valor mínimo para este campo é :min.'
        ];
    }
}
