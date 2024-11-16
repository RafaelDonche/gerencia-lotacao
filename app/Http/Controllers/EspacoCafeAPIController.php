<?php

namespace App\Http\Controllers;

use App\Http\Requests\EspacoCafeFormRequest;
use App\Http\Resources\EspacoCafeCollection;
use App\Models\EspacoCafe;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class EspacoCafeAPIController extends Controller
{
    public function index(Request $request)
    {
        return new EspacoCafeCollection(EspacoCafe::filtrar($request));
    }

    public function store(EspacoCafeFormRequest $request)
    {
        EspacoCafe::create($request->validated());

        return response()->json("Cadastro realizado com sucesso");
    }

    public function update(EspacoCafeFormRequest $request, $id)
    {
        EspacoCafe::findOrFail($id)->update($request->validated());

        return response()->json("Cadastro atualizado com sucesso");
    }

    public function destroy($id)
    {
        $espaco = EspacoCafe::findOrFail($id);

        // desvincula todas as pessoas que tinham $id no primeiro intervalo
        Pessoa::where('id_primeiro_intervalo', $id)
            ->update(['id_primeiro_intervalo' => null]);

        // desvincula todas as pessoas que tinham $id no segundo intervalo
        Pessoa::where('id_segundo_intervalo', $id)
            ->update(['id_segundo_intervalo' => null]);

        $espaco->delete();

        return response()->json("Cadastro excluído com sucesso");
    }
}
