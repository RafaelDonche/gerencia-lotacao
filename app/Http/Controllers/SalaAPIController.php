<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaFormRequest;
use App\Http\Resources\SalaCollection;
use App\Models\Pessoa;
use App\Models\Sala;
use Illuminate\Http\Request;

class SalaAPIController extends Controller
{
    public function index(Request $request)
    {
        return new SalaCollection(Sala::filtrar($request));
    }

    public function store(SalaFormRequest $request)
    {
        Sala::create($request->validated());

        return response()->json("Cadastro realizado com sucesso");
    }

    public function update(SalaFormRequest $request, $id)
    {
        Sala::findOrFail($id)->update($request->validated());

        return response()->json("Cadastro atualizado com sucesso");
    }

    public function destroy($id)
    {
        $sala = Sala::findOrFail($id);

        // desvincula todas as pessoas que tinham $id na primeira sala
        Pessoa::where('id_primeira_sala', $id)
            ->update(['id_primeira_sala' => null]);

        // desvincula todas as pessoas que tinham $id na segunda sala
        Pessoa::where('id_segunda_sala', $id)
            ->update(['id_segunda_sala' => null]);

        $sala->delete();

        return response()->json("Cadastro excluído com sucesso");
    }
}
