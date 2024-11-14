<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaFormRequest;
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

    public function destroy(Request $request, $id)
    {
        //
    }
}
