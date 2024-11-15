<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaFormRequest;
use App\Http\Requests\VinculacaoEtapa1FormRequest;
use App\Http\Requests\VinculacaoEtapa2FormRequest;
use App\Models\Pessoa;
use App\Models\Sala;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SalaController extends Controller
{
    public function index()
    {
        try {

            $salas = Sala::get();

            return view('scr.salas.index', compact('salas'));

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function store(SalaFormRequest $request)
    {
        try {

            Sala::create($request->validated());

            Alert::toast('Cadastro realizado com sucesso!', 'success');
            return redirect()->back();

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        try {

            $sala = Sala::findOrFail($id);

            // seleção de participantes disponíveis para preencher os selects
            $disponiveisEtapa1 = Pessoa::whereNull('id_primeira_sala')->get(); // sem sala definida para primeira etapa
            $disponiveisEtapa2 = Pessoa::whereNull('id_segunda_sala')->get(); // sem sala definida para segunda etapa

            return view('scr.salas.show', compact('sala', 'disponiveisEtapa1', 'disponiveisEtapa2'));

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        try {

            $sala = Sala::findOrFail($id);

            return view('scr.salas.edit', compact('sala'));

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function update(SalaFormRequest $request, $id)
    {
        try {

            Sala::findOrFail($id)->update($request->validated());

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

            $sala = Sala::findOrFail($id);

            // desvincula todas as pessoas que tinham $id na primeira sala
            Pessoa::where('id_primeira_sala', $id)
                ->update(['id_primeira_sala' => null]);

            // desvincula todas as pessoas que tinham $id na segunda sala
            Pessoa::where('id_segunda_sala', $id)
                ->update(['id_segunda_sala' => null]);

            $sala->delete();

            Alert::toast('Cadastro excluído com sucesso!', 'success');
            return redirect()->back();

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function vincularParticipantesEtapa1(VinculacaoEtapa1FormRequest $request, $id)
    {
        try {

            $sala = Sala::findorFail($id);

            $validated = $request->validated();
            $participantes = $validated['pessoas_etapa1'];

            if ((count($sala->pessoas_etapa1) + count($participantes)) > $sala->lotacao) {
                Alert::toast('A quantidade de participantes selecionados ultrapassou a lotação!', 'error');
                return redirect()->back();
            }

            foreach ($participantes as $id_participante) {
                $pessoa = Pessoa::find($id_participante);

                if ($pessoa) {
                    $pessoa->update(['id_primeira_sala' => $id]);
                }
            }

            Alert::toast('Vinculações realizadas com sucesso!', 'success');
            return redirect()->back();

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function vincularParticipantesEtapa2(VinculacaoEtapa2FormRequest $request, $id)
    {
        try {

            $sala = Sala::findOrFail($id);

            $validated = $request->validated();
            $participantes = $validated['pessoas_etapa2'];

            if ((count($sala->pessoas_etapa2) + count($participantes)) > $sala->lotacao) {
                Alert::toast('A quantidade de participantes selecionados ultrapassou a lotação!', 'error');
                return redirect()->back();
            }

            foreach ($participantes as $id_participante) {
                $pessoa = Pessoa::find($id_participante);

                if ($pessoa) {
                    $pessoa->update(['id_segunda_sala' => $id]);
                }
            }

            Alert::toast('Vinculações realizadas com sucesso!', 'success');
            return redirect()->back();

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }
}
