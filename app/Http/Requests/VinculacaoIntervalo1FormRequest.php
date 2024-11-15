<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VinculacaoIntervalo1FormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'pessoas_intervalo1' => ['required', 'array'],
        ];
    }

    public function messages()
    {
        return [
            'pessoas_intervalo1.required' => 'Deve selecionar ao menos um participante para salvar.',
            'pessoas_intervalo1.array' => 'O campo deve retornar um array de inteiros.'
        ];
    }
}
