<?php

namespace App\Http\Requests;

use App\Models\EspacoCafe;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EspacoCafeFormRequest extends FormRequest
{
    public function rules()
    {
        if (isset($this->id)) {
            $espaco = EspacoCafe::findOrFail($this->id);
            $intervalo1 = count($espaco->pessoas_intervalo1);
            $intervalo2 = count($espaco->pessoas_intervalo2);
            $min = max($intervalo1, $intervalo2, 1);
        }else {
            $min = 1;
        }

        return [
            'nome' => [
                'required',
                isset($this->id) ?
                Rule::unique('espaco_cafes', 'nome')->whereNull('deleted_at')->ignore($this->id) :
                Rule::unique('espaco_cafes', 'nome')->whereNull('deleted_at')
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
