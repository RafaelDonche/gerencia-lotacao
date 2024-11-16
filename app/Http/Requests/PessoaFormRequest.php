<?php

namespace App\Http\Requests;

use App\Rules\CheckLotacaoEspacoCafeRule;
use App\Rules\CheckLotacaoSalaRule;
use Illuminate\Foundation\Http\FormRequest;

class PessoaFormRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function rules()
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'sobrenome' => ['required', 'string', 'max:255'],
            'id_primeira_sala' => ['sometimes', 'nullable', 'exists:salas,id', new CheckLotacaoSalaRule(1)],
            'id_segunda_sala' => ['sometimes', 'nullable', 'exists:salas,id', new CheckLotacaoSalaRule(2)],
            'id_primeiro_intervalo' => ['sometimes', 'nullable', 'exists:espaco_cafes,id', new CheckLotacaoEspacoCafeRule(1)],
            'id_segundo_intervalo' => ['sometimes', 'nullable', 'exists:espaco_cafes,id', new CheckLotacaoEspacoCafeRule(2)]
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O valor máximo para este campo é :max.',

            'sobrenome.required' => 'O campo sobrenome é obrigatório.',
            'sobrenome.max' => 'O valor máximo para este campo é :max.',

            'id_primeira_sala.exists' => 'O item selecionado não existe.',

            'id_segunda_sala.exists' => 'O item selecionado não existe.',

            'id_primeiro_intervalo.exists' => 'O item selecionado não existe.',

            'id_segundo_intervalo.exists' => 'O item selecionado não existe.'
        ];
    }
}
