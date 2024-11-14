<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VinculacaoFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'pessoas_etapa1' => ['sometimes', 'required'],
            'pessoas_etapa2' => ['sometimes', 'required']
        ];
    }

    public function messages()
    {
        return [
            'pessoas_etapa1.required' => 'Deve selecionar ao menos um participante para salvar.',

            'pessoas_etapa2.required' => 'Deve selecionar ao menos um participante para salvar.'
        ];
    }
}
