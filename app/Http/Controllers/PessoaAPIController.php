<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaFormRequest;
use App\Http\Resources\PessoaCollection;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaAPIController extends Controller
{
    public function index(Request $request)
    {
        return new PessoaCollection(Pessoa::filtrar($request));
    }

    public function store(PessoaFormRequest $request)
    {
        Pessoa::create($request->validated());

        return response()->json("Cadastro realizado com sucesso");
    }

    public function update(PessoaFormRequest $request, $id)
    {
        Pessoa::findOrFail($id)->update($request->validated());

        return response()->json("Cadastro atualizado com sucesso");
    }

    public function destroy($id)
    {
        Pessoa::findOrFail($id)->delete();

        return response()->json("Cadastro excluído com sucesso");
    }
}
