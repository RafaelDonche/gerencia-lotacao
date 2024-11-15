<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VinculacaoIntervalo2FormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'pessoas_intervalo2' => ['required', 'array'],
        ];
    }

    public function messages()
    {
        return [
            'pessoas_intervalo2.required' => 'Deve selecionar ao menos um participante para salvar.',
            'pessoas_etapa2.array' => 'O campo deve retornar um array de inteiros.'
        ];
    }
}
