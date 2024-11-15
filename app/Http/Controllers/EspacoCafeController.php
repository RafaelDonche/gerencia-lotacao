<?php

namespace App\Http\Controllers;

use App\Http\Requests\EspacoCafeFormRequest;
use App\Http\Requests\VinculacaoIntervalo1FormRequest;
use App\Http\Requests\VinculacaoIntervalo2FormRequest;
use App\Models\EspacoCafe;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EspacoCafeController extends Controller
{

    public function index()
    {
        try {

            $espacos = EspacoCafe::get();

            return view('scr.espacoCafes.index', compact('espacos'));

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function store(EspacoCafeFormRequest $request)
    {
        try {

            EspacoCafe::create($request->validated());

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

            $espaco = EspacoCafe::findOrFail($id);

            // seleção de participantes disponíveis para preencher os selects
            $disponiveisIntervalo1 = Pessoa::whereNull('id_primeiro_intervalo')->get(); // sem espaço de café definido para primeiro intervalo
            $disponiveisIntervalo2 = Pessoa::whereNull('id_segundo_intervalo')->get(); // sem espaço de café definido para segundo intervalo

            return view('scr.espacoCafes.show', compact('espaco', 'disponiveisIntervalo1', 'disponiveisIntervalo2'));

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        try {

            $espaco = EspacoCafe::findOrFail($id);

            return view('scr.espacoCafes.edit', compact('espaco'));

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function update(EspacoCafeFormRequest $request, $id)
    {
        try {

            EspacoCafe::findOrFail($id)->update($request->validated());

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

            $espaco = EspacoCafe::findOrFail($id);

            // desvincula todas as pessoas que tinham $id no primeiro intervalo
            Pessoa::where('id_primeiro_intervalo', $id)
                ->update(['id_primeiro_intervalo' => null]);

            // desvincula todas as pessoas que tinham $id no segundo intervalo
            Pessoa::where('id_segundo_intervalo', $id)
                ->update(['id_segundo_intervalo' => null]);

            $espaco->delete();

            Alert::toast('Cadastro excluído com sucesso!', 'success');
            return redirect()->back();

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function vincularParticipantesIntervalo1(VinculacaoIntervalo1FormRequest $request, $id)
    {
        try {

            $espaco = EspacoCafe::findorFail($id);

            $validated = $request->validated();
            $participantes = $validated['pessoas_intervalo1'];

            if ((count($espaco->pessoas_intervalo1) + count($participantes)) > $espaco->lotacao) {
                Alert::toast('A quantidade de participantes selecionados ultrapassou a lotação!', 'error');
                return redirect()->back();
            }

            foreach ($participantes as $id_participante) {
                $pessoa = Pessoa::find($id_participante);

                if ($pessoa) {
                    $pessoa->update(['id_primeiro_intervalo' => $id]);
                }
            }

            Alert::toast('Vinculações realizadas com sucesso!', 'success');
            return redirect()->back();

        } catch (\Exception $ex) {
            Alert::error('Erro!', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function vincularParticipantesIntervalo2(VinculacaoIntervalo2FormRequest $request, $id)
    {
        try {

            $espaco = EspacoCafe::findorFail($id);

            $validated = $request->validated();
            $participantes = $validated['pessoas_intervalo2'];

            if ((count($espaco->pessoas_intervalo2) + count($participantes)) > $espaco->lotacao) {
                Alert::toast('A quantidade de participantes selecionados ultrapassou a lotação!', 'error');
                return redirect()->back();
            }

            foreach ($participantes as $id_participante) {
                $pessoa = Pessoa::find($id_participante);

                if ($pessoa) {
                    $pessoa->update(['id_segundo_intervalo' => $id]);
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
