<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaFormRequest;
use App\Models\EspacoCafe;
use App\Models\Pessoa;
use App\Models\Sala;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\throwException;

class PessoaController extends Controller
{
    public function index()
    {
        try {

            $pessoas = Pessoa::get();

            // seleção de salas disponíveis para preencher os selects
            $disponiveisEtapa1 = Sala::withCount('pessoas_etapa1')
                ->having('lotacao', '>', 'pessoas_etapa1_count')
                ->get();
            $disponiveisEtapa2 = Sala::with('pessoas_etapa2')
                ->having('lotacao', '>', 'count(pessoas_etapa2)')
                ->get();

            // seleção de espaços de café disponíveis para preencher os selects
            $disponiveisIntervalo1 = EspacoCafe::with('pessoas_intervalo1')
                ->having('lotacao', '>', 'count(pessoas_intervalo1)')
                ->get();
            $disponiveisIntervalo2 = EspacoCafe::with('pessoas_intervalo2')
                ->having('lotacao', '>', 'count(pessoas_intervalo2)')
                ->get();

            return view('scr.pessoas.index', compact(
                'pessoas', 'disponiveisEtapa1', 'disponiveisEtapa2', 'disponiveisIntervalo1', 'disponiveisIntervalo2'
            ));

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function store(PessoaFormRequest $request)
    {
        try {

            Pessoa::create($request->validated());

            Alert::toast('Cadastro realizado com sucesso!', 'success');
            return redirect()->back();

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        try {

            $pessoa = Pessoa::findOrFail($id);

            // seleção de salas disponíveis para preencher os selects
            $disponiveisEtapa1 = Sala::withCount('pessoas_etapa1')
                ->having('pessoas_etapa1_count', '<', DB::raw('lotacao'))
                ->get();
            $disponiveisEtapa2 = Sala::withCount('pessoas_etapa2')
                ->having('pessoas_etapa2_count', '<', DB::raw('lotacao'))
                ->get();

            // seleção de espaços de café disponíveis para preencher os selects
            $disponiveisIntervalo1 = EspacoCafe::withCount('pessoas_intervalo1')
                ->having('pessoas_intervalo1_count', '<', DB::raw('lotacao'))
                ->get();
            $disponiveisIntervalo2 = EspacoCafe::withCount('pessoas_intervalo2')
                ->having('pessoas_intervalo2_count', '<', DB::raw('lotacao'))
                ->get();

            return view('scr.pessoas.edit', compact(
                'pessoa', 'disponiveisEtapa1', 'disponiveisEtapa2', 'disponiveisIntervalo1', 'disponiveisIntervalo2'
            ));

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function update(PessoaFormRequest $request, $id)
    {
        try {

            Pessoa::findOrFail($id)->update($request->validated());

            Alert::toast('Cadastro atualizado com sucesso!', 'success');
            return redirect()->back();

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {

            Pessoa::findOrFail($id)->delete();

            Alert::toast('Cadastro excluído com sucesso!', 'success');
            return redirect()->back();

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function desvincularPrimeiraEtapa($id)
    {
        try {

            Pessoa::findOrFail($id)->update([
                'id_primeira_sala' => null
            ]);

            return response()->json("Desvinculado com sucesso!");

        } catch (\Exception $ex) {
            return response()->json($ex->getMessage(), $ex->getCode());
        }
    }

    public function desvincularSegundaEtapa($id)
    {
        try {

            Pessoa::findOrFail($id)->update([
                'id_segunda_sala' => null
            ]);

            return response()->json("Desvinculado com sucesso!");

        } catch (\Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }
    }

    public function desvincularPrimeiroIntervalo($id)
    {
        try {

            Pessoa::findOrFail($id)->update([
                'id_primeiro_intervalo' => null
            ]);

            return response()->json("Desvinculado com sucesso!");

        } catch (\Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }
    }

    public function desvincularSegundoIntervalo($id)
    {
        try {

            Pessoa::findOrFail($id)->update([
                'id_segundo_intervalo' => null
            ]);

            return response()->json("Desvinculado com sucesso!");

        } catch (\Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }
    }
}
